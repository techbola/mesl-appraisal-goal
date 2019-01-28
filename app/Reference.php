<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'ReferenceID');
    }
}
