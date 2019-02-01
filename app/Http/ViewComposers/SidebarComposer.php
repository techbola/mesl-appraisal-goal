<?php

namespace MESL\Http\ViewComposers;

// use MESL\User;
use MESL\Menu;
use Illuminate\View\View;
use Route;

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
        $current_menu = Menu::where('route', Route::currentRouteName())->first();
        $current_parent = (!empty($current_menu))? Menu::find($current_menu->parent_id) : '';

        // If user has roles, return their parent and child menus
        if($user->is_superadmin){
          $parent_menus = Menu::where('parent_id', 0)->with('children')->orderBy('name')->get();
          $child_menus = Menu::where('parent_id', '!=', 0)->with('children')->orderBy('name')->get();
        } elseif (auth()->user()->hasRole('admin')) {
          // $parent_menus = Menu::where('parent_id', 0)->where('id', '!=', $system->id)->orderBy('name')->get();
          // $child_menus = Menu::where('parent_id', '!=', 0)->where('parent_id', '!=', $system->id)->orderBy('name')->get();
          $parent_menus = Menu::where('parent_id', 0)->orderBy('name')->get();
          $child_menus = Menu::where('parent_id', '!=', 0)->orderBy('name')->get();
        } elseif (count($user->roles) > 0) {
            $roles = \Auth::user()->roles()->pluck('role_id')->toArray();

            $parent_menus = Menu::whereHas('roles', function($query) use($roles){
              $query->whereIn('id', $roles);
            })->where('parent_id', 0)->orderBy('name')->get();
            $child_menus = Menu::whereHas('roles', function($query) use($roles){
              $query->whereIn('id', $roles);
            })->where('parent_id','!=', 0)->orderBy('name')->get();

            // $parent_menus = $user->roles()->first()->menus()->where('parent_id', 0)->orderBy('name')->get();
            // $child_menus = $user->roles()->first()->menus()->where('parent_id', '!=', 0)->orderBy('name')->get();
        } else {

            $parent_menus = Menu::where('parent_id', 0)->with('children')->orderBy('name')->get();
            $child_menus = [];
        }
        // $view->with('parent_menus', $parent_menus);
        $view->with( compact('parent_menus', 'child_menus', 'menus', 'dashboard', 'current_menu', 'current_parent') );
    }
}
