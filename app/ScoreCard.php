<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class ScoreCard extends Model
{
  protected $table      = 'tblScoreCard';
  protected $guarded    = ['ScoreCardRef'];
  protected $primaryKey = 'ScoreCardRef';

}
