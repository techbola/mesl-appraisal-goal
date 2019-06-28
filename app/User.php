<?php

namespace MESL;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use MESL\Menu;
// use Illuminate\Database\Eloquent\SoftDeletes;

use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;
    // use SoftDeletes;
    // use EntrustUserTrait {EntrustUserTrait::restore insteadof SoftDeletes;}
    // use SoftDeletes { SoftDeletes::restore insteadof EntrustUserTrait; }

    // protected $dates = ['deleted_at'];
    protected $with = ['roles'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password', 'remember_token',
    ];

    protected $primaryKey = 'id';

    // protected $database = 'conn2';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'google2fa_secret',
    ];

    public $appends = ['FullName'];

    public function staff()
    {
        return $this->hasOne('MESL\Staff', 'UserID');
    }
    // public function type()
    // {
    //   return $this->belongsToMany('MESL\UserType', 'user_id', 'type_id');
    // }
    public function types()
    {
        return $this->belongsToMany('MESL\UserType', 'usertype', 'user_id', 'type_id');
    }
    public function roles()
    {
        return $this->belongsToMany('MESL\Role', 'role_user', 'user_id', 'role_id');
    }
    public function inbox()
    {
        return $this->belongsToMany('MESL\Message', 'tblMessageRecipients', 'UserID', 'MessageID')->orderBy('MessageRef', 'desc')->with('sender')->withPivot('IsRead', 'IsDeleted');
    }
    public function unread_messages()
    {
        return $this->belongsToMany('MESL\Message', 'tblMessageRecipients', 'UserID', 'MessageID')->orderBy('MessageRef', 'desc')->with('sender')->withPivot('IsRead', 'IsDeleted')->wherePivot('IsRead', false);
    }
    public function sent_messages()
    {
        return $this->hasMany('MESL\Message', 'FromID')->orderBy('MessageRef', 'desc');
    }
    public function unread_inbox()
    {
        return $this->hasMany('MESL\MessageRecipient', 'UserID')->where('IsRead', false);
    }
    // Start Chats
    public function unread_chats()
    {
        return $this->hasMany('MESL\Chat', 'ToID')->where('IsRead', false);
    }
    public function unread_chats_from($id)
    {
        // return $this->hasMany('MESL\Chat', 'ToID')->where('IsRead', false)->where('FromID', $id)->get();
        return $this->unread_chats()->where('FromID', $id)->get();
    }
    // End Chats

    public function abbreviation($string)
    {
        $splitted = explode(' ', $string);
        if (count($splitted) > 1) {
            return substr($splitted[0], 0, 1) . ' ' . substr($splitted[1], 0, 1);
        } else {
            return substr($splitted[0], 0, 1) . ' ' . substr($splitted[0], 1, 1);
        }
    }

    public function getFullNameAttribute()
    {
        if (!empty($this->first_name) && !empty($this->last_name)) {
            return $this->first_name . ' ' . $this->last_name;
        }

    }

    public function getShortNameAttribute()
    {
        if (!empty($this->first_name) && !empty($this->last_name)) {
            return $this->first_name . ' ' . substr($this->last_name, 0, 1);
        }

    }

    // public function getAvatarLightAttribute()
    // {
    //   return $this->avatar ?? 'default2.png';
    // }

    // public function getAvatarAttribute($value)
    // {
    //   return $value ?? 'default.png';
    // }
    public function avatar()
    {
        return $this->avatar ?? 'default.png';
    }
    public function avatar_light()
    {
        return $this->avatar ?? 'default2.png';
    }
    public function avatar_url()
    {
        return url('/') . '/images/avatars/' . ($this->avatar ?? 'default.png');
    }

    public function getCompanyIDAttribute()
    {
        return $this->staff->CompanyID;
    }

    public function todos()
    {
        return $this->hasMany('MESL\Todo', 'UserID')->orderBy('DueDate', 'desc');
    }

    public function sticky_notes()
    {
        return $this->hasMany('MESL\StickyNote', 'UserID')->orderBy('created_at', 'desc');
    }

    public function menus()
    {
        $roles = $this->roles()->pluck('role_id')->toArray();
        // dd($roles);
        $menus = Menu::whereHas('roles', function ($query) use ($roles) {
            $query->whereIn('id', $roles);
        })->get();

        return $menus;
    }

    public function menu_routes()
    {
        $routes = $this->menus()->pluck('route')->toArray();
        $routes = array_diff($routes, ['#']);
        return $routes;
    }

    // Stan: Override Entrust's hasRole with this faster one
    public function hasRole($checkrole)
    {
        foreach ($this->roles as $role) {
            $roles[] = $role->name;
        }
        return array_intersect((array) $checkrole, $roles);
    }

    public function level()
    {
        return $this->belongsTo('App\Level', 'level_id');
    }

}
