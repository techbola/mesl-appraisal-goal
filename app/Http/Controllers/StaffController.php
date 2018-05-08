<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Country;
use App\Department;
use App\EmploymentStatus;
use App\GradeLevel;
use App\HMO;
use App\HMOPlan;
use App\Location;
use App\MaritalStatus;
use App\PFA;
use App\Position;
use App\Religion;
use App\Role;
use App\Sex;
use App\Staff;
use App\State;
use App\TaxableBase;
use App\Title;
use App\Unit;
use App\User;
use App\StaffPending;
use App\PayrollAdjustmentGroup;
use Illuminate\Http\Request;

use DB;
use Notification;
use App\Notifications\StaffInvitation;
use App\Company;
use File;
use Image;
use Auth;

class StaffController extends Controller
{

    public function index()
    {
        // $staffs = \DB::table('tblStaff')
        //     ->leftJoin('tblEmploymentStatus', 'tblStaff.EmploymentStatusID', '=', 'tblEmploymentStatus.StatusRef')
        //     ->get();
        // return view('staff.index', compact('staffs'));
        $user = auth()->user();
        if ($user->is_superadmin) {
            $staffs    = Staff::all();
            $companies = Company::all();
            $roles     = Role::all();
        } else {
            $staffs = Staff::where('CompanyID', $user->staff->CompanyID)->get();
            $roles  = Role::where('CompanyID', $user->staff->CompanyID)->get();
        }
        return view('staff.index_', compact('staffs', 'companies', 'roles'));
    }

    public function post_invite(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|unique:users',
            'role'       => 'required',
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

            $staff         = new Staff;
            $staff->UserID = $user->id;
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
            $role = Role::where('id', $request->role)->first();
            $user->roles()->attach($role->id);

            DB::commit();
            Notification::send($user, new StaffInvitation());

            return redirect()->back()->with('success', $user->FullName . ' was invited successfully. Ask them to check their mail.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'This invitation could not be sent at this time.');
        }

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
        $detail = \DB::table('tblStaff')
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
            ->where('StaffRef', $id)
            ->first();

        $staff = Staff::find($id);
        return view('staff.show', compact('detail', 'staff'));
    }

    public function edit_biodata($id)
    {
        $user = auth()->user();

        $staffs         = Staff::all();
        $staff          = Staff::where('StaffRef', $id)->first();
        $religions      = Religion::all();
        $payroll_groups = PayrollAdjustmentGroup::select('GroupRef', 'GroupDescription');
        $status         = MaritalStatus::all();
        $states         = State::all();
        $countries      = Country::all();
        $hmos           = HMO::all();
        $hmoplans       = HMOPlan::all();
        return view('staff.edit_biodata', compact('religions', 'payroll_groups', 'hmoplans', 'staff', 'staffs', 'hmos', 'countries', 'status', 'states', 'user'));
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
// dd($request->all());

        $this->validate($request, [
            // 'TownCity'           => 'required',
            'MobilePhone'  => 'required',
            'AddressLine1' => 'required',
            'StateID'      => 'required',
            'CountryID'    => 'required',
            // 'NextofKIN'          => 'required',
            // 'NextofKIN_Phone'    => 'required',
            // 'PhotographLocation' => 'required',
        ]);

        $user = Auth::user();

        try {
            DB::beginTransaction();
            $staff      = Staff::where('StaffRef', $id)->first();
            $user_staff = User::find($staff->UserID);

            if (!$user->hasRole('admin') && !$user->is_superadmin) {
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

                $user_staff->first_name  = $request->FirstName;
                $user_staff->middle_name = $request->MiddleName;
                $user_staff->last_name   = $request->LastName;

                // START PHOTO
                if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
                    $file     = $request->file('avatar');
                    $filename = strtolower($user_staff->first_name . '_' . $user_staff->last_name . '_' . $user_staff->id . '.' . $request->avatar->extension());

                    // Create the Avatars folder if doesn't exist. ('Intervention' doesnt create folders automatically)
                    // The first condition is for the default Laravel folder structure. The second condition will be used if the public folder becomes root (in live servers)
                    if (!File::exists(public_path('images/avatars')) && File::exists(public_path('images'))) {
                        File::makeDirectory(public_path('images/avatars'));
                    } elseif (!File::exists('images/avatars') && !File::exists(public_path('images'))) {
                        File::makeDirectory('images/avatars');
                    }

                    Image::make($file)->orientate()->resize(300, null, function ($constraint) {$constraint->aspectRatio();})->save('images/avatars/' . $filename);
                    // Name to be saved to DB
                    $user_staff->avatar = $filename;
                }
                $user_staff->save();

                // END PHOTO
            }

            $staff->fill($request->except(['FirstName', 'MiddleName', 'LastName', 'Avatar']));
            $staff->save();

            DB::commit();
            return redirect()->back()->with('success', $user_staff->FullName . '\'s biodata was updated successfully');

            try {
                DB::beginTransaction();
                // if ($user->staff && $user->staff->StaffRef == $id && !$user->hasRole('admin')) {
                if (!$user->hasRole('admin')) {
                    // Non Admins
                    $staff            = new StaffPending;
                    $staff->UserID    = $user->id;
                    $staff->StaffRef  = $user->staff->StaffRef;
                    $staff->CompanyID = $user->staff->CompanyID;
                } else {
                    $staff      = Staff::where('StaffRef', $id)->first();
                    $user_staff = User::find($staff->UserID);

                    $user_staff->first_name  = $request->FirstName;
                    $user_staff->middle_name = $request->MiddleName;
                    $user_staff->last_name   = $request->LastName;

                    // START PHOTO
                    if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
                        $file     = $request->file('avatar');
                        $filename = strtolower($user_staff->first_name . '_' . $user_staff->last_name . '_' . $user_staff->id . '.' . $request->avatar->extension());

                        // Create the Avatars folder if doesn't exist. ('Intervention' doesnt create folders automatically)
                        // The first condition is for the default Laravel folder structure. The second condition will be used if the public folder becomes root (in live servers)
                        if (!File::exists(public_path('images/avatars')) && File::exists(public_path('images'))) {
                            File::makeDirectory(public_path('images/avatars'));
                        } elseif (!File::exists('images/avatars') && !File::exists(public_path('images'))) {
                            File::makeDirectory('images/avatars');
                        }

                        Image::make($file)->resize(300, null, function ($constraint) {$constraint->aspectRatio();})->save('images/avatars/' . $filename);
                        // Name to be saved to DB
                        $user_staff->avatar = $filename;
                    }
                    $user_staff->save();

                    // END PHOTO
                }

                $staff->fill($request->except(['FirstName', 'MiddleName', 'LastName', 'Avatar']));
                $staff->save();

                DB::commit();
                return redirect()->back()->with('success', $staff->FullName . '\'s biodata was updated successfully');

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

        public function destroy($id)
        {
            //
        }
    }
