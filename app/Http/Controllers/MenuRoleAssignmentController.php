<?php

namespace Cavidel\Http\Controllers;

use Cavidel\Role;
use Illuminate\Http\Request;

class MenuRoleAssignmentController extends Controller
{

    public function create()
    {
        $menus = \DB::table('menus');
        $roles = Role::all();
        return view('menu_role.create', compact('menus', 'roles'));
    }
    public function store(Request $request)
    {
        $role        = Role::find($request->role_id);
        $roles_menus = \DB::table('menu_role')->where('role_id', $role->id)->pluck('menu_id');
        $role->menus()->attach(array_diff($request->menus, $roles_menus->toArray()));
        return redirect('/assignmenus')->with('success', 'Menu has been assigned successfully');
    }
}
