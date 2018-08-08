<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class LitigationFile extends Model
{
    protected $table   = 'tblLitigationFile';
    protected $guarded = ['FileRef'];
    public $primaryKey = 'FileRef';

    public function uploader()
    {
        return $this->belongsTo(User::class, 'UserID');
    }
}
