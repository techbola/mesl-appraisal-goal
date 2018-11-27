<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
  protected $table   = 'tblProjectFiles';
  protected $guarded = ['FileRef'];
  public $primaryKey = 'FileRef';

  public function uploader()
  {
    return $this->belongsTo(User::class, 'UserID');
  }
}
