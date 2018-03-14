<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectChat extends Model
{
  protected $table   = 'tblProjectChat';
  protected $guarded = ['ChatRef'];
  public $primaryKey = 'ChatRef';

  public function staff()
  {
    return $this->belongsTo('App\Staff', 'StaffID', 'StaffRef');
  }
}
