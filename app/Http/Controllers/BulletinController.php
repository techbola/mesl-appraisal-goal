<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use MESL\Bulletin;
use MESL\User;
use Carbon\Carbon;
use MESL\Department;
use MESL\Staff;
use MESL\CompanyDepartment;

use MESL\Notifications\NewBulletin;
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
      $archives = Bulletin::where('CompanyID', $user->staff->CompanyID)->whereDate('ExpiryDate', '<', $today)->orderBy('BulletinRef', 'desc')->paginate(10);
    } elseif ($user->hasRole('admin')) {
      $bulletins = Bulletin::where('CompanyID', $user->staff->CompanyID)->whereDate('ExpiryDate', '>=', $today)->orderBy('BulletinRef', 'desc')->paginate(10);
      $archives = Bulletin::where('CompanyID', $user->staff->CompanyID)->whereDate('ExpiryDate', '<', $today)->orderBy('BulletinRef', 'desc')->paginate(10);
    } else {
      $bulletins = Bulletin::where('CompanyID', $user->staff->CompanyID)->whereIn('DepartmentID', $user_departments)->whereDate('ExpiryDate', '>=', $today)->orderBy('BulletinRef', 'desc')->paginate(10);
      $archives = Bulletin::where('CompanyID', $user->staff->CompanyID)->whereIn('DepartmentID', $user_departments)->whereDate('ExpiryDate', '<', $today)->orderBy('BulletinRef', 'desc')->paginate(10);
    }
    // $departments = Department::where('CompanyID', $user->staff->CompanyID)->get();
    $departments = CompanyDepartment::where('is_deleted', false)->get();

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

    $staff = User::whereHas('staff', function($q) use($request){
      $q->whereRaw("CONCAT(',',DepartmentID,',') LIKE CONCAT('%,',".$request->DepartmentID.",',%')");
    })->get();


    Notification::send($staff, new NewBulletin($bulletin));

    return redirect()->route('bulletin_board')->with('success', 'New bulletin was saved successfully.');
  }

  public function view_bulletin($id)
  {
    return $this->index();
  }

}
