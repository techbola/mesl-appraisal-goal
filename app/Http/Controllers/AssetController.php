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

}
