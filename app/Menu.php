<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Menu extends Model
{
    protected $guarded = ['id'];
    // protected $connection = 'conn2';

    public function parent()
    {
        return $this->hasOne('MESL\Menu', 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('MESL\Menu', 'parent_id', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany('MESL\Role');
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
        $user   = Auth::user();

        if ($user->is_superadmin || $user->hasRole('admin')) {
            $user_submenus = Menu::where('parent_id', $menu_id)->with('children')->orderBy('name')->get();
        } else {
            // $user_submenus = \Auth::user()->roles()->first()->menus->where('parent_id', $menu_id)->sortBy('name');
            $roles = \Auth::user()->roles()->pluck('role_id')->toArray();
            $user_submenus = Menu::whereHas('roles', function($query) use($roles){
              $query->whereIn('id', $roles);
            })->where('parent_id', $menu_id)->get();
        }

        // if ($menu->children->count() > 0) {
        if (count($user_submenus) > 0) {
            echo "<ul class=\"sub-menu\">";
            foreach ($user_submenus as $key => $child) {
                // if (count($child->children) > 0) {
                //     echo '<li><a href="javascript:;">' .
                //     '<span class="top-level title">' . $child->name . '</span>' .
                //     '<span class="arrow"></span></a>' .
                //     '<span class="icon-thumbnail">' . $this->abbreviation($child->name) . '</span>';
                // } else {
                    if ($child->route == null || $child->route == '#') {
                        echo '<li><a href="javascript:;">' . $child->name . '</a>';
                        // echo '<span class="icon-thumbnail">' . $this->abbreviation($child->name) . '</span>';
                    } else {
                        // echo '<li>' . link_to_route($child->route, $title = $child->name, $parameters = array(), $attributes = array());
                        echo '<li><a href="' . route($child->route) . '">' . $child->name . '</a>';
                        // echo '<span class="icon-thumbnail">' . $this->abbreviation($child->name) . '</span>';
                    }

                // }

                // $this->hasSubmenu($child->id);
                echo "</li>";
            }
            echo "</ul>";
        } else {
            return null;
        }
    }

    public function user_submenus()
    {
      $user   = Auth::user();

      if ($user->is_superadmin || $user->hasRole('admin')) {
          $subs = Menu::where('parent_id', $this->id)->with('children')->orderBy('name')->get();
      } else {
          $subs = \Auth::user()->roles()->first()->menus->where('parent_id', $this->id)->sortBy('name');
      }
      return $subs;
    }

    // ASSESSORS
    public function getRoleNamesAttribute()
    {
        $menu_roles = $this->roles->pluck('name');
        foreach ($menu_roles as $role) {
            $role_names[] = $role;
        }
        if (!empty($role_names) > 0) {
            return implode($role_names, ', ');
        } else {
            return '—';
        }

    }
    public function getCompanyRoleNamesAttribute()
    {
        $user = auth()->user();
        // dd($user->staff->CompanyID);
        $menu_roles = $this->roles->where('CompanyID', $user->staff->CompanyID)->pluck('name');
        foreach ($menu_roles as $role) {
            $role_names[] = $role;
        }
        if (!empty($role_names) > 0) {
            return implode($role_names, ', ');
        } else {
            return '—';
        }

    }

}
