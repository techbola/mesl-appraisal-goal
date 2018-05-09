<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bulletin;
use App\User;
use Carbon\Carbon;

use App\Notifications\NewBulletin;
use Notification;

class BulletinController extends Controller
{
  public function index()
  {
    $user = auth()->user();
    if ($user->is_superadmin) {
      $bulletins = Bulletin::paginate(10);
    }
    $bulletins = Bulletin::where('CompanyID', $user->staff->CompanyID)->orderBy('BulletinRef', 'desc')->paginate(10);

    return view('bulletins.index', compact('user', 'bulletins'));
  }

  public function save_bulletin(Request $request)
  {
    $user = auth()->user();
    $all = User::whereHas('staff', function($query) use($user) {
      $query->where('CompanyID', $user->staff->CompanyID);
    })->get();

    $this->validate($request, [
      'Title' => 'required',
      'Body' => 'required',
    ]);

    $bulletin = new Bulletin;
    $bulletin->Title = $request->Title;
    $bulletin->Body = $request->Body;
    $bulletin->CompanyID = $user->staff->CompanyID;
    $bulletin->CreatedBy = $user->id;
    $bulletin->CreatedDate = Carbon::now();

    $bulletin->save();


    Notification::send($all, new NewBulletin($bulletin));

    return redirect()->route('bulletin_board')->with('success', 'New bulletin was saved successfully.');
  }

  public function view_bulletin($id)
  {
    return $this->index();
  }

}
