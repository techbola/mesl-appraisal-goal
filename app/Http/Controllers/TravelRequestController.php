<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use MESL\Country;
use MESL\Mail\RequestApproved;
use MESL\Mail\RequestRejected;
use MESL\Mail\TravelRequestAdmin;
use MESL\Mail\TravelRequestApprover;
use MESL\Mail\TravelRequestInit;
use MESL\Mail\TravelRequestSupervisor;
use MESL\Staff;
use MESL\State;
use MESL\Traveller;
use MESL\TravelLodge;
use MESL\TravelMode;
use MESL\TravelRequest;
use MESL\TravelTransport;
use MESL\User;

class TravelRequestController extends Controller {

	//Get data in the travel request table
	public function create() {

		$states = State::all();

		$countries = Country::all();

		$staffs = Staff::all();

		$transports = TravelTransport::all();

		$travel_requests = TravelRequest::orderBy('TravelRef', 'DESC')
			->Where('SentForApproval', '0')
			->Where('RequesterID', Auth::user()->id)
			->get();
		$sent_requests = TravelRequest::orderBy('TravelRef', 'DESC')
			->Where('SentForApproval', 1)
			->Where('RequesterID', Auth::user()->id)
			->get();
		$lodges = TravelLodge::all();
		$travelmodes = TravelMode::all();

		$user = User::all();

		return view('travel_request.create', compact('states', 'countries', 'staffs', 'travel_requests', 'sent_requests', 'transports', 'lodges', 'travelmodes'));
	}

	//Store travel request function
	public function store_travel_request(Request $request) {

		if (is_null(auth()->user()->staff->SupervisorID)) {
			return back()->withInput()->with('danger', 'Request Failed. You do not have a  supervisor');
		}
		try {

			\DB::beginTransaction();
			$travel_request = new TravelRequest($request->except(['TravellerPhone', 'TravellerFullName', 'TravellerCompany', 'TravellerStaffID', 'staff_options']));

			$travel_request->RequesterID = auth()->user()->id;
			$travel_request->SupervisorID = auth()->user()->staff->SupervisorID;

			//Upload function
			if ($request->hasFile('ReferenceLetter')) {
				$filenamewithextension = $request->file('ReferenceLetter')->getClientOriginalName();
				$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
				$extension = $request->file('ReferenceLetter')->getClientOriginalExtension();
				$filenametostore = $filename . '_' . time() . '.' . $extension;
				$request->file('ReferenceLetter')->storeAs('public/reference_letter', $filenametostore);

				$travel_request = new TravelRequest;
				$travel_request->ReferenceLetter = $filenametostore;
				$travel_request->entered_by = $user_id;

				$travel_request->save();
			}

			if ($travel_request->save()) {
				if ($request->staff_options) {
					foreach ($request->TravellerCompany as $key => $value) {

						// if ($saved) {
						$traveller = new Traveller([
							'TravelRef' => $travel_request->TravelRef,
							'StaffID' => $request->TravellerStaffID[$key] ?? null,
							'Phone' => $request->TravellerPhone[$key] ?? null,
							'Company' => $request->TravellerCompany[$key] ?? null,
							'FullName' => $request->TravellerFullName[$key] ?? null,
							// 'Path' => Storage::url('documents/'.$filename)
						]);
						$traveller->save();
						// }
					}
				}
				$requester_email = User::find($travel_request->RequesterID)->email;
				Mail::to($requester_email)->send(new TravelRequestInit($travel_request));
				\DB::commit();
				return redirect('/travel_request/create?queue=1')->with('success', 'Request was added successfully');
			}

		} catch (Exception $e) {
			\DB::rollback();
			return back()->withInput()->with('error', 'Something went wrong');
		}
	}

	//Edit travel request function
	public function edit_travel_request($id) {
		$travel_request = TravelRequest::find($id);

		return response()->json($travel_request);
	}

	//submit update travel request function
	public function submit_travel_request(Request $request) {
		$travel_request = TravelRequest::find($request->TravelRef);

		if ($request->hasFile('ReferenceLetter')) {
			$filenamewithextension = $request->file('ReferenceLetter')->getClientOriginalName();
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
			$extension = $request->file('ReferenceLetter')->getClientOriginalExtension();
			$filenametostore = $filename . '_' . time() . '.' . $extension;
			$request->file('ReferenceLetter')->storeAs('public/reference_letter', $filenametostore);
			$travel_request->ReferenceLetter = $filenametostore;
			$travel_request->entered_by = $user_id;
			// $travel_request->SupervisorID    = auth()->user()->staff->SupervisorID;
		}
		$travel_request->update($request->except(['_token']));

		return redirect()->route('travel_request.create')->with('success', 'Request was updated successfully');
	}

	//Delete travel request function
	public function destroy($id) {
		$travel_request = TravelRequest::find($id);

		$travel_request->delete();
		return redirect()->route('travel_request.create')->with('success', 'Request Deleted successfully');
	}

	//Approval function
	public function send_for_approval(Request $request, $ref) {

		$states = State::all();
		$countries = Country::all();

		$staffs = Staff::all();

		$transports = TravelTransport::all();

		$travel_requests = TravelRequest::orderBy('TravelRef', 'DESC')->get();

		$lodges = TravelLodge::all();
		$travelmodes = TravelMode::all();

		$user = User::all();

		$travel_request = User::all();

		$travel_request = TravelRequest::where('TravelRef', $ref)
			->where('SentForApproval', '0')
			->first();
		if ($travel_request) {
			$travel_request->SentForApproval = '1';
			$travel_request->update();

			$email = Staff::find($travel_request->SupervisorID)->user->email;

			Mail::to($email)->send(new TravelRequestSupervisor($travel_request));

			return redirect()->route('travel_request.create', compact('states', 'countries', 'staffs', 'travel_requests', 'transports', 'lodges', 'travelmodes'))->with('success', 'Request was sent successfully');
		} else {
			return redirect()->back()->with('error', 'Request already sent for approval ');
		}
	}

	//admin request dashboard (updated: to be approvvers screen )
	public function dash_approvers(Request $request) {

		$travel_requests = TravelRequest::where('SentForApproval', '1')
			->where('SupervisorID', auth()->user()->staff->StaffRef)
			->where('SupervisorApproved', 1)
			->where('ApproverID', auth()->user()->id)
			->get();

		// unapproved docs
		$unapproved_requests = TravelRequest::where('ApproverID', auth()->user()->id)
			->where('SentForApproval', 1)
			->get();
		$my_unsent_requests = TravelRequest::where('RequesterID', auth()->user()->id)->where('SentForApproval', 0);
		// approved docs
		$approved_requests = TravelRequest::where('ApproverID', 0)
			->where('ApprovedFlag', 1)
			->orWhere('ApproverID1', [auth()->user()->id])
			->orWhere('ApproverID2', [auth()->user()->id])
			->orWhere('ApproverID3', [auth()->user()->id])
			->orWhere('ApproverID4', [auth()->user()->id])
			->get();

		$staff = Staff::all()->sortBy('FullName');

		return view('travel_request.admindashboard_approvers', compact('travel_requests', 'staff', 'unapproved_requests', 'my_unsent_requests', 'approved_requests'));
	}

	public function dash(Request $request) {

		$travel_requests = TravelRequest::where('SentForApproval', 1)
			->where('SupervisorID', auth()->user()->staff->StaffRef)
			->where('SupervisorApproved', 0)
			->get();

		$travel_request = TravelRequest::find($request->TravelRef);

		$user = User::all();
		$staff = Staff::all()->sortBy('FullName');
		// dd($staff);

		return view('travel_request.admindashboard', compact('travel_requests', 'staff'));
	}

	// admin dashboard
	public function admindash(Request $request) {

		// if (auth()->user()->staff->SupervisorFlag == 1) {
		$travel_requests = TravelRequest::where('SentForApproval', 1)
			->where('RequestApproved', 1)
			->where('SupervisorApproved', 1)
			->where('ApproverID', 0)
			->where('AdminApproved', 0)
			->where('ApprovedFlag', 1)
			->get();
		// }
		// else {
		//     $travel_requests = collect([]);
		// }

		return view('travel_request.final_admindashboard', compact('travel_requests'));
	}

	//Approve travel request function for supervisors
	public function approve_request(Request $request, $ref) {
		$travel_request = TravelRequest::find($ref);
		if (is_null($request->Approver1) ||
			is_null($request->Approver2) ||
			is_null($request->Approver3) ||
			is_null($request->Approver4)) {

			$travel_request->RequestApproved = 1;
			$travel_request->ApproverComment = $request->ApproverComment;
			$travel_request->SupervisorApproved = 1;
			$travel_request->ApproverID = 0;
			$travel_request->ApprovedFlag = 1;

			$travel_request->update();
			$admin_users = User::whereHas('roles', function ($query) {
				$query->whereIn('name', ['hr admin', 'admin', 'ADMIN Officer', 'superadmin']);
			})->get();
			Mail::to($admin_users)->send(new TravelRequestAdmin($travel_request));

			return redirect()->route('travel_request.admindashboard')->with('success', 'Request Approved successfully');

		}

		$staffs = Staff::all();
		$user = User::all();

		$travel_request->ApprovalDate = date('Y-m-d');
		$travel_request = TravelRequest::where('TravelRef', $ref)->first();

		// dd($travel_request);
		$travel_request->RequestApproved = 1;
		$travel_request->ApproverComment = $request->ApproverComment;
		$travel_request->SupervisorApproved = 1;
		$travel_request->ApproverID = 0;
		// $travel_request->ApproverID1        = $request->Approver1 ?? 0;
		// $travel_request->ApproverID2        = $request->Approver2 ?? 0;
		// $travel_request->ApproverID3        = $request->Approver3 ?? 0;
		// $travel_request->ApproverID4        = $request->Approver4 ?? 0;

		$travel_request->update();

		// $email = User::find($travel_request->RequesterID)->first()->email;
		// dd($request->all());

		if (!null($travel_request->ApproverID) || ($travel_request->ApproverID != 0)) {
			Mail::to($travel_request->current_approver->email)->send(new TravelRequestApprover($travel_request));
		} elseif ($travel_request->ApproverID = 0) {
			$admin_users = User::whereHas('roles', function ($query) {
				$query->whereIn('name', ['hr admin', 'admin', 'ADMIN Officer', 'superadmin']);
			})->get();
			Mail::to($admin_users)->send(new TravelRequestAdmin($travel_request));
		}
		// send emails when ApproverID is null and send route request to admin

		//  end

		return redirect()->route('travel_request.admindashboard')->with('success', 'Request Approved successfully');
	}

// approvals
	public function approve(Request $request) {

		$ApprovedDate = $request->ApprovedDate;
		$SelectedID = collect($request->SelectedID);
		$ApproverID = $request->ApproverID;
		$Comment = $request->Comment;
		$ModuleID = 4;
		$ApprovedFlag = $request->ApprovedFlag;
		$new_array = array();
		foreach ($SelectedID as $value) {
			array_push($new_array, intval($value));
			$approve_proc = \DB::statement(
				"EXEC procApproveRequest  '$ApprovedDate', '$value', $ModuleID, '$Comment', $ApproverID, $ApprovedFlag"
			);
			$travel_request = TravelRequest::find($value);

			$next_approver = $travel_request->ApproverID != 0 ? Staff::where('UserID', $travel_request->ApproverID)->first()->user : null;
			$recipients = $travel_request->recipients;
			$recipients = collect($recipients);

			$recipients->transform(function ($item, $key) {
				$item = Staff::where('UserID', $item)->first()->user;
				return $item;
			});

			if (!is_null($next_approver) || $next_approver != 0) {
				Mail::to($next_approver->email)->send(new TravelRequestApprover($travel_request));
			} else {
				// Send mailto HR
			}
		}
		// $selected_ids = (implode(',', $new_array));

		// Send Notification to next Approver

		return response()->json([
			'message' => 'Travel Request was approved successfully',
		])->setStatusCode(200);
	}

	//Final Approval for travel request (role based)
	public function admin_approve_request(Request $request, $ref) {
		// dd($request->all());
		$staffs = Staff::all();
		// $travel_request = TravelRequest::find($ref);
		$travel_request = TravelRequest::find($ref);
		// dd($travel_request);
		$travel_request->ApprovalDate = date('Y-m-d');
		$travel_request->AdminApproved = 1;
		// $travel_request->ApproverComment = $request->ApproverComment;

		$travel_request->update();
		$email = User::find($travel_request->RequesterID)->first()->email;
		Mail::to($email)->send(new RequestApproved());
		return redirect()->route('travel_request.final-admindashboard')->with('success', 'Request Approved successfully');
	}

	//Reject travel request function
	public function reject_request(Request $request, $ref) {
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

	public function admin_reject_request(Request $request, $ref) {
		$staffs = Staff::all();

		$user = User::all();

		$travel_request = User::all();

		$travel_request = TravelRequest::where('TravelRef', $ref)
			->where('SentForApproval', 1)
			->first();
		$travel_request->SentForApproval = 0;
		$travel_request->AdminApproved = 0;

		$travel_request->update();

		$Requester = User::where("id", $travel_request->RequesterID)->first();

		Mail::to($Requester->email)->send(new RequestRejected());

		return redirect()->route('travel_request.admindashboard')->with('success', 'Request Rejected successfully');
	}
}
