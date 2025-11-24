<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User\Role;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\User\RoleRequest;
use App\Models\User\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::orderBy('id', 'desc')->paginate(20);
        return view('admin.user.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.user.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $inputs = $request->all();
        $role = Role::create($inputs);

        $inputs['permissions'] = $inputs['permissions'] ?? [];

        $role->permissions()->sync($inputs['permissions']);
        return redirect()->route('admin.user.role.index')->with(
            'alert-section-success',
            'New role successfully registered.'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('admin.user.role.edit', compact('role'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {
        $inputs = $request->all();
        $role->update($inputs);

        return redirect()->route('admin.user.role.index')->with(
            'alert-section-success',
            'Your role was successfully edited.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        // جلوگیری از حذف نقش admin
        if ($role->name === 'admin') {
            return back()->with('alert-section-error', 'The admin role cannot be deleted.');
        }
        if ($role->name === 'user') {
            return back()->with('alert-section-error', 'The user role cannot be deleted.');
        }
        $result = $role->Delete();
        return redirect()->route('admin.user.role.index')->with(
            'alert-section-success',
            'Your role was successfully deleted.'
        );
    }
    public function status(Role $role)
    {
        $role->status = $role->status == 0 ? 1 : 0;
        $result = $role->save();
        if ($result) {
            if ($role->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }


    public function permissionForm(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.user.role.permission-form', compact('role', 'permissions'));
    }
    public function permissionUpdate(RoleRequest $request, Role $role)
    {
        $inputs = $request->all();

        $inputs['permissions'] = $inputs['permissions'] ?? [];
        $role->permissions()->sync($inputs['permissions']);

        return redirect()->route('admin.user.role.index')->with(
            'alert-section-success',
            'Accessibility was successfully edited.'
        );
    }
}
