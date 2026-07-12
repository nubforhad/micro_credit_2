<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{


    public function index()
    {

        $roles = Role::with('permissions')
            ->latest()
            ->get();


        return view('roles.index', compact('roles'));

    }





    public function create()
    {

        $permissions = Permission::orderBy('name')
            ->get();


        return view('roles.create', compact('permissions'));

    }





    public function store(Request $request)
    {

        $request->validate([

            'name'=>'required|unique:roles,name',

            'permissions'=>'nullable|array'

        ]);



        $role = Role::create([

            'name'=>$request->name,

            'guard_name'=>'web'

        ]);



        if($request->permissions)
        {

            $role->syncPermissions(
                $request->permissions
            );

        }



        return redirect()
            ->route('roles.index')
            ->with('success','Role created successfully');


    }







    public function edit(string $id)
    {

        $role = Role::findOrFail($id);


        $permissions = Permission::orderBy('name')
            ->get();



        return view('roles.edit',
        compact(
            'role',
            'permissions'
        ));

    }







    public function update(Request $request,string $id)
    {

        $request->validate([

            'name'=>'required',

            'permissions'=>'nullable|array'

        ]);



        $role = Role::findOrFail($id);



        // Update Role Name

        $role->update([

            'name'=>$request->name

        ]);



        // Update Permission

        $role->syncPermissions(
            $request->permissions ?? []
        );



        return redirect()
            ->route('roles.index')
            ->with('success','Role updated successfully');


    }







    public function destroy(string $id)
    {


        $role = Role::findOrFail($id);



        // Protect Default Roles

        if(in_array($role->name,[

            'Admin',
            'Super Admin'

        ]))
        {

            return back()
            ->with('error',
            'Default role cannot be deleted');

        }



        $role->delete();



        return redirect()
            ->route('roles.index')
            ->with('success',
            'Role deleted successfully');


    }



}