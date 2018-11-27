<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class IssueItem extends Model
{
  protected $table   = 'tblIssueItems';
  protected $guarded = ['id'];
  // public $timestamps = false;

  public function category()
  {
    return $this->belongsTo('MESL\IssueCategory', 'CategoryID');
  }

  public function project()
  {
    return $this->belongsTo('MESL\Project', 'ProjectID');
  }

  public function poster()
  {
    return $this->belongsTo('MESL\User', 'CreatedBy');
  }

}
