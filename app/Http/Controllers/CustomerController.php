<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Country;

class CustomerController extends Controller
{
  public function index()
  {
    $user = auth()->user();
    if ($user->is_superadmin) {
      $contacts = Customer::all();
    } else {
      $contacts = Customer::where('CompanyID', $user->staff->CompanyID)->get();
    }
    $countries = Country::orderBy('Country', 'asc')->get();


    return view('contacts.index', compact('user','contacts','countries'));
  }

  public function save_contact(Request $request)
  {
    $this->validate($request, [
      'Customer' => 'required',
    ]);

    $contact = Customer::create($request->except(['_token']));
    $contact->CompanyID = auth()->user()->staff->CompanyID;
    if(!empty($request->AccountFlag)){
      $contact->AccountFlag = '1';
    } else {
      $contact->AccountFlag = '0';
    }
    $contact->save();

    return redirect()->back()->with('success', $contact->Customer.' was saved successfully.');
  }

  public function edit_contact($id)
  {
    $user = auth()->user();
    $contact = Customer::find($id);
    $countries = Country::orderBy('Country', 'asc')->get();

    return view('contacts.edit', compact('user','contact','countries'));
  }

  public function update_contact(Request $request, $id)
  {
    $this->validate($request, [
      'Name' => 'required',
    ]);

    $contact = Customer::find($id);
    $contact->update($request->except(['_token', '_method']));

    return redirect()->route('business_contacts')->with('success', $contact->Name.' was updated successfully.');
  }

}
