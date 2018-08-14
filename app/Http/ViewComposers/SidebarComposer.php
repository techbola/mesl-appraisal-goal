<?php

namespace Cavidel\Http\ViewComposers;

// use Cavidel\User;
use Cavidel\Menu;
use Illuminate\View\View;

class SidebarComposer
{
    // public $user
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $user  = \Auth::user();
        $roles = \DB::table('roles')->pluck('id', 'name');
        $system = Menu::where('name', 'System Setup')->first();
        $menus = Menu::where('parent_id', 0)->get();
        $dashboard = Menu::where('name', 'Dashboard')->first();

        // If user has roles, return their parent and child menus
        if($user->is_superadmin){
          $parent_menus = Menu::where('parent_id', 0)->with('children')->orderBy('name')->get();
          $child_menus = Menu::where('parent_id', '!=', 0)->with('children')->orderBy('name')->get();
        } elseif (auth()->user()->hasRole('admin')) {
          // dd('HELLO');
          // $parent_menus = Menu::where('parent_id', 0)->get();
          // $child_menus = Menu::where('parent_id', '!=', 0)->get();
          $parent_menus = Menu::where('parent_id', 0)->where('id', '!=', $system->id)->orderBy('name')->get();
          $child_menus = Menu::where('parent_id', '!=', 0)->where('parent_id', '!=', $system->id)->orderBy('name')->get();
        } elseif (count($user->roles) > 0) {
            $parent_menus = $user->roles()->first()->menus->where('parent_id', 0)->orderBy('name')->get();
            $child_menus = $user->roles()->first()->menus->where('parent_id', '!=', 0)->orderBy('name')->get();
        } else {

            $parent_menus = Menu::where('parent_id', 0)->with('children')->orderBy('name')->get();
            $child_menus = [];
        }
        // $view->with('parent_menus', $parent_menus);
        $view->with( compact('parent_menus', 'child_menus', 'menus', 'dashboard') );
    }
}
