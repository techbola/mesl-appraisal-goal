<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    protected $table      = 'tblCourt';
    protected $primaryKey = 'CourtRef';

    protected $fillable = ['Court', 'Location'];
}
