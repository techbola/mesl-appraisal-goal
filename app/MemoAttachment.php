<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class MemoAttachment extends Model
{
    protected $guarded = ['id'];

    public function memo()
    {
        return $this->belongsTo(Memo::class);
    }
}
