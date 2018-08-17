<?php

namespace Cavidel\Http\Controllers;

use Cavidel\Bank;
use Cavidel\Country;
use Cavidel\Department;
use Cavidel\EmploymentStatus;
use Cavidel\GradeLevel;
use Cavidel\HMO;
use Cavidel\HMOPlan;
use Cavidel\Location;
use Cavidel\MaritalStatus;
use Cavidel\PFA;
use Cavidel\Position;
use Cavidel\Religion;
use Cavidel\Role;
use Cavidel\Sex;
use Cavidel\Staff;
use Cavidel\State;
use Cavidel\LGA;
use Cavidel\TaxableBase;
use Cavidel\Title;
use Cavidel\Unit;
use Cavidel\User;
use Cavidel\StaffPending;
use Cavidel\PayrollAdjustmentGroup;
use Illuminate\Http\Request;
use Carbon;

use DB;
use Notification;
use Cavidel\Notifications\StaffInvitation;
use Cavidel\Company;
use File;
use Image;
use Auth;
use Gate;

class StaffController extends Controller
{

    public function index()
    {
      $this->authorize('hr-admin');
        // $staffs = \DB::table('tblStaff')
        //     ->leftJoin('tblEmploymentStatus', 'tblStaff.EmploymentStatusID', '=', 'tblEmploymentStatus.StatusRef')
        //     ->get();
        // return view('staff.index', compact('staffs'));
        $user = auth()->user();
        if ($user->is_superadmin) {
            $staffs    = Staff::with('user')->get();
            $companies = Company::all();
            $roles     = Role::all();
        } else {
            $roles  = Role::where('CompanyID', $user->staff->CompanyID)->orWhere('name', 'admin')->get();
            if (!empty($_GET['q'])) {
              $q = $_GET['q'];
              $staffs = Staff::where('CompanyID', $user->staff->CompanyID)->whereHas('user', function($query) use($q){
                $query->where('first_name', 'LIKE', '%'.$q.'%')->orWhere('last_name', 'LIKE', '%'.$q.'%')->orWhere('email', 'LIKE', '%'.$q.'%');
              })->orWhere('MobilePhone', 'LIKE', '%'.$q.'%')->with('user')->get();
            } else {
              $staffs = Staff::where('CompanyID', $user->staff->CompanyID)->with('user')->get();
            }
        }
        $departments = Department::where('CompanyID', $user->staff->CompanyID)->get();
        return view('staff.index_', compact('staffs', 'companies', 'roles', 'departments', 'q'));
    }


    public function get_staff_list()
    {
      $user = auth()->user();
      $staff = Staff::where('CompanyID', $user->staff->CompanyID)->with('user')->get();

      return $staff;
    }

    public function staff_search()
    {
      $user = auth()->user();
      if (!empty($_GET['q'])) {
        $q = $_GET['q'];
        $staffs = Staff::where('CompanyID', $user->staff->CompanyID)->whereHas('user', function($query) use($q){
          $query->where('first_name', 'LIKE', '%'.$q.'%')->orWhere('last_name', 'LIKE', '%'.$q.'%')->orWhere('email', 'LIKE', '%'.$q.'%');
        })->orWhere('MobilePhone', 'LIKE', '%'.$q.'%')->with('user')->paginate(20);
      } else {
        $staffs = Staff::where('CompanyID', $user->staff->CompanyID)->with('user')->paginate(20);
      }


      return view('staff.staff_search', compact('staffs', 'q'));
    }

    public function post_invite(Request $request)
    {

        $this->validate($request, [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|unique:users',
            'roles'       => 'required',
        ]);

        try {
            DB::beginTransaction();

            $user                   = new User;
            $user->first_name       = $request->first_name;
            $user->last_name        = $request->last_name;
            $user->email            = $request->email;
            $user->code             = uniqid();
            $user->password         = bcrypt(substr($user->code, -5));
            $user->changed_password = '0';
            $user->save();

            $staff               = new Staff;
            $staff->UserID       = $user->id;
            if (!empty($request->DepartmentID)) {
              $staff_departments   = implode(',', $request->DepartmentID);
              $staff->DepartmentID = $staff_departments;
            } else {
              $staff->DepartmentID = '1';
            }
            if (!empty($request->SupervisorID)) {
              $staff->SupervisorID = $request->SupervisorID;
            }
            if (auth()->user()->is_superadmin) {
                $staff->CompanyID = $request->CompanyID;
            } else {
                $staff->CompanyID = auth()->user()->staff->company->CompanyRef;
            }
            // $staff->MobilePhone = $request->phone;
            $staff->save();

            // if (!empty($request->role)) {
            //   $role = Role::where('id', $request->role)->first();
            // } else {
            //   $role = Role::where('name', 'staff')->first();
            // }

            // Role is now compulsory
            foreach ($request->roles as $role_id) {
              $user->roles()->attach($role_id);
            }
            // $role = Role::where('id', $request->role)->first();
            // $user->roles()->attach($role->id);

            DB::commit();
            Notification::send($user, new StaffInvitation());

            return redirect()->back()->with('success', $user->FullName . ' was invited successfully. Ask them to check their mail.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'This invitation could not be sent at this time.');
        }

    }

    public function reinvite_staff(Request $request, $id)
    {
      $user = User::find($id);
      Notification::send($user, new StaffInvitation());
      return redirect()->back()->with('success', $user->FullName . ' was re-invited successfully. Ask them to check their mail -- '.$user->email);
    }

    public function update_staff_admin(Request $request, $id)
    {
      $staff = Staff::find($id);
      $staff->user->first_name = $request->first_name;
      $staff->user->last_name = $request->last_name;
      $staff->user->email = $request->email;
      $staff->user->update();
      return redirect()->back()->with('success', 'Staff was updated successfully');
    }

    public function pending_biodata_list()
    {
        $user = auth()->user();
        if ($user->is_superadmin) {
            $pendings = StaffPending::where('ApprovedBy', null)->get();
        } else {
            $pendings = StaffPending::where('CompanyID', $user->staff->CompanyID)->where('ApprovedBy', null)->get();
        }

        return view('staff.pending_biodata_list', compact('user', 'pendings'));
    }

    public function pending_biodata($id)
    {
        $user     = auth()->user();
        $pending  = StaffPending::find($id);
        $staff    = Staff::find($pending->user->staff->StaffRef);
        $pending2 = StaffPending::where('id', $id)->get(['MobilePhone', 'EmployeeNumber']);

        return view('staff.pending_biodata', compact('user', 'pending', 'staff', 'pending2'));
    }

    public function approve_biodata($id)
    {
        try {
            DB::beginTransaction();

            $user = Auth::user();

            $pending    = StaffPending::where('id', $id)->first();
            $staff_data = $pending->replicate(['StaffRef', 'ApprovedBy', 'Age', 'deleted_at']);
            // Any extra columns?
            $pending->ApprovedBy = $user->id;
            $pending->save();
            // Fetch only the attributes
            $staff_arr = $staff_data->getattributes();
            // Copy & save to FCYTrade
            // $staff = Staff::create($staff_arr);
            $staff = Staff::find($pending->StaffRef);
            // dd($staff_arr);
            $staff->update($staff_arr);
            // Soft delete from Pending
            $pending->delete();

            DB::commit();
            return redirect()->route('pending_biodata_list')->with('success', 'Profile changes approved successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('pending_biodata_list')->with('error', 'There was a problem approving the changes.');
        }

    }

    public function reject_biodata($id)
    {
        $user = Auth::user();

        $pending             = StaffPending::where('id', $id)->first();
        $pending->ApprovedBy = '0';
        $pending->save();

        return redirect()->route('pending_biodata_list')->with('success', 'Profile changes were rejected successfully');

    }

    public function showfulldetails()
    {
        $email   = \Auth::user()->email;
        $details = \DB::table('tblStaff')
            ->leftJoin('tblReligion', 'tblStaff.ReligionID', '=', 'tblReligion.ReligionRef')
            ->leftJoin('tblState', 'tblStaff.StateID', '=', 'tblState.StateRef')
            ->leftJoin('tblCountry', 'tblStaff.CountryID', '=', 'tblCountry.CountryRef')
            ->leftJoin('tblMaritalStatus', 'tblStaff.MaritalStatusID', '=', 'tblMaritalStatus.MaritalStatusRef')
            ->leftJoin('tblHMO', 'tblStaff.HMOID', '=', 'tblHMO.HMORef')
            ->leftJoin('tblHMOPlan', 'tblStaff.HMOPlanID', '=', 'tblHMOPlan.HMOPlanRef')
            ->leftJoin('tblEmploymentStatus', 'tblStaff.EmploymentStatusID', '=', 'tblEmploymentStatus.StatusRef')
            ->leftJoin('tblDepartment', 'tblStaff.DepartmentID', '=', 'tblDepartment.DepartmentRef')
            ->leftJoin('tblUnit', 'tblStaff.UnitID', '=', 'tblUnit.UnitRef')
            ->leftJoin('roles', 'tblStaff.RoleID', '=', 'roles.id')
            ->leftJoin('tblPosition', 'tblStaff.PositionID', '=', 'tblPosition.PositionRef')
            ->leftJoin('tblGradeLevel', 'tblStaff.GradeLevelID', '=', 'tblGradeLevel.GradeLevelRef')
            ->leftJoin('tblPFA', 'tblStaff.PFAID', '=', 'tblPFA.PFARef')
            ->where('email', $email)->get();
        return view('staff.showfulldetails', compact('details'));
    }

    public function create()
    {
        $titles      = Title::all();
        $locations   = Location::all();
        $departments = Department::all();
        $status      = EmploymentStatus::all();
        $staff       = Staff::all();
        $sexs        = Sex::all();
        $roles       = Role::all();
        $positions   = Position::all();
        $units       = Unit::all();

        return view('staff.create', compact('titles', 'locations', 'positions', 'roles', 'sexs', 'units', 'staff', 'departments', 'status'));
    }

    public function store(Request $request)
    {
        $staff = new Staff($request->all());
        $this->validate($request, [
            'EmployeeNumber'     => 'bail|required|unique:tblStaff',
            'TitleID'            => 'required',
            'name'               => 'required',
            'FirstName'          => 'required',
            'LocationID'         => 'required',
            'email'              => 'bail|required|unique:tblStaff',
            'DepartmentID'       => 'required',
            'ConfirmationDate'   => 'required',
            'EmploymentDate'     => 'required',
            'EmploymentStatusID' => 'required',
            'SexID'              => 'required',
            'LeaveDays'          => 'required',
            'SupervisorID'       => 'required',
        ]);
        if ($staff->save()) {
            $staff->user()->create([
                'name'     => $staff->name,
                'email'    => $staff->email,
                'password' => bcrypt($staff->password),
                'staff_id' => $staff->StaffRef,
            ]);
            $id = \DB::table('tblStaff')->select('StaffRef')->max('StaffRef');
            return redirect()->route('staff.Staff_Finance_Details', $id)->with('success', 'Staff was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Staff failed to save');
        }
    }

    public function show($id)
    {
        // $detail = \DB::table('tblStaff')
        //     ->leftJoin('tblReligion', 'tblStaff.ReligionID', '=', 'tblReligion.ReligionRef')
        //     ->leftJoin('tblState', 'tblStaff.StateID', '=', 'tblState.StateRef')
        //     ->leftJoin('tblCountry', 'tblStaff.CountryID', '=', 'tblCountry.CountryRef')
        //     ->leftJoin('tblMaritalStatus', 'tblStaff.MaritalStatusID', '=', 'tblMaritalStatus.MaritalStatusRef')
        //     ->leftJoin('tblHMO', 'tblStaff.HMOID', '=', 'tblHMO.HMORef')
        //     ->leftJoin('tblHMOPlan', 'tblStaff.HMOPlanID', '=', 'tblHMOPlan.HMOPlanRef')
        //     ->leftJoin('tblEmploymentStatus', 'tblStaff.EmploymentStatusID', '=', 'tblEmploymentStatus.StatusRef')
        //     ->leftJoin('tblDepartment', 'tblStaff.DepartmentID', '=', 'tblDepartment.DepartmentRef')
        //     ->leftJoin('tblUnit', 'tblStaff.UnitID', '=', 'tblUnit.UnitRef')
        //     ->leftJoin('roles', 'tblStaff.RoleID', '=', 'roles.id')
        //     ->leftJoin('tblPosition', 'tblStaff.PositionID', '=', 'tblPosition.PositionRef')
        //     ->leftJoin('tblGradeLevel', 'tblStaff.GradeLevelID', '=', 'tblGradeLevel.GradeLevelRef')
        //     ->leftJoin('tblPFA', 'tblStaff.PFAID', '=', 'tblPFA.PFARef')
        //     ->where('StaffRef', $id)
        //     ->first();

        $staff = Staff::find($id);

        $colors = ["#E65100", "#EF6C00", "#F57C00", "#558B2F", "#689F38", "#7CB342", "#8BC34A", "#4527A0", "#512DA8", "#5E35B1", "#673AB7", "#0277BD", "#0288D1", "#039BE5"];
        $gantt  = [];

        // foreach ($staff->projects as $project) {
        //   // code...
        // }
        foreach ($staff->tasks as $key => $gtask) {
            $gantt[$key]['name']   = $gtask->Task;
            $gantt[$key]['series'] = [];
            foreach ($gtask->steps as $step_key => $gstep) {
                $gantt[$key]['series'][$step_key]['name']                   = $gstep->Step;
                $gantt[$key]['series'][$step_key]['sub_series']             = [];
                $gantt[$key]['series'][$step_key]['sub_series'][0]['id']    = $step_key;
                $gantt[$key]['series'][$step_key]['sub_series'][0]['start'] = ($gstep->StartDate) ? Carbon::parse($gstep->StartDate)->format('m-d-y') : date('m-d-Y');
                $gantt[$key]['series'][$step_key]['sub_series'][0]['end']   = ($gstep->EndDate) ? Carbon::parse($gstep->EndDate)->format('m-d-y') : date('m-d-Y');
                $gantt[$key]['series'][$step_key]['sub_series'][0]['color'] = $colors[array_rand($colors)];
            }
        }
        $gantt = json_encode($gantt);

        return view('staff.show', compact('detail', 'staff', 'gantt'));
    }

    public function edit_biodata($id)
    {
        $staff  = Staff::where('StaffRef', $id)->first();
        $this->authorize('edit-profile', $staff->user);

        $user = auth()->user();

        $staffs = Staff::all();

        $religions      = Religion::all();
        $payroll_groups = PayrollAdjustmentGroup::select('GroupRef', 'GroupDescription');
        $status         = MaritalStatus::all();
        $states         = State::all();
        $countries      = Country::all();
        $hmos           = HMO::all();
        $hmoplans       = HMOPlan::all();
        $roles          = Role::where('CompanyID', $user->staff->CompanyID)->orWhere('name', 'admin')->get();
        $role           = User::find($staff->UserID)->roles;
        $banks          = Bank::all();
        $locations = Location::all();
        $lgas = LGA::all();

        $departments       = Department::where('CompanyID', $user->staff->CompanyID)->get();
        $staff_departments = explode(',', $staff->DepartmentID);
        $supervisors       = Staff::where('CompanyID', $user->CompanyID)->get();

        // dd($role->pluck('id', 'name'));
        return view('staff.edit_biodata', compact('religions', 'payroll_groups', 'hmoplans', 'staff', 'staffs', 'hmos', 'countries', 'status', 'states', 'user', 'roles', 'role', 'banks', 'departments', 'staff_departments', 'supervisors', 'locations', 'lgas'));
    }

    public function editFinanceDetails($id)
    {
        $grades = GradeLevel::all();
        $banks  = Bank::all();
        $pfa    = PFA::all();
        $taxes  = TaxableBase::all();
        $staff  = Staff::where('StaffRef', $id)->first();
        $staffs = Staff::all();
        return view('staff.Staff_Finance_Details', compact('grades', 'staff', 'staffs', 'taxes', 'banks', 'pfa', 'taxs'));
    }

    public function edit($id)
    {
        $grades = GradeLevel::all();
        $banks  = Bank::all();
        $pfa    = PFA::all();
        $taxes  = TaxableBase::all();
        $staff  = Staff::where('StaffRef', $id)->first();
        $staffs = Staff::all();
        return view('staff.edit', compact('grades', 'staff', 'staffs', 'taxes', 'banks', 'pfa', 'taxs'));
    }

    public function editofficedetails($id)
    {
        $titles      = Title::all();
        $locations   = Location::all();
        $departments = Department::all();
        $status      = EmploymentStatus::all();
        $sexs        = Sex::all();
        $roles       = Role::all();
        $positions   = Position::all();
        $units       = Unit::all();
        $staff       = Staff::where('StaffRef', $id)->first();
        $staffs      = Staff::all();
        return view('staff.form', compact('titles', 'locations', 'positions', 'roles', 'sexs', 'units', 'staff', 'staffs', 'departments', 'status'));
    }

    public function updateFinanceDetails(Request $request, $id)
    {
        $staff = \DB::table('tblStaff')->where('StaffRef', $id);
        $this->validate($request, [
            'BankAcctNumber' => 'required',
            'GradeLevelID'   => 'required',
        ]);
        if ($staff->update($request->except(['_token', '_method']))) {
            return redirect()->route('staff.create')->with('success', 'Financial Details was updated successfully');
        } else {
            return back()->withInput()->with('error', 'Financial Details failed to update');
        }
    }

    public function updateOfficeDetails(Request $request, $id)
    {
        $staff = \DB::table('tblStaff')->where('StaffRef', $id);
        $this->validate($request, [
            'EmployeeNumber'     => 'bail|required|unique:tblStaff',
            'TitleID'            => 'required',
            'name'               => 'required',
            'FirstName'          => 'required',
            'LocationID'         => 'required',
            'email'              => 'bail|required|unique:tblStaff',
            'DepartmentID'       => 'required',
            'ConfirmationDate'   => 'required',
            'EmploymentDate'     => 'required',
            'EmploymentStatusID' => 'required',
            'SexID'              => 'required',
            'LeaveDays'          => 'required',
            'SupervisorID'       => 'required',
        ]);
        if ($staff->update($request->except(['_token', '_method']))) {
            return redirect()->route('staff.create')->with('success', 'Financial Details was updated successfully');
        } else {
            return back()->withInput()->with('error', 'Financial Details failed to update');
        }
    }

    public function updatebiodata(Request $request, $id)
    {

        $this->validate($request, [
            // 'TownCity'           => 'required',
            // 'MobilePhone'  => 'required',
            // 'AddressLine1' => 'required',
            // 'StateID'      => 'required',
            // 'CountryID'    => 'required',
            // 'NextofKIN'          => 'required',
            // 'NextofKIN_Phone'    => 'required',
            // 'PhotographLocation' => 'required',
        ]);

        $user = Auth::user();

        try {
            DB::beginTransaction();
            $staff      = Staff::where('StaffRef', $id)->first();
            $user_staff = User::find($staff->UserID);

            if (Gate::denies('hr-admin')) {
                // Non Admins
                $staff            = new StaffPending;
                $staff->UserID    = $user->id;
                $staff->StaffRef  = $user->staff->StaffRef;
                $staff->CompanyID = $user->staff->CompanyID;

                // START PHOTO
                if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
                    $file     = $request->file('avatar');
                    $filename = strtolower($user_staff->first_name . '_' . $user_staff->last_name . '_' . $user_staff->id . '.' . $request->avatar->extension());

                    if (!File::exists(public_path('images/avatars')) && File::exists(public_path('images'))) {
                        File::makeDirectory(public_path('images/avatars'));
                    }

                    Image::make($file)->orientate()->resize(300, null, function ($constraint) {$constraint->aspectRatio();})->save('images/avatars/' . $filename);
                    // Name to be saved to DB
                    $user_staff->avatar = $filename;
                }
                $user_staff->save();
                // END PHOTO

            } else {
              if (!empty($request->DepartmentID)) {
                $staff_departments = implode(',', $request->DepartmentID);
                $staff->DepartmentID = $staff_departments;
              }

                $user_staff->first_name  = $request->FirstName;
                $user_staff->middle_name = $request->MiddleName;
                $user_staff->last_name   = $request->LastName;

                // START PHOTO
                if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
                    $file     = $request->file('avatar');
                    $filename = strtolower($user_staff->first_name . '_' . $user_staff->last_name . '_' . $user_staff->id . '.' . $request->avatar->extension());

                    // Create the Avatars folder if doesn't exist.
                    if (!File::exists(public_path('images/avatars')) && File::exists(public_path('images'))) {
                        File::makeDirectory(public_path('images/avatars'));
                    }

                    Image::make($file)->orientate()->resize(300, null, function ($constraint) {$constraint->aspectRatio();})->save('images/avatars/' . $filename);
                    // Name to be saved to DB
                    $user_staff->avatar = $filename;
                }
                $user_staff->save();

                // END PHOTO

                if ($user->hasRole('admin') && !empty($request->roles)) {
                    $user_staff->roles()->detach();
                    $user_staff->roles()->attach($request->roles);
                }
            }

            $staff->fill($request->except(['FirstName', 'MiddleName', 'LastName', 'Avatar', 'roles', 'DepartmentID']));
            $staff->save();

            DB::commit();
            return redirect()->back()->with('success', $user_staff->FullName . '\'s biodata was updated successfully');

            } catch (Exception $e) {
                DB::rollback();
                return back()->withInput()->with('error', 'Failed to update please try again.');
            }

            // if ($staff->update($request->except(['_token', '_method']))) {
            //     return redirect()->route('staff.showfulldetails', $id)->with('success', $staff->FullName.'\'s biodata was updated successfully');
            // } else {
            //     return back()->withInput()->with('error', 'Failed to update please try again.');
            // }

    }

    public function subordinates()
    {
      $user = auth()->user();
      $staffs = $user->staff->subordinates;
      // $roles  = Role::where('CompanyID', $user->staff->CompanyID)->get();

      return view('staff.subordinates', compact('staffs', 'companies', 'roles'));
    }


}
