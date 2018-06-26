<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\Asset;
use Cavidel\AssetCategory;
use Cavidel\Location;
use Cavidel\Staff;
use Cavidel\User;

class AssetController extends Controller
{

  public function index()
  {
    $user = auth()->user();
    $assets = Asset::where('CompanyID', $user->staff->CompanyID)->with(['location', 'category', 'allotee'])->get();
    $categories = AssetCategory::where('CompanyID', $user->staff->CompanyID)->get();
    $locations = Location::where('CompanyID', $user->CompanyID)->get();
    $employees = Staff::where('CompanyID', $user->CompanyID)->get();

    return view('assets.index', compact('assets', 'categories', 'locations', 'employees'));
  }

  public function save_asset(Request $request)
  {
    $this->validate($request, [
      'Description' => 'required',
    ]);

    $user = auth()->user();

    $asset = Asset::create($request->except(["_token", "Category", "CategoryID", "Location", "LocationID"]));
    $asset->CompanyID = $user->staff->CompanyID;
    // Category
    if (!empty($request->CategoryID)) {
      $asset->CategoryID = $request->CategoryID;
    } elseif (!empty($request->Category)) {
      $cat = new AssetCategory;
      $cat->AssetCategory = $request->Category;
      $cat->CompanyID = $user->CompanyID;
      $cat->save();
      $asset->CategoryID = $cat->AssetCategoryRef;
    }
    // Location
    if (!empty($request->LocationID)) {
      $asset->LocationID = $request->LocationID;
    } elseif (!empty($request->Location)) {
      $loc = new Location;
      $loc->Location = $request->Location;
      $loc->CompanyID = $user->CompanyID;
      $loc->save();
      $asset->LocationID = $loc->LocationRef;
    }

    $asset->AlloteeID = $request->AlloteeID;

    $asset->save();

    return redirect()->back()->with('success', 'The asset was saved successfully.');
  }

  public function update_asset(Request $request, $id)
  {
    $this->validate($request, [
      'Description' => 'required',
    ]);

    $user = auth()->user();
    $asset = Asset::where('AssetRef', $id)->first();
    $asset->fill($request->except(["_token", "_method", "Category", "CategoryID", "Location", "LocationID"]));

    // Category
    if (!empty($request->CategoryID)) {
      $asset->CategoryID = $request->CategoryID;
    } elseif (!empty($request->Category)) {
      $cat = new AssetCategory;
      $cat->AssetCategory = $request->Category;
      $cat->CompanyID = $user->CompanyID;
      $cat->save();
      $asset->CategoryID = $cat->AssetCategoryRef;
    }
    // Location
    if (!empty($request->LocationID)) {
      $asset->LocationID = $request->LocationID;
    } elseif (!empty($request->Location)) {
      $loc = new Location;
      $loc->Location = $request->Location;
      $loc->CompanyID = $user->CompanyID;
      $loc->save();
      $asset->LocationID = $loc->LocationRef;
    }

    $asset->AlloteeID = $request->AlloteeID;
    $asset->update();

    return redirect()->back()->with('success', 'The asset was updated successfully.');
  }

  public function delete_asset(Request $request, $id)
  {
    $asset = Asset::where('AssetRef', $id)->first();
    $asset->delete();

    return redirect()->back()->with('success', 'The asset was deleted successfully');
  }

}
