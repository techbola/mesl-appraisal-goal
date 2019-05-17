<?php

namespace MESL\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use MESL\Bulletin;
use MESL\CompanyDepartment;
use MESL\Notifications\NewBulletin;
use MESL\Staff;
use MESL\User;
use Notification;

class BulletinController extends Controller
{
    public function index()
    {
        $today            = date('Y-m-d');
        $user             = auth()->user();
        $user_departments = $user->staff->DepartmentID;

        if ($user->is_superadmin) {
            $bulletins = Bulletin::whereDate('ExpiryDate', '>=', $today)->paginate(10);
            $archives  = Bulletin::where('CompanyID', $user->staff->CompanyID)->whereDate('ExpiryDate', '<', $today)->orderBy('BulletinRef', 'desc')->paginate(10);
        } elseif ($user->hasRole('admin')) {
            $bulletins = Bulletin::where('CompanyID', $user->staff->CompanyID)->whereDate('ExpiryDate', '>=', $today)->orderBy('BulletinRef', 'desc')->paginate(10);
            $archives  = Bulletin::where('CompanyID', $user->staff->CompanyID)->whereDate('ExpiryDate', '<', $today)->orderBy('BulletinRef', 'desc')->paginate(10);
        } else {
            $bulletins = Bulletin::where('CompanyID', $user->staff->CompanyID)->where('DepartmentID', $user_departments)->whereDate('ExpiryDate', '>=', $today)->orderBy('BulletinRef', 'desc')->paginate(10);
            $archives  = Bulletin::where('CompanyID', $user->staff->CompanyID)->where('DepartmentID', $user_departments)->whereDate('ExpiryDate', '<', $today)->orderBy('BulletinRef', 'desc')->paginate(10);
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
        $all  = User::whereHas('staff', function ($query) use ($user) {
            $query->where('CompanyID', $user->staff->CompanyID);
        })->get();

        $this->validate($request, [
            'Title' => 'required',
            'Body'  => 'required',
        ]);

        if (in_array(29, $request->DepartmentID)) {
            foreach ($request->DepartmentID as $key => $value) {
                $bulletin               = new Bulletin;
                $bulletin->Title        = $request->Title;
                $bulletin->Body         = $request->Body;
                $bulletin->ExpiryDate   = $request->ExpiryDate;
                $bulletin->CompanyID    = $user->staff->CompanyID;
                $bulletin->DepartmentID = $request->DepartmentID[$key];
                $bulletin->CreatedBy    = $user->id;
                $bulletin->CreatedDate  = Carbon::now();

                $bulletin->save();

                $staff = User::all();

                Notification::send($staff, new NewBulletin($bulletin));

            }
        } else {
            foreach ($request->DepartmentID as $key => $value) {
                $bulletin               = new Bulletin;
                $bulletin->Title        = $request->Title;
                $bulletin->Body         = $request->Body;
                $bulletin->ExpiryDate   = $request->ExpiryDate;
                $bulletin->CompanyID    = $user->staff->CompanyID;
                $bulletin->DepartmentID = $request->DepartmentID[$key];
                $bulletin->CreatedBy    = $user->id;
                $bulletin->CreatedDate  = Carbon::now();

                $bulletin->save();

                $staff = User::whereHas('staff', function ($q) use ($request, $key) {
                    $dept_id = $request->DepartmentID[$key];
                    $q->whereRaw("DepartmentID = $dept_id");
                })->get();

                Notification::send($staff, new NewBulletin($bulletin));

            }
        }

        // $depts = CompanyDepartment::all()->pluck('id')->toArray();
        //
        // if ($request->DepartmentID == '29') {
        //   $staff = User::whereHas('staff', function($query) use($request, $depts) {
        //     $query->whereIn('DepartmentID', $depts);
        //   })->get();
        // } else {

        // }

        // SEND NOTIFICATION TO ALL STAFF IF ALL DEARTMENTS WAS SELECTED

        return redirect()->route('bulletin_board')->with('success', 'New bulletin was saved successfully.');
    }

    public function view_bulletin($id)
    {
        return $this->index();
    }

    public function delete(Request $request, $id)
    {
        $bulletin = Bulletin::find($id);
        $bulletin->delete();
        return redirect()->back()->with('success', 'Bulletin item deleted successfully');
    }

}
