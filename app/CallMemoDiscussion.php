<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class CallMemoDiscussion extends Model
{
  protected $table   = 'tblCallMemoDiscussion';
  protected $guarded = ['id'];
  public $primaryKey   = 'id';


  public function actions()
  {
    return $this->hasMany('Cavi\CallMemoAction', 'DiscussionID');
  }

}
