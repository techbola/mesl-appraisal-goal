<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\CallMemo;
use Cavidel\CallMemoDiscussion;
use Cavidel\CallMemoAction;
use Cavidel\Customer;
use Cavidel\Staff;

use DB;

class CallMemoController extends Controller
{
  public function view($id)
  {
    $user = auth()->user();
    $contact = Customer::find($id);
    $staffs = Staff::where('CompanyID', $user->staff->CompanyID)->get();
    return view('call_memo.view', compact('contact', 'staffs'));
  }

  public function create($id)
  {

    $contact = Customer::find($id);
    return view('call_memo.create', compact('contact'));
  }

  public function store(Request $request, $id)
  {
    $contact = Customer::find($id);
    $user = auth()->user();

    DB::transaction(function () use($request, $user, $contact, $id) {

          $memo = new CallMemo;
          $memo->Attendees = $request->Attendees;
          $memo->Handouts = $request->Handouts;
          $memo->Location = $request->Location;
          $memo->MeetingDate = $request->MeetingDate;
          $memo->CompanyID = $user->staff->CompanyID;
          $memo->CustomerID = $id;
          $memo->save();

          if (!empty($request->discussions)) {
            foreach ($request->discussions as $key => $discuss) {
              $disc = new CallMemoDiscussion;
              $disc->DiscussionPoint = $discuss;
              $disc->CallMemoID = $memo->CallMemoRef;
              $disc->save();
            }
          }
    });

    return redirect()->route('view_call_memo', $id)->with('success', 'Call memo saved successfully');

  }

public function store_action_point(Request $request, $id)
{
  $user = auth()->user();

  // $discuss = CallMemoDiscussion::find($id);
  $action = new CallMemoAction;
  $action->ActionPoint = $request->ActionPoint;
  $action->StartDate = $request->StartDate;
  $action->EndDate = $request->EndDate;
  $action->UserID = $request->UserID;
  $action->DiscussionID = $id;
  $action->save();

  return redirect()->back()->with('success', 'Action point saved successfully');
}

public function store_discussion_point(Request $request, $id)
{
  $user = auth()->user();

  // $discuss = CallMemoDiscussion::find($id);
  $disc = new CallMemoDiscussion;
  $disc->DiscussionPoint = $request->DiscussionPoint;
  // $disc->StartDate = $request->StartDate;
  // $disc->EndDate = $request->EndDate;
  // $disc->UserID = $request->UserID;
  $disc->CallMemoID = $id;
  $disc->save();

  return redirect()->back()->with('success', 'Discussion point saved successfully');
}

}
