<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    public function memos()
    {
        return $this->belongsTo(Staff::class);
    }
}
