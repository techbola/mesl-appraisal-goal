<?php

namespace Cavi\Http\Controllers;

use Illuminate\Http\Request;
use Cavi\StickyNote;
use Cavi\StickyNoteChecklist;

class StickyNoteController extends Controller
{
  public function index()
  {
    $user = auth()->user();
    return view('notes.index', compact('user'));
  }

  public function store(Request $request)
  {

    // return $request->Checklist;
    $note = new StickyNote;
    $note->Title = trim($request->Title);
    $note->Body = $request->Body;
    $note->Color = $request->Color;
    $note->UserID = auth()->user()->id;
    $note->save();

    foreach ($request->Checklist as $check) {
      $ch = new StickyNoteChecklist;
      $ch->Title = $check['title'];
      $ch->Checked = $check['checked'];
      $ch->NoteID = $note->NoteRef;
      $ch->save();
    }

    return $note->Title.' saved.';
  }

  public function delete(Request $request, $id)
  {
    $note = StickyNote::find($id);
    $note->delete();
    return redirect()->back()->with('success', 'Note deleted successfully');
  }

  // public function store_checklist(Request $request, $note_id)
  // {
  //   $note = StickyNote::find($id);
  // }

  public function get_note($id)
  {
    $note = StickyNote::find($id);
    return $note;
  }

  public function update(Request $request, $id)
  {

    // return $request->Checklist;
    $note = StickyNote::find($id);
    $note->Title = trim($request->Title);
    $note->Body = $request->Body;
    // $note->Color = $request->Color;
    // $note->UserID = auth()->user()->id;
    $note->update();

    return redirect()->back()->with('success', 'Note update successfully');
  }

  public function toggle_checklist($id)
  {
    $check = StickyNoteChecklist::find($id);
    if ($check->Checked == '1') {
      $check->Checked = '0';
    } else {
      $check->Checked = '1';
    }
    $check->update();
  }

}
