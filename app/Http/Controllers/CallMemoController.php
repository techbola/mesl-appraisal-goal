<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\CallMemo;
use Cavidel\CallMemoDiscussion;
use Cavidel\CallMemoAction;
use Cavidel\Customer;

use DB;

class CallMemoController extends Controller
{
  public function view($id)
  {
    $contact = Customer::find($id);
    return view('call_memo.view', compact('contact'));
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

}
