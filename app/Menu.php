<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Menu extends Model
{
    protected $guarded = ['id'];
    // protected $connection = 'conn2';

    public function parent()
    {
        return $this->hasOne('App\Menu', 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Menu', 'parent_id', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function abbreviation($arr)
    {
        $splitted = explode(' ', $arr);
        foreach ($splitted as $abbr) {
            return substr($abbr, 0, 2);
        }
    }

    public function hasSubmenu($menu_id)
    {
        $user = Auth::user();
        $system = Menu::where('name', 'System Setup')->first();

        $menu = Menu::find($menu_id);
        if ($user->is_superadmin || auth()->user()->hasRole('admin'))
          $user_submenus = Menu::where('parent_id', $menu_id)->get();
        elseif(auth()->user()->hasRole('admin'))
          $user_submenus = Menu::where('parent_id', $menu_id)->where('parent_id', '!=', $system->id)->get();
        else
          $user_submenus = \Auth::user()->roles()->first()->menus->where('parent_id', $menu_id);


        // if ($menu->children->count() > 0) {
        if ($user_submenus->count() > 0) {
            echo "<ul class=\"sub-menu\">";
            foreach ($user_submenus as $key => $child) {
                if ($child->children()->count() > 0) {
                    echo '<li><a href="javascript:;">' .
                    '<span class="top-level title">' . $child->name . '</span>' .
                    '<span class="arrow"></span></a>' .
                    '<span class="icon-thumbnail">' . $this->abbreviation($child->name) . '</span>';
                } else {
                    if ($child->route == null || $child->route == '#') {
                        echo '<li><a href="javascript:;">' . $child->name . '</a>';
                        echo '<span class="icon-thumbnail">' . $this->abbreviation($child->name) . '</span>';
                    } else {
                        // echo '<li>' . link_to_route($child->route, $title = $child->name, $parameters = array(), $attributes = array());
                        echo '<li><a href="'.route($child->route).'">'.$child->name.'</a>';
                        echo '<span class="icon-thumbnail">' . $this->abbreviation($child->name) . '</span>';
                    }

                }
                $this->hasSubmenu($child->id);
                echo "</li>";
            }
            echo "</ul>";
        } else {
            return null;
        }
    }

    // ASSESSORS
    public function getRoleNamesAttribute(){
      $menu_roles = $this->roles->pluck('name');
      foreach ($menu_roles as $role) {
        $role_names[] = $role;
      }
      if(!empty($role_names) > 0)
        return implode($role_names, ', ');
      else
        return '—';
    }

}
