<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class IssueCategory extends Model
{
  protected $table   = 'tblIssueCategories';
  protected $guarded = ['id'];
  // public $timestamps = false;

  public function items()
  {
    return $this->hasMany('Cavidel\IssueItem', 'CategoryID');
  }

  public function poster()
  {
    return $this->belongsTo('Cavidel\User', 'CreatedBy');
  }

}
