<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountCategory extends Model
{
    protected $table   = 'tblAccountCategory';
    protected $guarded = ['AccountCategoryRef'];
    public $timestamps = false;

    public function account_groups(){
      return $this->hasMany('App\AccountGroup', 'AccountCategoryID', 'AccountCategoryRef');
    }
}
