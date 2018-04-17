<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueCategory extends Model
{
  protected $table   = 'tblIssueCategories';
  protected $guarded = ['id'];
  // public $timestamps = false;

  public function items()
  {
    return $this->hasMany('App\IssueItem', 'CategoryID');
  }

  public function poster()
  {
    return $this->belongsTo('App\User', 'CreatedBy');
  }

}
