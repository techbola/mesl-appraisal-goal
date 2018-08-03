<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\BuildingProject;
use Cavidel\EstateInfo;
use Cavidel\EstateAllocation;
use Cavidel\Customer;
use DB;

class EstateController extends Controller
{
  public function estate_info()
  {
    $user = auth()->user();
    $estates = BuildingProject::where('CompanyID', $user->CompanyID)->orderBy('ProjectName')->get();
// dd($estates->units('T1'));

    return view('estates.info', compact('estates'));
  }

  public function get_blocks($estate_id)
  {
    $estate = BuildingProject::find($estate_id);
    // $blocks = $estate->blocks;
    $blocks = EstateAllocation::select(['EstateID', 'Block'])->where('EstateID', $estate_id)->groupBy(['Block', 'EstateID'])->get();
    return $blocks;
  }

  public function get_blocks_unassigned($estate_id)
  {
    $estate = BuildingProject::find($estate_id);
    // $blocks = $estate->blocks;
    $blocks = EstateAllocation::select(['EstateID', 'Block'])->where('EstateID', $estate_id)->where('AllotteeName', '')->groupBy(['Block', 'EstateID'])->get();
    return $blocks;
  }

  public function get_units($estate, $block)
  {
    $estate = BuildingProject::find($estate);
    $statuses = EstateInfo::all();

    $units = $estate->units($block);
    foreach ($units as $unit) {
      $unit->statuses = EstateInfo::all();
      $unit->Customer = $unit->customer->Customer ?? '';
    }

    return $units;
  }

  public function get_units_unassigned($estate, $block)
  {
    $estate = BuildingProject::find($estate);
    $statuses = EstateInfo::all();

    $units = $estate->units_unassigned($block);
    foreach ($units as $unit) {
      $unit->statuses = EstateInfo::all();
    }

    return $units;
  }

  public function update_estate_info(Request $request)
  {
    foreach ($request->Units as $key => $unit) {
      $allocation = EstateAllocation::find($key);
      $allocation->EstateInfoID = $unit;
      $allocation->update();
    }
    return 'Units updated successfully';
    // return redirect()->back()->with('success', 'Units updated successfully');
  }

  public function estate_allocation()
  {
    $user = auth()->user();
    $estates = BuildingProject::where('CompanyID', $user->CompanyID)->orderBy('ProjectName')->get();
    $customers = Customer::all();

    return view('estates.allocation', compact('estates', 'customers'));
  }

  public function update_estate_allocation(Request $request)
  {
    foreach ($request->Comments as $key => $comment) {
      $allocation = EstateAllocation::find($key);
      $allocation->Comment = $comment;
      $allocation->update();
    }
    foreach ($request->Customers as $key => $customer) {
      $allocation = EstateAllocation::find($key);
      $allocation->CustomerID = $customer;
      $allocation->update();
    }
    return 'Units updated successfully';
    // return redirect()->back()->with('success', 'Units updated successfully');
  }

  public function estate_status_report()
  {
    $user = auth()->user();
    $estates = BuildingProject::where('CompanyID', $user->CompanyID)->orderBy('ProjectName')->get();
    $statuses = EstateInfo::all();
    return view('estates.status_report', compact('estates', 'statuses'));
  }

  // With AllotteeName
  public function allocation_update()
  {
    $user = auth()->user();
    $estates = BuildingProject::where('CompanyID', $user->CompanyID)->orderBy('ProjectName')->get();
    // $customers = Customer::all();
    // $customers = Customer::distinct()->get(['Customer', 'CustomerRef']);
    // $customers = DB::table('tblCustomer')->distinct()->select('Customer', 'CustomerRef')->get();
    // $customers = Customer::groupBy(['Customer', 'CustomerRef'])->get(['Customer', 'CustomerRef']);
    $customers = DB::select(DB::raw('SELECT *
                  FROM (
                        SELECT  CustomerRef,Customer, ROW_NUMBER() OVER(PARTITION BY Customer ORDER BY CustomerRef DESC) rn FROM tblCustomer
                      ) a WHERE rn = 1'));
// dd($customers);

    return view('estates.allocation_update', compact('estates', 'customers'));
  }

}
