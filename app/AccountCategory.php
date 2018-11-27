<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class AccountCategory extends Model
{
    protected $table   = 'tblAccountCategory';
    protected $guarded = ['AccountCategoryRef'];
    public $timestamps = false;

    public function account_groups(){
      return $this->hasMany('MESL\AccountGroup', 'AccountCategoryID', 'AccountCategoryRef');
    }
}
