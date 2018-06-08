<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\ScoreCard;
use Cavidel\Staff;

use Auth;

class ScoreCardController extends Controller
{
  public function create($id)
  {
    $staff = Staff::find($id);
    return view('scorecard.create', compact('staff'));
  }

  public function store(Request $request, $id){
    $user = Auth::user();
    $staff = Staff::find($id);

      foreach ($request->KPI as $key => $KPI) {
        // dd($request->KPI[$key]);
        $row = new ScoreCard;
        $row->KPI = $request->KPI[$key];
        $row->Target = $request->Target[$key];
        $row->Achievement = $request->Achievement[$key];
        $row->Comment = $request->Comment[$key];
        $row->PeriodFrom = $request->PeriodFrom[$key];
        $row->PeriodTo = $request->PeriodTo[$key];
        $row->StaffID = $staff->StaffRef;
        $row->InitiatorID = $user->staff->StaffRef;
        $row->save();
      }
      return redirect()->route('staff.show', $staff->StaffRef)->with('success', 'Score card was saved successfully.');
  }

}
