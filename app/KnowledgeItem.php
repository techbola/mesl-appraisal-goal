<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KnowledgeItem extends Model
{
  protected $table   = 'tblKnowledgeItems';
  protected $guarded = ['id'];
  // public $timestamps = false;
}
