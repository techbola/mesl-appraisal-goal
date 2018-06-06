<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\Bulletin;
use Cavidel\User;
use Carbon\Carbon;
use Cavidel\Department;

use Cavidel\Notifications\NewBulletin;
use Notification;

class BulletinController extends Controller
{
  public function index()
  {
    $today = date('Y-m-d');
    $user = auth()->user();
    $user_departments = explode(',', $user->staff->DepartmentID);

    if ($user->is_superadmin) {
      $bulletins = Bulletin::whereDate('ExpiryDate', '>=', $today)->paginate(10);
    }
    $bulletins = Bulletin::where('CompanyID', $user->staff->CompanyID)->whereIn('DepartmentID', $user_departments)->whereDate('ExpiryDate', '>=', $today)->orderBy('BulletinRef', 'desc')->paginate(10);
    $archives = Bulletin::where('CompanyID', $user->staff->CompanyID)->whereIn('DepartmentID', $user_departments)->whereDate('ExpiryDate', '<', $today)->orderBy('BulletinRef', 'desc')->paginate(10);
    $departments = Department::where('CompanyID', $user->staff->CompanyID)->get();

    return view('bulletins.index', compact('user', 'bulletins', 'archives', 'departments'));
  }

  // public function department_bulletins()
  // {
  //   $today = date('Y-m-d');
  //   $user = auth()->user();
  //   if ($user->is_superadmin) {
  //     $bulletins = Bulletin::whereDate('ExpiryDate', '>=', $today)->paginate(10);
  //   }
  //   $bulletins = Bulletin::where('CompanyID', $user->staff->CompanyID)->whereDate('ExpiryDate', '>=', $today)->orderBy('BulletinRef', 'desc')->paginate(10);
  //   $archives = Bulletin::where('CompanyID', $user->staff->CompanyID)->whereDate('ExpiryDate', '<', $today)->orderBy('BulletinRef', 'desc')->paginate(10);
  //
  //   return view('bulletins.index', compact('user', 'bulletins', 'archives'));
  // }

  public function save_bulletin(Request $request)
  {
    $user = auth()->user();
    $all = User::whereHas('staff', function($query) use($user) {
      $query->where('CompanyID', $user->staff->CompanyID);
    })->get();

    $this->validate($request, [
      'Title' => 'required',
      'Body' => 'required',
      'DepartmentID' => 'required',
    ]);

    $bulletin = new Bulletin;
    $bulletin->Title = $request->Title;
    $bulletin->Body = $request->Body;
    $bulletin->ExpiryDate = $request->ExpiryDate;
    $bulletin->CompanyID = $user->staff->CompanyID;
    $bulletin->DepartmentID = $request->DepartmentID;
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
