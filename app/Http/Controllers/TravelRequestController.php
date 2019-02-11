<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MESL\State;
use MESL\Country;
use MESL\Staff;
use MESL\TravelRequest;
use MESL\TravelTransport;
use MESL\TravelLodge;
use MESL\TravelMode;
use MESL\Traveller;
use MESL\User;
use MESL\Mail\SendforApproval;
use MESL\Mail\RequestApproved;
use MESL\Mail\RequestRejected;
use Mail;

class TravelRequestController extends Controller
{

    //Get data in the travel request table
    public function create()
    {

        $states = State::all();

        $countries = Country::all();

        $staffs = Staff::all();

        $transports = TravelTransport::all();

        $travel_requests = TravelRequest::orderBy('TravelRef', 'DESC')
            ->Where('SentForApproval', '0')
            ->Where('RequesterID', Auth::user()->id)
            ->get();
        $lodges      = TravelLodge::all();
        $travelmodes = TravelMode::all();

        $user = User::all();
        return view('travel_request.create', compact('states', 'countries', 'staffs', 'travel_requests', 'transports', 'lodges', 'travelmodes'));
    }
    //Store travel request function
    public function store_travel_request(Request $request)
    {
        try {
            \DB::beginTransaction();
            $travel_request = new TravelRequest($request->except(['TravellerPhone', 'TravellerFullName', 'TravellerCompany', 'TravellerStaffID', 'staff_options']));

            $travel_request->RequesterID  = auth()->user()->id;
            $travel_request->SupervisorID = auth()->user()->staff->SupervisorID;

            //Upload function
            if ($request->hasFile('ReferenceLetter')) {
                $filenamewithextension = $request->file('ReferenceLetter')->getClientOriginalName();
                $filename              = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $extension             = $request->file('ReferenceLetter')->getClientOriginalExtension();
                $filenametostore       = $filename . '_' . time() . '.' . $extension;
                $request->file('ReferenceLetter')->storeAs('public/reference_letter', $filenametostore);

                $travel_request                  = new TravelRequest;
                $travel_request->ReferenceLetter = $filenametostore;
                $travel_request->entered_by      = $user_id;

                $travel_request->save();
            }

            if ($travel_request->save()) {
                if ($request->staff_options) {
                    foreach ($request->TravellerCompany as $key => $value) {

                        // if ($saved) {
                        $traveller = new Traveller([
                            'TravelRef' => $travel_request->TravelRef,
                            'StaffID'   => $request->TravellerStaffID[$key] ?? null,
                            'Phone'     => $request->TravellerPhone[$key] ?? null,
                            'Company'   => $request->TravellerCompany[$key] ?? null,
                            'FullName'  => $request->TravellerFullName[$key] ?? null,
                            // 'Path' => Storage::url('documents/'.$filename)
                        ]);
                        $traveller->save();
                        // }
                    }
                }
                \DB::commit();
                return redirect()->route('travel_request.create')->with('success', 'Request was added successfully');
            }

        } catch (Exception $e) {
            \DB::rollback();
            return back()->withInput()->with('error', 'Something went wrong');
        }
    }

    //Edit travel request function
    public function edit_travel_request($id)
    {
        $travel_request = TravelRequest::find($id);

        return response()->json($travel_request);
    }

    //submit update travel request function
    public function submit_travel_request(Request $request)
    {
        $travel_request = TravelRequest::find($request->TravelRef);

        if ($request->hasFile('ReferenceLetter')) {
            $filenamewithextension = $request->file('ReferenceLetter')->getClientOriginalName();
            $filename              = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension             = $request->file('ReferenceLetter')->getClientOriginalExtension();
            $filenametostore       = $filename . '_' . time() . '.' . $extension;
            $request->file('ReferenceLetter')->storeAs('public/reference_letter', $filenametostore);
            $travel_request->ReferenceLetter = $filenametostore;
            $travel_request->entered_by      = $user_id;
            // $travel_request->SupervisorID    = auth()->user()->staff->SupervisorID;
        }
        $travel_request->update($request->except(['_token']));

        return redirect()->route('travel_request.create')->with('success', 'Request was updated successfully');
    }

    //Delete travel request function
    public function destroy($id)
    {
        $travel_request = TravelRequest::find($id);

        $travel_request->delete();
        return redirect()->route('travel_request.create')->with('success', 'Request Deleted successfully');
    }

    //Approval function
    public function send_for_approval(Request $request, $ref)
    {

        $states    = State::all();
        $countries = Country::all();

        $staffs = Staff::all();

        $transports = TravelTransport::all();

        $travel_requests = TravelRequest::orderBy('TravelRef', 'DESC')->get();

        $lodges      = TravelLodge::all();
        $travelmodes = TravelMode::all();

        $user = User::all();

        $travel_request = User::all();
        $travel_request = TravelRequest::where('TravelRef', $ref)
            ->where('SentForApproval', '0')
            ->first();
        $travel_request->SentForApproval = '1';
        $travel_request->update();

        $email = Staff::find($travel_request->SupervisorID)->first()->user->email;

        Mail::to($email)->send(new SendforApproval());

        return redirect()->route('travel_request.create', compact('states', 'countries', 'staffs', 'travel_requests', 'transports', 'lodges', 'travelmodes'))->with('success', 'Request was sent successfully');

    }

    //admin request dashboard
    public function dash(Request $request)
    {

        $travel_requests = TravelRequest::where('SentForApproval', '1')
            ->where('SupervisorID', auth()->user()->staff->StaffRef)
            ->get();

        $travel_request = TravelRequest::find($request->TravelRef);

        $user = User::all();

        return view('travel_request.admindashboard', compact('travel_requests'));
    }

    // admin dashboard
    public function admindash(Request $request)
    {

        if (auth()->user()->staff->SupervisorFlag == 1) {
            $travel_requests = TravelRequest::where('SentForApproval', '1')
                ->where('RequestApproved', 1)
                ->get();
        } else {
            $travel_requests = collect([]);
        }

        return view('travel_request.final_admindashboard', compact('travel_requests'));
    }

    //Approve travel request function
    public function approve_request(Request $request, $ref)
    {
        $staffs = Staff::all();

        $user = User::all();

        $travel_request = User::all();

        $travel_request               = TravelRequest::find($ref);
        $travel_request->ApprovalDate = date('Y-m-d');
        $travel_request               = TravelRequest::where('TravelRef', $ref)
            ->where('RequestApproved', '0')
            ->first();
        $travel_request->RequestApproved = '1';
        $travel_request->ApproverComment = $request->ApproverComment;

        $travel_request->update();

        $email = User::find($travel_request->RequesterID)->first()->email;

        Mail::to($email)->send(new RequestApproved());

        return redirect()->route('travel_request.admindashboard')->with('success', 'Request Approved successfully');
    }

    //Final Approval for travel request (role based)
    public function admin_approve_request(Request $request, $ref)
    {
        $staffs = Staff::all();

        $user = User::all();

        $travel_request               = User::all();
        $travel_request               = TravelRequest::find($ref);
        $travel_request->ApprovalDate = date('Y-m-d');
        $travel_request               = TravelRequest::where('TravelRef', $ref)
            ->where('RequestApproved', '0')
            ->first();
        $travel_request->AdminApproved   = 1;
        $travel_request->ApproverComment = $request->ApproverComment;

        $travel_request->update();

        $email = User::find($travel_request->RequesterID)->first()->email;

        Mail::to($email)->send(new RequestApproved());

        return redirect()->route('travel_request.admindashboard')->with('success', 'Request Approved successfully');
    }

    //Reject travel request function
    public function reject_request(Request $request, $ref)
    {
        $staffs = Staff::all();

        $user = User::all();

        $travel_request = User::all();

        $travel_request = TravelRequest::where('TravelRef', $ref)
            ->where('SentForApproval', 1)
            ->first();
        $travel_request->SentForApproval = 0;

        $travel_request->update();

        $Requester = User::where("id", $travel_request->RequesterID)->first();

        Mail::to($Requester->email)->send(new RequestRejected());

        return redirect()->route('travel_request.admindashboard')->with('success', 'Request Rejected successfully');
    }

    public function admin_reject_request(Request $request, $ref)
    {
        $staffs = Staff::all();

        $user = User::all();

        $travel_request = User::all();

        $travel_request = TravelRequest::where('TravelRef', $ref)
            ->where('SentForApproval', 1)
            ->first();
        $travel_request->SentForApproval = 0;
        $travel_request->AdminApproved   = 0;

        $travel_request->update();

        $Requester = User::where("id", $travel_request->RequesterID)->first();

        Mail::to($Requester->email)->send(new RequestRejected());

        return redirect()->route('travel_request.admindashboard')->with('success', 'Request Rejected successfully');
    }
}
