<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

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
        'password', 'remember_token',
    ];

    public function staff()
    {
        return $this->hasOne('App\Staff', 'UserID');
    }
    // public function type()
    // {
    //   return $this->belongsToMany('App\UserType', 'user_id', 'type_id');
    // }
    public function types()
    {
        return $this->belongsToMany('App\UserType', 'usertype', 'user_id', 'type_id');
    }
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    }
    public function inbox()
    {
        return $this->belongsToMany('App\Message', 'tblMessageRecipients', 'UserID', 'MessageID')->orderBy('MessageRef', 'desc')->withPivot('IsRead', 'IsDeleted');
    }
    public function sent_messages()
    {
        return $this->hasMany('App\Message', 'FromID')->orderBy('MessageRef', 'desc');
    }
    public function unread_inbox()
    {
        return $this->hasMany('App\MessageRecipient', 'UserID')->where('IsRead', false);
    }

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
        // if ($this->is_superadmin) {
        //   # code...
        // }
        // return '/images/avatars/'.$
    }

    public function getCompanyIDAttribute()
    {
        return $this->staff->CompanyID;
    }

    public function tasks()
    {

    }

    public function todos()
    {
      return $this->hasMany('App\Todo', 'UserID')->orderBy('DueDate');
    }

    // relationship for staff payroll details

}
