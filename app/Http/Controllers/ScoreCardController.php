<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\ScoreCard;
use Cavidel\Staff;

use Auth;

class ScoreCardController extends Controller
{
  public function index()
  {
    $staff = Staff::find(auth()->user()->id);
    return view('scorecard.index', compact('staff'));
  }

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
        // $row->Achievement = $request->Achievement[$key];
        // $row->Comment = $request->Comment[$key];
        $row->PeriodFrom = $request->PeriodFrom[$key];
        $row->PeriodTo = $request->PeriodTo[$key];
        $row->StaffID = $staff->StaffRef;
        $row->InitiatorID = $user->staff->StaffRef;
        $row->save();
      }
      return redirect()->back()->with('success', 'Score card was saved successfully.');
  }

  public function update(Request $request, $id){
    $user = Auth::user();
    $score = ScoreCard::find($id);

    $score->Achievement = $request->Achievement;
    $score->Comment = $request->Comment;
    if ($user->hasRole('admin')) {
      $score->KPI = $request->KPI;
      $score->Target = $request->Target;
      $score->PeriodFrom = $request->PeriodFrom;
      $score->PeriodTo = $request->PeriodTo;
    }
    $score->save();

      return redirect()->back()->with('success', 'Score card was updated successfully.');
  }

}
