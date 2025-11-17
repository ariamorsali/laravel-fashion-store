<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\User\CustomerRequest;
use App\Http\Services\Image\ImageService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('user_type', 0)->orderBy('id', 'desc')->paginate(20);
        return view('admin.user.customer.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request, ImageService $imageService)
    {
        $inputs = $request->validated();
        $inputs['password'] = Hash::make($request->password);
        $inputs['user_type'] = 0;
        if ($request->hasFile('profile_photo_path')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));

            if ($result === false) {
                return redirect()->route('admin.user.customer.index')->with(
                    'alert-section-error',
                    'There was an error uploading the photo.'
                );
            }
            $inputs['profile_photo_path'] = $result;
        }

        $user = User::create($inputs);
        return redirect()->route('admin.user.customer.index')->with(
            'alert-section-success',
            'New user successfully registered.'
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
    public function edit(User $customer)
    {
        return view('admin.user.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, User $customer, ImageService $imageService)
    {
        $inputs = $request->validated();

        // اگر کاربر فایل جدید آپلود کرد
        if ($request->hasFile('profile_photo_path')) {
            if (!empty($customer->profile_photo_path)) {
                $imageService->deleteImage($customer->profile_photo_path);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));
            if ($result === false) {
                return redirect()->route('admin.user.customer.index')->with(
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
        $customer->update($inputs);
        return redirect(route('admin.user.customer.index'))->with(
            'alert-section-success',
            'User editing completed successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $customer)
    {
        $customer->delete();
        return redirect(route('admin.user.customer.index'))->with(
            'alert-section-success',
            'User successfully deleted.'
        );
    }

    public function activation(User $customer)
    {
        $customer->activation = $customer->activation == 0 ? 1 : 0;
        $result = $customer->save();
        if ($result) {
            if ($customer->activation == 0) {
                return response()->json(['activation' => true, 'checked' => false]);
            } else {
                return response()->json(['activation' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['activation' => false]);
        }
    }
}
