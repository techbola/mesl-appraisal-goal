<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class CallMemoDiscussion extends Model
{
  protected $table   = 'tblCallMemoDiscussion';
  protected $guarded = ['id'];
  public $primaryKey   = 'id';


  public function actions()
  {
    return $this->hasMany('MESL\CallMemoAction', 'DiscussionID');
  }

}
