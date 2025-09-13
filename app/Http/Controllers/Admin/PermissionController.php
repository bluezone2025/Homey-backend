<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('haveRole:role.permission');

    }
    public function index($id){

        $role = Role::findOrFail($id);

        $permissionChecked =  $role->permissions ? $role->permissions->map->name->all() : [];

        $permissions = Permission::get(['id' , 'name']);


        return view('admin.pages.permission.index')->with([
            'permissions'      => $permissions,
            'permissionChecked' => $permissionChecked,
            'role'               => $role,
        ]);
    }


    public function update($id)
    {

        $role = Role::findOrFail($id);

        $role->permissions()->sync(request('role_id'));

        return back()->with('success' , __('form.response.update permissions'));
    }
}
