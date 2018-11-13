<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class StickyNote extends Model
{
  protected $table   = 'tblStickyNotes';
  protected $guarded = ['NoteRef'];
  public $primaryKey = 'NoteRef';


  public function checklists()
  {
    return $this->hasMany('Cavi\StickyNoteChecklist', 'NoteID');
  }
}
