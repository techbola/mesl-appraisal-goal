<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class IssueItem extends Model
{
  protected $table   = 'tblIssueItems';
  protected $guarded = ['id'];
  // public $timestamps = false;

  public function category()
  {
    return $this->belongsTo('Cavidel\IssueCategory', 'CategoryID');
  }

  public function project()
  {
    return $this->belongsTo('Cavidel\Project', 'ProjectID');
  }

  public function poster()
  {
    return $this->belongsTo('Cavidel\User', 'CreatedBy');
  }

}
