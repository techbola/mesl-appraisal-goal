<?php

namespace MESL\Http\Controllers;

use MESL\State;
use MESL\Country;
use MESL\TrainingAgency;
use MESL\TrainingType;
use MESL\User;
use MESL\Staff;
use Illuminate\Http\Request;

class TrainingController extends Controller
{

    public function training_agency_page()
    {
        $states    = State::all();
        $countries = Country::all();
        $agencies  = TravelAgency::orderBY('AgencyRef', 'ASC')->get();
        return view('training.training_agency', compact('states', 'countries', 'agencies'));
    }

    public function post_training_agency(Request $request)
    {
        $agency = new TravelAgency($request->all());
        $agency->save();
        return 'Successful';
    }

    public function get_clicked_agency($id)
    {
        $agency_ref     = $id;
        $agency_details = \DB::table('tblTrainingAgency')
            ->join('tblState', 'tblTrainingAgency.StateRef', '=', 'tblState.StateRef')
            ->join('tblCountry', 'tblTrainingAgency.CountryRef', '=', 'tblCountry.CountryRef')
            ->where('AgencyRef', $agency_ref)
            ->first();
        return response()->json($agency_details)->setStatusCode(200);
    }

    public function training_course_page()
    {
        $training_agencies = TrainingAgency::all();
        $states            = State::all();
        $countries         = Country::all();
        $courses           = \DB::table('tblTrainingType')
            ->join('tblTrainingAgency', 'tblTrainingType.AgencyRef', '=', 'tblTrainingAgency.AgencyRef')
            ->get();
        return view('training.training_course', compact('training_agencies', 'states', 'countries', 'courses'));
    }

    public function post_training_course(Request $request)
    {
        $course = new TrainingType($request->all());

        if ($request->hasFile('Filename')) {

            $filenamewithextension = $request->file('Filename')->getClientOriginalName();
            $filename              = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension             = $request->file('Filename')->getClientOriginalExtension();
            $filenametostore       = bcrypt($filename) . time() . '.' . $extension;

            $saveFile                = $request->file('Filename')->storeAs('public/Investigation', $filenametostore);
            $investigation->Filename = $filenametostore;
        }
        $course->save();
        return redirect()->back()->with('success', 'Course Created Successfully');
    }

    public function get_clicked_course($id)
    {
        $course_ref     = $id;
        $course_details = \DB::table('tblTrainingType')
            ->join('tblTrainingAgency', 'tblTrainingType.AgencyRef', '=', 'tblTrainingAgency.AgencyRef')
            ->join('tblState', 'tblTrainingType.State', '=', 'tblState.StateRef')
            ->join('tblCountry', 'tblTrainingType.Country', '=', 'tblCountry.CountryRef')
            ->where('TrainingTypeRef', $course_ref)
            ->first();
        return response()->json($course_details)->setStatusCode(200);
    }

    public function schedule_training()
    {
        $company_id = \Auth::user()->company_id;
        $staffs     = Staff::where('CompanyID', $company_id)->get(['UserID']);
        return view('training.schedule_training', compact('staffs'));
    }

}
