<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class ScoreCard extends Model
{
  protected $table      = 'tblScroreCard';
  protected $guarded    = ['ScoreCardRef'];
  protected $primaryKey = 'ScoreCardRef';
}
