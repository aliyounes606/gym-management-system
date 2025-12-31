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

    public function create()
    {
        $permissions = Permission::all(); // لجلب كل الصلاحيات واختيارها للفورم
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:roles,name', 'permissions' => 'array']);

        $role = Role::create(['name' => $request->name]);
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions); // ربط الصلاحيات المختارة
        }

        return redirect()->route('roles.index')->with('success', 'تم إنشاء الرتبة بنجاح');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray(); // الصلاحيات التي تملكها الرتبة حالياً
        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate(['name' => 'required|unique:roles,name,' . $role->id]);

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'تم التحديث');
    }
    public function destroy(Role $role)
    {
        if ($role->name === 'admin') {
            return back()->with('error', 'لا يمكن حذف دور المدير الأساسي!');
        }

        $role->delete();

        return redirect()->route('roles.index')->with('success', 'تم حذف الدور بنجاح');
    }
}
