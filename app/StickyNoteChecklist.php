<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class StickyNoteChecklist extends Model
{
  protected $table   = 'tblStickyNoteChecklist';
  protected $guarded = ['id'];
  public $primaryKey = 'id';
}
