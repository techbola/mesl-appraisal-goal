<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use MESL\HMO;
use MESL\HMOPlan;
use MESL\Location;
use MESL\PFA;
use MESL\Bank;
use MESL\Currency;
use MESL\TravelPurpose;
use MESL\TravelMode;
use MESL\TravelTransport;
use MESL\TravelLodge;
use MESL\StaffType;
use MESL\Department;
use MESL\Company;
use MESL\Subsidiary;
use MESL\Division;
use MESL\Group;
use MESL\SeniorityLevel;

class SetupController extends Controller
{
    public function index()
    {
        return view('setup.index');
    }

    public function hmo()
    {
        $hmo = HMO::Orderby('HMORef', 'DESC')->get();
        return view('setup.hmo', compact('hmo'));
    }

    public function store_hmo(Request $request)
    {
        $hmo = new HMO($request->all());
        $this->validate($request, [
            'HMO' => 'required',
        ]);
        if ($hmo->save()) {
            return redirect('/setup/hmo')->with('success', 'HMO was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'HMO failed to save');
        }
    }

    public function edit_hmo($id)
    {
        $hmo = HMO::where("HMORef", $id)->first();

        return response()->json($hmo);
    }

    public function update_hmo(Request $request)
    {
        $hmo = HMO::find($request->HMORef);

        $hmo->update($request->except(['_token']));

        return redirect()->back()->with('success',  'Updated successfully');
    }

    public function delete_hmo($id)
    {
        $hmo = HMO::where("HMORef", $id);

        $hmo->delete();

        return redirect()->back()->with('success',  'Deleted successfully');
    }

    //HMO Plan
    public function hmo_plan()
    {
        $hmoplan = HMOPlan::Orderby('HMOPlanRef', 'DESC')->get();
        return view('setup.hmo_plan', compact('hmoplan'));
    }

    public function store_hmo_plan(Request $request)
    {
        $hmoplan = new HMOPlan($request->all());
        $this->validate($request, [
            'HMOPlan' => 'required',
        ]);
        if ($hmoplan->save()) {
            return redirect('/setup/hmo_plan')->with('success', 'HMO Plan was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'HMO Plan failed to save');
        }
    }

    public function edit_hmo_plan($id)
    {
        $hmoplan = HMOPlan::where("HMOPlanRef", $id)->first();

        return response()->json($hmoplan);
    }

    public function update_hmo_plan(Request $request)
    {
        $hmoplan = HMOPlan::find($request->HMOPlanRef);

        $hmoplan->update($request->except(['_token']));

        return redirect()->back()->with('success',  'Updated successfully');
    }

    public function delete_hmo_plan($id)
    {
        $hmoplan = HMOPlan::where("HMOPlanRef", $id);

        $hmoplan->delete();

        return redirect()->back()->with('success',  'Deleted successfully');
    }

    //location Setup
    public function location()
    {
        $location = Location::Orderby('LocationRef', 'DESC')->get();
        return view ('setup.location', compact('location'));
    }

    public function store_location(Request $request)
    {
        $location = new Location($request->all());
        $this->validate($request, [
            'Location' => 'required',
        ]);
        if ($location->save()) {
            return redirect('/setup/location')->with('success', 'Location was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Location failed to save');
        }
    }

    public function edit_location($id)
    {
        $location = Location::where("LocationRef", $id)->first();

        return response()->json($location);
    }

    public function update_location(Request $request)
    {
        $location = Location::find($request->LocationRef);

        $location->update($request->except(['_token']));

        return redirect()->back()->with('success',  'Updated successfully');
    }

    public function delete_location($id)
    {
        $location = Location::where("LocationRef", $id);

        $location->delete();

        return redirect()->back()->with('success',  'Deleted successfully');
    }

    //PFA Setup

    public function pfa()
    {
        $pfa = PFA::Orderby('PFARef', 'DESC')->get();
        return view('setup.pfa', compact('pfa'));
    }

    public function store_pfa(Request $request)
    {
        $pfa = new PFA($request->all());
        $this->validate($request, [
            'PFA' => 'required',
        ]);
        if ($pfa->save()) {
            return redirect('/setup/pfa')->with('success', 'PFA was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'PFA failed to save');
        }
    }

    public function edit_pfa($id)
    {
        $pfa = PFA::where("PFARef", $id)->first();

        return response()->json($pfa);
    }

    public function update_pfa(Request $request)
    {
        $pfa = PFA::find($request->PFARef);

        $pfa->update($request->except(['_token']));

        return redirect()->back()->with('success',  'Updated successfully');
    }

    public function delete_pfa($id)
    {
        $pfa = PFA::where("PFARef", $id);

        $pfa->delete();

        return redirect()->back()->with('success',  'Deleted successfully');
    }

    //Bank Setup

    public function bank_setup()
    {
        $currency = Currency::all();
        $bank = Bank::Orderby('BankRef', 'DESC')->get();
        return view('setup.bank_setup', compact('bank', 'currency'));
    }

    public function store_bank(Request $request)
    {
        $bank = new Bank($request->all());
        $this->validate($request, [
            'BankName' => 'required',
            'CurrencyID' => 'required',
        ]);
        if ($bank->save()) {
            return redirect('/setup/bank_setup')->with('success', 'Bank was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Bank failed to save');
        }
    }

    public function edit_bank($id)
    {
        $bank = Bank::where("BankRef", $id)->first();

        return response()->json($bank);
    }

    public function update_bank(Request $request)
    {
        $bank = Bank::find($request->BankRef);

        $bank->update($request->except(['_token']));

        return redirect()->back()->with('success',  'Updated successfully');
    }

    public function delete_bank($id)
    {
        $bank = Bank::where("BankRef", $id);

        $bank->delete();

        return redirect()->back()->with('success',  'Deleted successfully');
    }

    //travel purpose setup

    public function travel_purpose()
    {
        $purpose = TravelPurpose::Orderby('TravelPurposeRef', 'DESC')->get();
        return view('setup.travel_purpose', compact('purpose'));
    }

    public function store_travel_purpose(Request $request)
    {
        $purpose = new TravelPurpose($request->all());
        $this->validate($request, [
            'TravelPurpose' => 'required',
        ]);
        if ($purpose->save()) {
            return redirect('/setup/travel_purpose')->with('success', 'Purpose was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Purpose failed to save');
        }
    }

    public function edit_travel_purpose($id)
    {
        $purpose = TravelPurpose::where("TravelPurposeRef", $id)->first();

        return response()->json($purpose);
    }

    public function update_travel_purpose(Request $request)
    {
        $purpose = TravelPurpose::find($request->TravelPurposeRef);

        $purpose->update($request->except(['_token']));

        return redirect()->back()->with('success',  'Updated successfully');
    }

    public function delete_travel_purpose($id)
    {
        $purpose = TravelPurpose::where("TravelPurposeRef", $id);

        $purpose->delete();

        return redirect()->back()->with('success',  'Deleted successfully');
    }

    //Travel mode setup

    public function travel_mode()
    {
        $mode = TravelMode::Orderby('TravelModeRef', 'DESC')->get();
        return view('setup.travel_mode', compact('mode'));
    }

    public function store_travel_mode(Request $request)
    {
        $mode = new TravelMode($request->all());
        $this->validate($request, [
            'TravelMode' => 'required',
        ]);
        if ($mode->save()) {
            return redirect('/setup/travel_mode')->with('success', 'Mode was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Mode failed to save');
        }
    }

    public function edit_travel_mode($id)
    {
        $mode = TravelMode::where("TravelModeRef", $id)->first();

        return response()->json($mode);
    }

    public function update_travel_mode(Request $request)
    {
        $mode = TravelMode::find($request->TravelModeRef);

        $mode->update($request->except(['_token']));

        return redirect()->back()->with('success',  'Updated successfully');
    }

    public function delete_travel_mode($id)
    {
        $mode = TravelMode::where("TravelModeRef", $id);

        $mode->delete();

        return redirect()->back()->with('success',  'Deleted successfully');
    }

    //Travel Transport Setup

    public function travel_transport()
    {
        $transport = TravelTransport::Orderby('TransporterRef', 'DESC')->get();
        return view('setup.travel_transport', compact('transport'));
    }

    public function store_travel_transport(Request $request)
    {
        $transport = new TravelTransport($request->all());
        $this->validate($request, [
            'Transporter' => 'required',
        ]);
        if ($transport->save()) {
            return redirect('/setup/travel_transport')->with('success', 'Transporter was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Transporter failed to save');
        }
    }

    public function edit_travel_transport($id)
    {
        $transport = TravelTransport::where("TransporterRef", $id)->first();

        return response()->json($transport);
    }

    public function update_travel_transport(Request $request)
    {
        $transport = TravelTransport::find($request->TransporterRef);

        $transport->update($request->except(['_token']));

        return redirect()->back()->with('success',  'Updated successfully');
    }

    public function delete_travel_transport($id)
    {
        $transport = TravelTransport::where("TransporterRef", $id);

        $transport->delete();

        return redirect()->back()->with('success',  'Deleted successfully');
    }

    public function travel_lodge()
    {
        $lodge = TravelLodge::Orderby('TravelLodgeRef', 'DESC')->get();
        return view('setup.travel_lodge', compact('lodge'));
    }

    public function store_travel_lodge(Request $request)
    {
        $lodge = new TravelLodge($request->all());
        $this->validate($request, [
            'TravelLodge' => 'required',
        ]);
        if ($lodge->save()) {
            return redirect('/setup/travel_lodge')->with('success', 'Lodge was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Lodge failed to save');
        }
    }

    public function edit_travel_lodge($id)
    {
        $lodge = TravelLodge::where("TravelLodgeRef", $id)->first();

        return response()->json($lodge);
    }

    public function update_travel_lodge(Request $request)
    {
        $lodge = TravelLodge::find($request->TravelLodgeRef);

        $lodge->update($request->except(['_token']));

        return redirect()->back()->with('success',  'Updated successfully');
    }

    public function delete_travel_lodge($id)
    {
        $lodge = TravelLodge::where("TravelLodgeRef", $id);

        $lodge->delete();

        return redirect()->back()->with('success',  'Deleted successfully');
    }

    public function staff_type()
    {
        $type = StaffType::Orderby('StaffTypeRef', 'DESC')->get();
        return view('setup.staff_type', compact('type'));
    }

    public function store_staff_type(Request $request)
    {
        $type = new StaffType($request->all());

        $this->validate($request, [
            'StaffType' => 'required',
        ]);

        if ($type->save()) {
            return redirect('/setup/staff_type')->with('success', 'Staff type was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Staff type failed to save');
        }
    }

    public function edit_staff_type($id)
    {
        $type = StaffType::where("StaffTypeRef", $id)->first();

        return response()->json($type);
    }

    public function update_staff_type(Request $request)
    {
        $type = StaffType::find($request->StaffTypeRef);

        $type->update($request->except(['_token']));

        return redirect()->back()->with('success',  'Updated successfully');
    }

    public function delete_staff_type($id)
    {
        $type = StaffType::where("StaffTypeRef", $id);

        $type->delete();

        return redirect()->back()->with('success',  'Deleted successfully');
    }

    public function department()
    {
        $company = Company::all();
        $subsidiary = Subsidiary::all();
        $division = Division::all();
        $group = Group::all();
        $department = Department::Orderby('DepartmentRef', 'DESC')->get();
        return view('setup.department', compact('department', 'company', 'subsidiary', 'division', 'group'));
    }

    public function store_department(Request $request)
    {
        $department = new Department($request->all());

        $this->validate($request, [
            'Department' => 'required',
        ]);

        if ($department->save()) {
            return redirect('/setup/department')->with('success', 'Department was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Department failed to save');
        }
    }

    public function edit_department($id)
    {
        $department = Department::where("DepartmentRef", $id)->first();

        return response()->json($department);
    }

    public function update_department(Request $request)
    {
        $department = Department::find($request->DepartmentRef);

        $department->update($request->except(['_token']));

        return redirect()->back()->with('success',  'Updated successfully');
    }

    public function delete_department($id)
    {
        $department = Department::where("DepartmentRef", $id);

        $department->delete();

        return redirect()->back()->with('success',  'Deleted successfully');
    }

    public function level()
    {
        $level = SeniorityLevel::Orderby('SeniorityRef', 'DESC')->get();
        return view('setup.level', compact('level'));
    }

    public function store_level(Request $request)
    {
        $level = new SeniorityLevel($request->all());

        $senioritylevel = SeniorityLevel::Orderby('SeniorityLevel', 'DESC')->first();

        $seniority = $senioritylevel->SeniorityLevel + 1;

        $level->GradeLevel = $request->GradeLevel;

        $level->SeniorityLevel = $seniority;

        if ($level->save()) {
            return redirect('/setup/level')->with('success', 'Level was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Level failed to save');
        }
    }

    public function edit_seniority_level($id)
    {
        $level = SeniorityLevel::where("SeniorityRef", $id)->first();

        return response()->json($level);
    }

    public function update_seniority_level(Request $request)
    {
        $level = SeniorityLevel::find($request->SeniorityRef);

        $level->update($request->except(['_token']));

        return redirect()->back()->with('success',  'Updated successfully');
    }

    public function delete_level($id)
    {
        $level = SeniorityLevel::where("SeniorityRef", $id);

        $level->delete();

        return redirect()->back()->with('success',  'Deleted successfully');
    }

}
