<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class StickyNote extends Model
{
  protected $table   = 'tblStickyNotes';
  protected $guarded = ['NoteRef'];
  public $primaryKey = 'NoteRef';
}
