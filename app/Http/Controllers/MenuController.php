<?php

namespace Cavidel\Http\Controllers;

use Cavidel\Http\Requests\MenuRequest;
use Cavidel\Menu;
use Cavidel\Role;
use DB;
use Event;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      $menus = Menu::all();
      $roles = Role::all();
      $routeCollection = \Route::getRoutes();
      $routeArray      = array();

      foreach ($routeCollection as $key => $value) {
          array_push($routeArray, $value->getName());
      }
      $routes = array_filter($routeArray, function ($var) {return !is_null($var);});
      return view('menus.index', compact('menus','routes', 'roles'));
    }


    public function create()
    {

    }


    public function store(MenuRequest $request)
  {
      // $menu = Menu::create(request()->all());

      try {
        DB::beginTransaction();
          $menu = new Menu();
          $menu->name = $request->name;
          $menu->route = $request->route;
          $menu->parent_id = $request->parent_id;
          $menu->description = $request->description;
          $menu->save();

          if ($menu) {

              // Save menu roles
              $menu_roles = \DB::table('menu_role')->where('menu_id', $menu->id)->pluck('role_id');
              if(count($request->roles) > 0)
              $menu->roles()->attach(array_diff($request->roles, $menu_roles->toArray()));

              DB::commit();

              return redirect()->back()->with('success', 'Menu Added successfully');
          } else {
              return redirect()->back()->withInput()->with('error', 'Menu not created, make sure all fields are filled');
          }

      } catch (Exception $e) {
        DB::rollback();
        return redirect()->back()->withInput()->with('error', 'Menu not created, please try again.');
      }

  }


  public function show($id)
  {
      //
  }


  public function edit($id)
  {
      $menu  = Menu::find($id);
      $menus = Menu::all();
      $roles = Role::all();
      $routeCollection = \Route::getRoutes();
      $routeArray      = array();

      foreach ($routeCollection as $key => $value) {
          array_push($routeArray, $value->getName());
      }
      $routes = array_filter($routeArray, function ($var) {return !is_null($var);});
      return view('menus.edit', compact('menu', 'menus','routes', 'roles'));
  }


  public function update(Request $request, $id)
  {
    // dd($request->roles);
    try {
      DB::beginTransaction();
        $menu = Menu::find($id);
        $menu->name = $request->name;
        $menu->route = $request->route;
        $menu->parent_id = $request->parent_id;
        $menu->description = $request->description;
        $menu->save();


        // Save menu roles
        // $menu_roles = \DB::table('menu_role')->where('menu_id', $menu->id)->pluck('role_id');
        $menu->roles()->detach();
        $menu->roles()->attach($request->roles);
        // $menu->roles()->attach(array_diff($request->roles, $menu_roles->toArray()));

        DB::commit();
        return redirect()->route('menus.index')->with('success', 'Menu has been updated successfully');


    } catch (Exception $e) {
      DB::rollback();
      return redirect()->back()->withInput()->with('error', 'Menu could not updated, please try again.');
    }

  }


  public function destroy($id)
  {
      $menu = Menu::find($id);
      if ($menu) {

          if (\DB::table('menus')->where('id', $id)->delete()) {

              return redirect('menus/create')->with('success', 'Menu was deleted successfully');
          } else {
              return redirect('menus/create')->with('danger', 'Menu was not deleted');
          }

      }

  }


  public function company_menus()
  {

    $user = auth()->user();
    $menus = Menu::where('slug', '!=', 'system')->orWhere('slug', NULL)->get();
    $roles = Role::where('CompanyID', $user->staff->CompanyID)->get();
    // $routeCollection = \Route::getRoutes();
    // $routeArray      = array();
    //
    // foreach ($routeCollection as $key => $value) {
    //     array_push($routeArray, $value->getName());
    // }
    // $routes = array_filter($routeArray, function ($var) {return !is_null($var);});
    return view('menus.index_company', compact('menus', 'roles'));
  }

  public function edit_company_menu($id)
  {
      $user = auth()->user();
      $menu  = Menu::find($id);
      // $menus = Menu::all();
      $roles = Role::where('CompanyID', $user->staff->CompanyID)->get();
      // $routeCollection = \Route::getRoutes();
      // $routeArray      = array();
      //
      // foreach ($routeCollection as $key => $value) {
      //     array_push($routeArray, $value->getName());
      // }
      // $routes = array_filter($routeArray, function ($var) {return !is_null($var);});
      return view('menus.edit_company', compact('menu', 'menus','routes', 'roles'));
  }


  public function update_company_menu(Request $request, $id)
  {
    $user = auth()->user();


    try {
      DB::beginTransaction();
        $menu = Menu::find($id);
        // $menu->name = $request->name;
        // $menu->route = $request->route;
        // $menu->parent_id = $request->parent_id;
        // $menu->description = $request->description;
        // $menu->save();


        // Save menu roles
        // $menu_roles = \DB::table('menu_role')->where('menu_id', $menu->id)->pluck('role_id');
        $roles = Role::where('CompanyID', $user->staff->CompanyID)->get();
        $menu->roles()->detach($roles->pluck('id'));
        $menu->roles()->attach($request->roles);
        // $menu->roles()->attach(array_diff($request->roles, $menu_roles->toArray()));

        DB::commit();
        return redirect()->route('company_menus')->with('success', 'Menu has been updated successfully');


    } catch (Exception $e) {
      DB::rollback();
      return redirect()->back()->withInput()->with('error', 'Menu could not updated, please try again.');
    }

  }



}
