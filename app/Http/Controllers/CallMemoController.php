<?php

namespace Cavi\Http\Controllers;

use Illuminate\Http\Request;
use Cavi\CallMemo;
use Cavi\CallMemoDiscussion;
use Cavi\CallMemoAction;
use Cavi\CallMemoActionStatus;
use Cavi\CallMemoMeetingType;
use Cavi\CallMemoFile;
use Cavi\Contact;
use Cavi\Staff;
use Cavi\HelpersOld;
use Mail;
use Cavi\Mail\SendCallMemo;

use DB;
use PDF;
use Storage;

class CallMemoController extends Controller
{
    public function view($id)
    {
        $user          = auth()->user();
        $contact       = Contact::find($id);
        $staffs        = Staff::where('CompanyID', $user->staff->CompanyID)->get();
        $statuses      = CallMemoActionStatus::all();
        $meeting_types = CallMemoMeetingType::all();
        // $memos = DB::table('tblCallMemo')->whereRaw('FIND_IN_SET('.$user->email.', AttendeeEmails)')->get();
        // dd($memos);
        return view('call_memo.view', compact('contact', 'staffs', 'statuses', 'user', 'meeting_types'));
    }

    public function create($id)
    {

        $contact       = Contact::find($id);
        $meeting_types = CallMemoMeetingType::all();
        return view('call_memo.create', compact('contact', 'meeting_types'));
    }

    public function store(Request $request, $id)
    {
        $contact = Contact::find($id);
        $user    = auth()->user();

        DB::transaction(function () use ($request, $user, $contact, $id) {

            $memo                 = new CallMemo;
            $memo->Attendees      = $request->Attendees;
            $memo->Handouts       = $request->Handouts;
            $memo->Location       = $request->Location;
            $memo->MeetingDate    = $request->MeetingDate;
            $memo->MeetingTypeID  = $request->MeetingTypeID;
            $memo->CompanyID      = $user->staff->CompanyID;
            $memo->CustomerID     = $id;
            $memo->AttendeeEmails = $request->AttendeeEmails;
            $memo->InputterID = $user->id;
            $memo->save();

            if (!empty($request->discussions)) {
                foreach ($request->discussions as $key => $discuss) {
                    $disc                  = new CallMemoDiscussion;
                    $disc->DiscussionPoint = $discuss;
                    $disc->CallMemoID      = $memo->CallMemoRef;
                    $disc->save();
                }
            }
            if (!empty($request->MeetingFiles)) {
                foreach ($request->MeetingFiles as $file) {
                  $filename = $file->getClientOriginalName();
                  // $saved    = $file->storeAs('meeting_files', $filename);
                  $saved    = Storage::disk('public')->put('meeting_files/'.$filename, $file);

                  if ($saved) {
                    $new_file = new CallMemoFile;
                    $new_file->Filename = $filename;
                    $new_file->CallMemoID = $memo->CallMemoRef;
                    $new_file->InputterID = $user->id;
                    $new_file->save();
                  }

                }
            }
        });

        return redirect()->route('view_call_memo', $id)->with('success', 'Call memo saved successfully');

    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();

        DB::transaction(function () use ($request, $user, $id) {

            $memo                = CallMemo::find($id);
            $memo->Attendees     = $request->Attendees;
            $memo->Handouts      = $request->Handouts;
            $memo->Location      = $request->Location;
            $memo->MeetingDate   = $request->MeetingDate;
            $memo->MeetingTypeID = $request->MeetingTypeID;
            // $memo->CompanyID = $user->staff->CompanyID;
            // $memo->CustomerID = $id;
            $memo->AttendeeEmails = $request->AttendeeEmails;
            $memo->update();

            // if (!empty($request->discussions)) {
            //   foreach ($request->discussions as $key => $discuss) {
            //     $disc = new CallMemoDiscussion;
            //     $disc->DiscussionPoint = $discuss;
            //     $disc->CallMemoID = $memo->CallMemoRef;
            //     $disc->save();
            //   }
            // }
        });
        return redirect()->back()->with('success', 'The Call memo has been updated successfully');
    }

    public function store_action_point(Request $request, $id)
    {
        $user = auth()->user();

        // $discuss = CallMemoDiscussion::find($id);
        $action               = new CallMemoAction;
        $action->ActionPoint  = $request->ActionPoint;
        $action->StartDate    = $request->StartDate;
        $action->EndDate      = $request->EndDate;
        $action->UserID       = $request->UserID;
        $action->DiscussionID = $id;
        $action->StatusID     = $request->StatusID;
        $action->InitiatorID  = $user->id;
        $action->save();

        return redirect()->back()->with('success', 'Action point saved successfully');
    }

    public function edit_action_point($id)
    {
        $action   = CallMemoAction::find($id);
        $statuses = CallMemoActionStatus::all();

        return view('call_memo.edit_action', compact('action', 'statuses'));
    }

    public function update_action_point(Request $request, $id)
    {
        $user = auth()->user();

        // $discuss = CallMemoDiscussion::find($id);
        $action = CallMemoAction::find($id);
        // $action->ActionPoint = $request->ActionPoint;
        // $action->StartDate = $request->StartDate;
        // $action->EndDate = $request->EndDate;
        // $action->UserID = $request->UserID;
        $action->StatusID = $request->StatusID;
        $action->Comment  = $request->Comment;
        $action->update();

        return redirect()->route('call-memo-actions')->with('success', 'Action point updated successfully');
    }

    public function update_action(Request $request, $id)
    {
        $user = auth()->user();

        $action = CallMemoAction::find($id);
        $action->ActionPoint = $request->ActionPoint;
        $action->StartDate = $request->StartDate;
        $action->EndDate = $request->EndDate;
        $action->UserID = $request->UserID;
        $action->StatusID = $request->StatusID;
        $action->Comment  = $request->Comment;
        $action->update();

        return redirect()->back()->with('success', 'Action point updated successfully');
    }

    public function store_discussion_point(Request $request, $id)
    {
        $user = auth()->user();

        $disc                  = new CallMemoDiscussion;
        $disc->DiscussionPoint = $request->DiscussionPoint;
        $disc->CallMemoID      = $id;
        $disc->save();

        return redirect()->back()->with('success', 'Discussion point saved successfully');
    }

    public function update_discussion_point(Request $request, $id)
    {
        $user = auth()->user();

        $disc                  = CallMemoDiscussion::find($id);
        $disc->DiscussionPoint = $request->DiscussionPoint;
        $disc->update();

        return redirect()->back()->with('success', 'Discussion point was updated successfully');
    }

    public function email_attendees(Request $request, $id)
    {
        $memo = CallMemo::find($id);
        // dd($memo->customer);
        $emails = explode(',', $memo->AttendeeEmails);
        // foreach ($emails as $email) {
        //   HelpersOld::send_mail($email, $memo);
        // }

        // Transform emails to user objects
        // $users = [];
        // foreach($emails as $key => $email){
        //   $u = [];
        //   $u['email'] = $email;
        //   $u['name'] = 'Name';
        //   $users[$key] = (object)$u;
        // }
        foreach ($emails as $email) {
            Mail::to($email)->send(new SendCallMemo($memo));
        }
        return redirect()->back()->with('success', 'The attendees have been emailed successfully');
    }

    public function call_memo_actions()
    {
        $user = auth()->user();

        // $actions = CallMemoAction::where('StaffID', $user->staff->StaffRef)->get();
        $call_memos = CallMemo::whereHas('discussions', function ($query1) use ($user) {
            $query1->whereHas('actions', function ($query2) use ($user) {
                $query2->where('UserID', $user->id);
            });
        })->get();
        $statuses = CallMemoActionStatus::all();
        return view('call_memo.staff_actions', compact('call_memos', 'user', 'statuses'));
    }

    public function fetch_discussion($id)
    {
      $disc = CallMemoDiscussion::find($id);
      return $disc;
    }

    public function fetch_action($id)
    {
      $action = CallMemoAction::find($id);
      return $action;
    }

}
