<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asset;

class AssetController extends Controller
{

  public function index()
  {
    $user = auth()->user();
    $assets = Asset::where('CompanyID', $user->staff->CompanyID)->get();

    return view('assets.index', compact('assets'));
  }

  public function save_asset(Request $request)
  {
    $this->validate($request, [
      'Description' => 'required',
    ]);

    $user = auth()->user();
    // $assets = Asset::where('CompanyID', $user->staff->CompanyID)->get();
    $asset = Asset::create($request->except(["_token"]));
    $asset->CompanyID = $user->staff->CompanyID;
    $asset->save();

    return redirect()->back()->with('success', 'The asset was saved successfully.');
  }

}
