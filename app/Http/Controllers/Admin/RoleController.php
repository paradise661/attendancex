<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;


class RoleController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('view role'), 403);

        $roles = Role::paginate(10);
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        abort_unless(Gate::allows('create role'), 403);

        $permissions = Permission::all();
        $emp = [];
        foreach ($permissions as $permission) {
            $emp[$permission->parent][] = $permission;
        }
        $permissions = $emp;

        return view('admin.role.create', compact('permissions'));
    }


    public function store(RoleRequest $request)
    {
        abort_unless(Gate::allows('create role'), 403);

        $role = Role::create($request->except('permissions'));
        $role->givePermissionTo($request->permission);
        return redirect()->route('roles.index')->with('success', 'Role Created Successfully.');
    }


    public function show($id)
    {
        //
    }

    public function edit(Role $role)
    {
        abort_unless(Gate::allows('edit role'), 403);

        $permissions = Permission::get();

        $emp = [];
        foreach ($permissions as $permission) {
            $emp[$permission->parent][] = $permission;
        }
        $permission = $emp;

        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('admin.role.edit', compact('role', 'permission', 'rolePermissions'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        abort_unless(Gate::allows('edit role'), 403);

        $role->update($request->except('permissions'));
        $role->permissions()->detach();
        $role->givePermissionTo($request->permission);
        return redirect()->route('roles.index')->with('success', 'Role Updated');
    }

    public function destroy(Role $role)
    {
        abort_unless(Gate::allows('delete role'), 403);

        $role->delete();
        $role->permissions()->detach();
        return redirect()->route('roles.index')->with('success', 'Role Deleted');
    }

    public function insertPermission()
    {
        $permissions = [
            [
                'name' => 'view dashboard',
                'guard_name' => 'web',
                'parent' => 'Dashboard',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'view configuration',
                'guard_name' => 'web',
                'parent' => 'Configuration',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'view branch',
                'guard_name' => 'web',
                'parent' => 'Branch',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'create branch',
                'guard_name' => 'web',
                'parent' => 'Branch',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'edit branch',
                'guard_name' => 'web',
                'parent' => 'Branch',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'delete branch',
                'guard_name' => 'web',
                'parent' => 'Branch',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'view department',
                'guard_name' => 'web',
                'parent' => 'Department',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'create department',
                'guard_name' => 'web',
                'parent' => 'Department',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'edit department',
                'guard_name' => 'web',
                'parent' => 'Department',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'delete department',
                'guard_name' => 'web',
                'parent' => 'Department',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'view shift',
                'guard_name' => 'web',
                'parent' => 'Shift',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'create shift',
                'guard_name' => 'web',
                'parent' => 'Shift',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'edit shift',
                'guard_name' => 'web',
                'parent' => 'Shift',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'delete shift',
                'guard_name' => 'web',
                'parent' => 'Shift',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'view leavetype',
                'guard_name' => 'web',
                'parent' => 'Leavetype',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'create leavetype',
                'guard_name' => 'web',
                'parent' => 'Leavetype',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'edit leavetype',
                'guard_name' => 'web',
                'parent' => 'Leavetype',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'delete leavetype',
                'guard_name' => 'web',
                'parent' => 'Leavetype',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'view designation',
                'guard_name' => 'web',
                'parent' => 'Designation',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'create designation',
                'guard_name' => 'web',
                'parent' => 'Designation',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'edit designation',
                'guard_name' => 'web',
                'parent' => 'Designation',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'delete designation',
                'guard_name' => 'web',
                'parent' => 'Designation',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'view publicholiday',
                'guard_name' => 'web',
                'parent' => 'PublicHoliday',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'create publicholiday',
                'guard_name' => 'web',
                'parent' => 'PublicHoliday',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'edit publicholiday',
                'guard_name' => 'web',
                'parent' => 'PublicHoliday',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'delete publicholiday',
                'guard_name' => 'web',
                'parent' => 'PublicHoliday',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'view role',
                'guard_name' => 'web',
                'parent' => 'Role',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'create role',
                'guard_name' => 'web',
                'parent' => 'Role',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'edit role',
                'guard_name' => 'web',
                'parent' => 'Role',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'delete role',
                'guard_name' => 'web',
                'parent' => 'Role',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'view setting',
                'guard_name' => 'web',
                'parent' => 'Setting',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'update setting',
                'guard_name' => 'web',
                'parent' => 'Setting',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'change password',
                'guard_name' => 'web',
                'parent' => 'Setting',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'view employee',
                'guard_name' => 'web',
                'parent' => 'Employee',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'create employee',
                'guard_name' => 'web',
                'parent' => 'Employee',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'edit employee',
                'guard_name' => 'web',
                'parent' => 'Employee',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'delete employee',
                'guard_name' => 'web',
                'parent' => 'Employee',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'view appnotice',
                'guard_name' => 'web',
                'parent' => 'App_Notice',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'create appnotice',
                'guard_name' => 'web',
                'parent' => 'App_Notice',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'edit appnotice',
                'guard_name' => 'web',
                'parent' => 'App_Notice',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'delete appnotice',
                'guard_name' => 'web',
                'parent' => 'App_Notice',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'view attendancerequest',
                'guard_name' => 'web',
                'parent' => 'Attendance_Request',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'filter attendancerequest',
                'guard_name' => 'web',
                'parent' => 'Attendance_Request',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'manage attendancerequest',
                'guard_name' => 'web',
                'parent' => 'Attendance_Request',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'view leaverequest',
                'guard_name' => 'web',
                'parent' => 'Leave_Request',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'filter leaverequest',
                'guard_name' => 'web',
                'parent' => 'Leave_Request',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'manage leaverequest',
                'guard_name' => 'web',
                'parent' => 'Leave_Request',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'view notification',
                'guard_name' => 'web',
                'parent' => 'Notification',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'view attendance',
                'guard_name' => 'web',
                'parent' => 'Attendance',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'view allemployeesattendance',
                'guard_name' => 'web',
                'parent' => 'Attendance',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'filter allemployeesattendance',
                'guard_name' => 'web',
                'parent' => 'Attendance',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'view individualemployeeattendance',
                'guard_name' => 'web',
                'parent' => 'Attendance',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'filter individualemployeeattendance',
                'guard_name' => 'web',
                'parent' => 'Attendance',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        Permission::insert($permissions);
    }

    public function insertRole()
    {
        $role_admin = Role::create(['name' => 'SUPER-ADMIN']);
        $role_user = Role::create(['name' => 'ADMIN']);

        $user = User::find(1);
        $user->assignRole($role_admin);
        $role_admin->givePermissionTo(Permission::all());
    }
}
