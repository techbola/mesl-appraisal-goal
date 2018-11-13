<?php

namespace Cavi\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Cavi\Customer;

class ClientController extends Controller
{
    public function index()
    {

        return view('clients.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'Customer' => 'required',
        ]);

        $user   = auth()->user()->id;
        $client = new Customer($request->all());
        if ($client->save()) {
            return redirect()->route('SearchClient')->with('success', 'Client was created successfully');
        } else {
            return redirect()->back()->with('error', 'The client could not be created at this time.');
        }

    }
}
