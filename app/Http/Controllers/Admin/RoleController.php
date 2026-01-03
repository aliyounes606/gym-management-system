<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('admin.roles.index', compact('roles'));
    }
    /**
     * Summary of create
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $permissions = Permission::all(); // لجلب كل الصلاحيات واختيارها للفورم
        return view('admin.roles.create', compact('permissions'));
    }
    /**
     * Summary of store
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:roles,name', 'permissions' => 'array']);

        $role = Role::create(['name' => $request->name]);
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions); // ربط الصلاحيات المختارة
        }

        return redirect()->route('roles.index')->with('success', 'تم إنشاء الرتبة بنجاح');
    }
    /**
     * Summary of edit
     * @param \Spatie\Permission\Models\Role $role
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray(); // الصلاحيات التي تملكها الرتبة حالياً
        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }
    /**
     * Summary of update
     * @param \Illuminate\Http\Request $request
     * @param \Spatie\Permission\Models\Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Role $role)
    {
        $request->validate(['name' => 'required|unique:roles,name,' . $role->id]);

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'تم التحديث');
    }
    /**
     * Summary of destroy
     * @param \Spatie\Permission\Models\Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Role $role)
    {
        if ($role->name === 'admin') {
            return back()->with('error', 'لا يمكن حذف دور المدير الأساسي!');
        }

        $role->delete();

        return redirect()->route('roles.index')->with('success', 'تم حذف الدور بنجاح');
    }
}
