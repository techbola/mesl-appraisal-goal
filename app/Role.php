<?php
namespace MESL;

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
        return $this->belongsToMany('MESL\Menu');
    }
    public function users()
    {
        return $this->belongsToMany('MESL\User');
    }
    public function company()
    {
        return $this->belongsTo('MESL\Company', 'CompanyID', 'CompanyRef');
    }

}
