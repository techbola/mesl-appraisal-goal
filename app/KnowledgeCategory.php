<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KnowledgeCategory extends Model
{
  protected $table   = 'tblKnowledgeCategories';
  protected $guarded = ['id'];
  // public $timestamps = false;

  public function items()
  {
    return $this->hasMany('App\KnowledgeItem', 'CategoryID');
  }

  public function poster()
  {
    return $this->belongsTo('App\User', 'CreatedBy');
  }

}
