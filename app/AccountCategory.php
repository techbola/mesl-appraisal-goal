<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class AccountCategory extends Model
{
    protected $table   = 'tblAccountCategory';
    protected $guarded = ['AccountCategoryRef'];
    public $timestamps = false;

    public function account_groups(){
      return $this->hasMany('Cavi\AccountGroup', 'AccountCategoryID', 'AccountCategoryRef');
    }
}
