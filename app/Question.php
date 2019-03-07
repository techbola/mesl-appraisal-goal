<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table      = 'tblQuestion';
    protected $guarded    = ['QuestionRef'];
    protected $primaryKey = 'QuestionRef';
    public $timestamps    = false;
}
