<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueItem extends Model
{
  protected $table   = 'tblIssueItems';
  protected $guarded = ['id'];
  // public $timestamps = false;

  public function category()
  {
    return $this->belongsTo('App\IssueCategory', 'CategoryID');
  }

  public function poster()
  {
    return $this->belongsTo('App\User', 'CreatedBy');
  }

}
