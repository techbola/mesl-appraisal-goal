<?php
namespace Cavi;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{

    protected $guarded = ['id'];
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::updating(function ($role) {
    //         $role->created_by = Auth::user()->id;
    //         $role->updated_by = Auth::user()->id;
    //     });
    // }
    public function menus()
    {
        return $this->belongsToMany('Cavi\Menu');
    }
    public function users()
    {
        return $this->belongsToMany('Cavi\User');
    }
    public function company()
    {
        return $this->belongsTo('Cavi\Company', 'CompanyID', 'CompanyRef');
    }

}
