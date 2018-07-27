<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\BuildingProject;
use Cavidel\EstateInfo;
use Cavidel\EstateAllocation;

class EstateController extends Controller
{
  public function estate_allocation()
  {
    $user = auth()->user();
    $estates = BuildingProject::where('CompanyID', $user->CompanyID)->get();
// dd($estates->units('T1'));

    return view('estates.allocation', compact('estates'));
  }

  public function get_blocks($estate_id)
  {
    $estate = BuildingProject::find($estate_id);
    // $blocks = $estate->blocks;
    $blocks = EstateAllocation::select(['EstateID', 'Block'])->where('EstateID', $estate_id)->groupBy(['Block', 'EstateID'])->get();
    return $blocks;
  }

  public function get_units($estate, $block)
  {
    $estate = BuildingProject::find($estate);
    $statuses = EstateInfo::all();

    $units = $estate->units($block);
    foreach ($units as $unit) {
      $unit->statuses = EstateInfo::all();
    }

    return $units;
  }

  public function update_allocation(Request $request)
  {
    // dd($request->Units);
    foreach ($request->Units as $key => $unit) {
      $allocation = EstateAllocation::find($key);
      $allocation->EstateInfoID = $unit;
      $allocation->update();
    }
    return 'Units updated successfully';
    // return redirect()->back()->with('success', 'Units updated successfully');
  }

}
