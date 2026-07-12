<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{

    public function index()
    {
        $users = User::with('roles')
            ->latest()
            ->get();

        return view('users.index', compact('users'));
    }



    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }



    public function store(Request $request)
    {

        $request->validate([

            'name'=>'required',

            'email'=>'required|email|unique:users',

            'password'=>'required|min:6',

            'role'=>'required'

        ]);



        $user = User::create([

            'name'=>$request->name,

            'email'=>$request->email,

            'password'=>Hash::make($request->password),

        ]);



        // Assign Role
        $user->assignRole($request->role);



        return redirect()
            ->route('users.index')
            ->with('success','User created successfully');

    }





    public function edit(string $id)
    {

        $user = User::findOrFail($id);

        $roles = Role::all();


        return view('users.edit',compact(
            'user',
            'roles'
        ));

    }




    public function update(Request $request,string $id)
    {

        $request->validate([

            'name'=>'required',

            'email'=>'required|email',

            'role'=>'required'

        ]);



        $user = User::findOrFail($id);



        $user->update([

            'name'=>$request->name,

            'email'=>$request->email,

        ]);



        // Update Role

        $user->syncRoles([
            $request->role
        ]);



        return redirect()
            ->route('users.index')
            ->with('success','User updated successfully');

    }





    public function destroy(string $id)
    {

        $user = User::findOrFail($id);

        $user->delete();


        return redirect()
            ->route('users.index')
            ->with('success','User deleted successfully');

    }

}