<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class CourseBatch extends Model
{
    protected $table   = 'tblCourseBatch';
    protected $guarded = ['batch_ref'];
    public $primaryKey = 'batch_ref';
    public $timestamps = false;
}
