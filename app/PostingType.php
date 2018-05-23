<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class PostingType extends Model
{
    protected $table   = 'tblPostingType';
    protected $guarded = ['PostingTypeRef'];
    public $timestamps = false;
}
