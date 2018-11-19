<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class IssueCategory extends Model
{
  protected $table   = 'tblIssueCategories';
  protected $guarded = ['id'];
  // public $timestamps = false;

  public function items()
  {
    return $this->hasMany('Cavi\IssueItem', 'CategoryID');
  }

  public function poster()
  {
    return $this->belongsTo('Cavi\User', 'CreatedBy');
  }

}
