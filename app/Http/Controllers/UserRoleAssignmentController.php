<?php

namespace Cavidel\Http\Controllers;

use Cavidel\User;
use DB;
use Illuminate\Http\Request;

class UserRoleAssignmentController extends Controller
{
    public function create()
    {
        $users = DB::table('users');
        $roles = DB::table('roles');
        // dd($users);
        return view('role_user.create', compact('users', 'roles'));
    }
    public function store(Request $request)
    {
        $user    = User::find($request->user_id);
        $role_id = $request->role_id;
        if ($user) {
            \DB::table('role_user')->where('user_id', $user->id)->delete();
            // user is present
            $user->roles()->attach($role_id);
            return redirect()->route('roleassignment')->with('success', 'Role assignment was successful');
        }
    }
}
