<?php

namespace MESL\Http\Controllers;

use MESL\Role;
use MESL\Company;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user  = auth()->user();
        $roles = Role::where('CompanyID', $user->staff->CompanyID)->get();
        return view('roles.index', compact('roles'));
    }
    public function create()
    {
        $user      = auth()->user();
        $roles     = Role::where('CompanyID', $user->staff->CompanyID)->get();
        $companies = Company::all();
        return view('roles.create', compact('roles', 'companies'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles|max:255',
        ]);

        $role               = new Role;
        $role->name         = strtolower($request->name);
        $role->display_name = $request->display_name;
        $role->description  = $request->description;
        if (auth()->user()->is_superadmin) {
            $role->CompanyID = $request->CompanyID;
        } else {
            $role->CompanyID = auth()->user()->staff->company->CompanyRef;
        }
        // $menus = Menu::whereIn('slug', ['projects'])->get();

        // Let this role have same menus as basic "staff"

        if ($role->save()) {
            $menus = Role::where('name', 'staff')->first()->menus;
            $role->menus()->attach($menus->pluck('id')->toArray());

            return redirect()->back()->with('success', $role->name . ' has been added to roles successfully.');
        } else {
            return redirect()->back()->withInput()->with('danger', $role->name . ' was not added to roles');
        }
    }

    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $role      = Role::find($id);
        $companies = Company::all();
        return view('roles.edit', compact('role', 'companies'));
    }
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        if ($role->update($request->all())) {
            return redirect('/roles/create')->with('success', $role->name . ' has been updated successfully.');
        } else {
            return redirect('/roles/create')->withInput()->with('danger', $role->name . ' was not added to roles');
        }
    }
    public function destroy($id)
    {
        //
    }
}
