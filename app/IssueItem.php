<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class IssueItem extends Model
{
  protected $table   = 'tblIssueItems';
  protected $guarded = ['id'];
  // public $timestamps = false;

  public function category()
  {
    return $this->belongsTo('Cavi\IssueCategory', 'CategoryID');
  }

  public function project()
  {
    return $this->belongsTo('Cavi\Project', 'ProjectID');
  }

  public function poster()
  {
    return $this->belongsTo('Cavi\User', 'CreatedBy');
  }

}
