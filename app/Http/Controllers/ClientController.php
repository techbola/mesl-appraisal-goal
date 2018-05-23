<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Cavidel\Client;

class ClientController extends Controller
{
  public function index()
  {
    $user = auth()->user();
    if ($user->is_superadmin) {
      $clients = Client::all();
    } else {
      $clients = Client::where('CompanyID', $user->staff->company->CompanyRef)->get();
    }
    return view('clients.index', compact('clients'));
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'Name' => 'required',
    ]);

    $user = auth()->user();

    try {
      DB::beginTransaction();
      $client = new Client;
      $client->Name = $request->Name;
      $client->CompanyID = $user->staff->company->CompanyRef;
      $client->save();
      DB::commit();
      return redirect()->back()->with('success', 'Client was created successfully');
    } catch (Exception $e) {
      DB::rollback();
      return redirect()->back()->with('error', 'The client could not be created at this time.');
    }

  }
}
