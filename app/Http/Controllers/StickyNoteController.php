<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\StickyNote;

class StickyNoteController extends Controller
{
  public function index()
  {
    $user = auth()->user();
    return view('notes.index', compact('user'));
  }

  public function store(Request $request)
  {
    $note = new StickyNote;
    $note->Title = trim($request->Title);
    $note->Body = $request->Body;
    $note->Color = $request->Color;
    $note->UserID = auth()->user()->id;
    $note->save();
    return $note->Title.' saved.';
  }

public function delete(Request $request, $id)
{
  $note = StickyNote::find($id);
  $note->delete();
  return redirect()->back()->with('success', 'Note deleted successfully');
}

}