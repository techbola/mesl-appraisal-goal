<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $table   = 'tblTitle';
    protected $guarded = ['TitleRef'];
    public $timestamps = false;
}
