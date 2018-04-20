<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessContact;
use App\Country;

class BusinessContactController extends Controller
{
  public function index()
  {
    $user = auth()->user();
    $contacts = BusinessContact::where('CompanyID', $user->staff->CompanyID)->get();
    $countries = Country::orderBy('Country', 'asc')->get();


    return view('contacts.index', compact('user','contacts','countries'));
  }

  public function save_contact(Request $request)
  {
    $this->validate($request, [
      'Name' => 'required',
    ]);

    $contact = BusinessContact::create($request->all(['_token']));
    $contact->CompanyID = auth()->user()->staff->CompanyID;
    $contact->save();

    return redirect()->back()->with('success', $contact->Name.' was saved successfully.');
  }

  public function edit_contact($id)
  {
    $user = auth()->user();
    $contact = BusinessContact::find($id);
    $countries = Country::orderBy('Country', 'asc')->get();


    return view('contacts.edit', compact('user','contact','countries'));
  }

  public function update_contact(Request $request, $id)
  {
    $this->validate($request, [
      'Name' => 'required',
    ]);

    $contact = BusinessContact::find($id);
    $contact->update($request->except(['_token', '_method']));

    return redirect()->route('business_contacts')->with('success', $contact->Name.' was updated successfully.');
  }

}
