<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class TestScore extends Model
{
    protected $table   = 'tblTestScores';
    protected $guarded = ['TestScoreRef'];
    public $timestamps = false;
}
