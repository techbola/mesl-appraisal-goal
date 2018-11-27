<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class IssueCategory extends Model
{
  protected $table   = 'tblIssueCategories';
  protected $guarded = ['id'];
  // public $timestamps = false;

  public function items()
  {
    return $this->hasMany('MESL\IssueItem', 'CategoryID');
  }

  public function poster()
  {
    return $this->belongsTo('MESL\User', 'CreatedBy');
  }

}
