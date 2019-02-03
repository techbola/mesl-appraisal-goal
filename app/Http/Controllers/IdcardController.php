<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MESL\User;
use MESL\Staff;
use MESL\CompanyDepartment;
use MESL\IdcardRequest;
use MESL\Mail\IDcardCreation;
use Mail;

class IdcardController extends Controller
{
    public function create()
    {
        $user       = \Auth::user();
        $id         = \Auth::user()->id;
        $department = CompanyDepartment::all();
        $staff      = Staff::where('CompanyID', $user->CompanyID)->get();
        $idcard_requests    = IdcardRequest::orderBy('IDcardRequestRef', 'DESC')
                                                ->where('SentForApproval', 0)                                     
                                                ->get();
        return view('idcard_request.create', compact('staff', 'department', 'idcard_requests'));
    }

    public function store_idcard(Request $request)
    {   
        $user       = \Auth::user();
        $department = CompanyDepartment::all();
        $staff      = Staff::where('CompanyID', $user->CompanyID)->get();

        $idcard_request = new IdcardRequest($request->all());

         //Upload function
         if ($request->hasFile('Passport')) {
            $filenamewithextension = $request->file('Passport')->getClientOriginalName();
            $filename              = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension             = $request->file('Passport')->getClientOriginalExtension();
            $filenametostore       = $filename . '_' . time() . '.' . $extension;
            $request->file('Passport')->storeAs('public/passport_request', $filenametostore);

            $idcard_request              = new IdcardRequest;
            $idcard_request->Passport    = $filenametostore;
            $idcard_request->entered_by  = $user_id;
            $idcard_request->save();
        }

        if($idcard_request->save()){
            return redirect()->route('IdcardRequest')->with('success', 'Request was added successfully');
        }
    }

    public function idcard_dashboard()
    {
        $user = User::all();
        $user       = \Auth::user();
        $id         = \Auth::user()->id;
        $department = CompanyDepartment::all();
        $staff      = Staff::where('CompanyID', $user->CompanyID)->get();
        $staff      = Staff::where('CompanyID', $user->CompanyID)->get();

        $idcard_requests = IdcardRequest::orderBy('IDcardRequestRef', 'DESC')
                                        ->where('SentForApproval', 1)
                                        ->first();

        return view('idcard_request.id_requestdashboard',  compact('idcard_requests', 'department'));
    }

    public function send_idcard_request($id)
    {
        $user = auth()->user();

        $staff = Staff::all();

        $user = User::all();

        $idcard_request = IdcardRequest::find($id)
                                        ->where('SentForApproval', 0)
                                        ->first();

        $idcard_request->SentForApproval = 1 ;

        $idcard_request->update();

        $users = User::whereHas('staff', function($query){
            $query->where('DepartmentID', '2');
        })->get(); // ->toArray();

        Mail::to($users)->send(new IDcardCreation());

        return redirect()->route('IdcardRequest')->with('success', 'Request was Sent successfully');

    }

    //Delete ID card request function
    public function delete_card_request($id)
    {
        $idcard_request = IdcardRequest::find($id);

        $idcard_request->delete();
        
        return redirect()->route('IdcardRequest')->with('success', 'Request Deleted');
    }
}
