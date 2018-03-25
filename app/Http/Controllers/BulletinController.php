<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bulletin;

class BulletinController extends Controller
{
  public function index()
  {
    $user = auth()->user();
    if ($user->is_superadmin) {
      $bulletins = Bulletin::all();
    }
    $bulletins = Bulletin::where('CompanyID', $user->staff->CompanyID)->get();

    return view('bulletins.index', compact('user', 'bulletins'));
  }

  public function save_bulletin(Request $request)
  {
    $this->validate($request, [
      'Title' => 'required',
      'Body' => 'required',
    ]);

    $bulletin = new Bulletin;
    $bulletin->Title = $request->Title;
    $bulletin->Body = $request->Body;
    $bulletin->CompanyID = $user->staff->CompanyID;
    $bulletin->CreatedBy = $user->id;
    $bulletin->save();

    return redirect()->route('bulletin_board')->with('success', 'New bulletin was saved successfully.');
  }

}
