<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\AdminUserRequest;
use App\Http\Services\Image\ImageService;
use App\Models\User;
use App\Models\User\Permission;
use App\Models\User\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {

        $admins = User::whereHas('roles', function ($q) {
            $q->where('name', '!=', 'user');
        })->orderBy('id', 'desc')->paginate(20);
        return view('admin.user.admin-user.index', compact('admins'));
    }
    public function role(User $admin)
    {
        $roles = Role::all();
        return view('admin.user.admin-user.roleForm', compact('admin', 'roles'));
    }
    public function roleStore(Request $request, User $admin)
    {
        if (!auth()->user()->is_owner) {
            return back()->with('alert-section-error', 'Only owner can change roles.');
        }
        if ($admin->id == auth()->id()) {
            return back()->with('alert-section-error', 'You cannot modify yourself.');
        }
        if ($admin->is_owner) {
            return back()->with('alert-section-error', 'Cannot modify owner roles or permissions.');
        }
        if ($admin->roles()->count() === 0) {
            return back()->with('alert-section-error', 'Cannot assign roles to normal users.');
        }
        $validated = $request->validate([
            'roles' => 'required|array|min:1',
            'roles.*' => 'integer|exists:roles,id'
        ]);
        $admin->roles()->sync($validated['roles']);

        return redirect()->route('admin.user.admin.index')->with(
            'alert-section-success',
            'The admin role was successfully updated.'
        );
    }

    public function permission(User $admin)
    {
        $permissions = Permission::all();
        return view('admin.user.admin-user.permissionForm', compact('admin', 'permissions'));
    }
    public function permissionStore(Request $request, User $admin)
    {
        // فقط owner می‌تونه
        if (!auth()->user()->is_owner) {
            return back()->with('alert-section-error', 'Only owner can change permissions.');
        }

        // نمی‌تونه خودش رو تغییر بده
        if ($admin->id == auth()->id()) {
            return back()->with('alert-section-error', 'You cannot modify yourself.');
        }

        // نمی‌تونه owner تغییر کنه
        if ($admin->is_owner) {
            return back()->with('alert-section-error', 'Cannot modify owner roles or permissions.');
        }

        if ($admin->roles()->count() === 0) {
            return back()->with('alert-section-error', 'Cannot assign permissions to normal users.');
        }

        $validated = $request->validate([
            'permissions' => 'required|array|min:1',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);

        $admin->permissions()->sync($validated['permissions']);

        return redirect()->route('admin.user.admin.index')->with(
            'alert-section-success',
            'The admin permissions was successfully updated.'
        );
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.admin-user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminUserRequest $request, ImageService $imageService)
    {
        // فقط Owner می‌تواند ادمین بسازد
        if (!auth()->user()->is_owner) {
            return back()->with('alert-section-error', 'Only owner can create admins.');
        }
        $inputs = $request->validated();

        $inputs['password'] = Hash::make($request->password);

        if ($request->hasFile('profile_photo_path')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));
            if ($result === false) {
                return redirect()->route('admin.user.admin.index')->with(
                    'alert-section-error',
                    'There was an error uploading the photo.'
                );
            }
            $inputs['profile_photo_path'] = $result;
        }

        $user = User::create($inputs);

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $user->roles()->attach($adminRole->id);
        return redirect()->route('admin.user.admin.index')->with(
            'alert-section-success',
            'New admin successfully registered.'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(User $customer)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $admin)
    {
        return view('admin.user.admin-user.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUserRequest $request, User $admin, ImageService $imageService)
    {
        // فقط Owner می‌تواند
        if (!auth()->user()->is_owner) {
            return back()->with('alert-section-error', 'Only owner can edit admins.');
        }

        if ($admin->is_owner) {
            return back()->with('alert-section-error', 'Cannot edit system owner.');
        }

        $inputs = $request->validated();

        // اگر کاربر فایل جدید آپلود کرد
        if ($request->hasFile('profile_photo_path')) {
            if (!empty($admin->profile_photo_path)) {
                $imageService->deleteImage($admin->profile_photo_path);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));
            if ($result === false) {
                return redirect()->route('admin.user.admin.index')->with(
                    'alert-section-error',
                    'There was an error uploading the photo.'
                );
            }
            $inputs['profile_photo_path'] = $result;
        }
        if ($request->password) {
            $inputs['password'] = Hash::make($request->password);
        } else {
            unset($inputs['password']);
        }
        $admin->update($inputs);
        return redirect(route('admin.user.admin.index'))->with(
            'alert-section-success',
            'User editing completed successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $admin)
    {
        if (!auth()->check()) {
            abort(403, 'Not authenticated.');
        }
        if ($admin->is_owner) {
            return back()->with('alert-section-error', 'The system owner cannot be deleted.');
        }
        // حفاظت از سوپرادمین
        if ($admin->hasRole('superadmin') && !auth()->user()->is_owner) {
            return back()->with('alert-section-error', 'Only the system owner can delete a super admin.');
        }

        if ($admin->hasRole('admin') && !(auth()->user()->hasRole('superadmin') || auth()->user()->is_owner)) {
            return back()->with('alert-section-error', 'You are not allowed to delete this admin.');
        }

        // حذف عکس پروفایل اگر موجود است
        if (!empty($admin->profile_photo_path)) {
            app(ImageService::class)->deleteImage($admin->profile_photo_path);
        }
        if ($admin->id == auth()->id()) {
            return back()->with('alert-section-error', 'You cannot delete yourself.');
        }
        $admin->delete();
        return redirect(route('admin.user.admin.index'))->with(
            'alert-section-success',
            'Admin successfully deleted.'
        );
    }

    public function activation(User $admin)
    {
        $admin->activation = $admin->activation == 0 ? 1 : 0;
        $result = $admin->save();
        if ($result) {
            if ($admin->activation == 0) {
                return response()->json(['activation' => true, 'checked' => false]);
            } else {
                return response()->json(['activation' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['activation' => false]);
        }
    }

    public function revokeAdmin(User $admin)
    {
        if (!auth()->check()) {
            abort(403, 'Not authenticated.');
        }
        if ($admin->is_owner) {
            return back()->with('alert-section-error', 'Cannot modify owner.');
        }

        if ($admin->id == auth()->id()) {
            return back()->with('alert-section-error', 'You cannot demote yourself.');
        }

        $currentUser = auth()->user();

        // فقط Owner و Superadmin می‌توانند ادمین‌ها را تنزل دهند
        if (!$currentUser->is_owner && !$currentUser->hasRole('superadmin')) {
            return back()->with('alert-section-error', 'You do not have permission to demote admins.');
        }

        // چک سلسله‌مراتب: Superadmin نمی‌تواند دیگر Superadmin‌ها را تنزل دهد
        if ($admin->hasRole('superadmin') && !$currentUser->is_owner) {
            return back()->with('alert-section-error', 'Only the owner can demote a superadmin.');
        }

        // چک سلسله‌مراتب: Admin نمی‌تواند دیگر Admin‌ها را تنزل دهد
        if ($admin->hasRole('admin') && $currentUser->hasRole('admin')) {
            return back()->with('alert-section-error', 'Admins cannot demote other admins.');
        }


        // حذف تمام نقش‌های مدیریتی و فقط دادن نقش user
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $admin->roles()->sync([$userRole->id]);
        $admin->save();

        return redirect(route('admin.user.admin.index'))->with(
            'alert-section-success',
            'Manager successfully demoted.'
        );
    }
}
