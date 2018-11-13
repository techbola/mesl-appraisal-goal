<?php

namespace Cavi\Http\Controllers;

use Illuminate\Http\Request;
use Cavi\Contact;
use Cavi\Country;
use Cavi\User;
use Validator;
use Cavi\BusinessRelationshipType;

class ContactController extends Controller
{
    public function index()
    {
        $user  = auth()->user();
        $users = User::whereHas('staff', function ($q) use ($user) {
            $q->where('CompanyID', $user->CompanyID);
        })->get();

        if ($user->is_superadmin) {
            $contacts = Contact::orderBy('Customer')->get();
        } else {
            $contacts = Contact::where('CompanyID', $user->staff->CompanyID)->orderBy('Customer')->get();
        }
        $relationship_types = BusinessRelationshipType::select(['BusinessRelationshipTypeRef', 'RelationshipType'])->get();
        $countries          = Country::orderBy('Country', 'asc')->get();

        return view('contacts.index', compact('user', 'contacts', 'countries', 'users', 'relationship_types'));
    }

    public function save_contact(Request $request)
    {
        $this->validate($request, [
            'Customer' => 'required',
        ]);

        $contact            = Contact::create($request->except(['_token', 'Assignees']));
        $contact->CompanyID = auth()->user()->staff->CompanyID;
        if (!empty($request->AccountFlag)) {
            $contact->AccountFlag = '1';
        } else {
            $contact->AccountFlag = '0';
        }
        // $contact->Assignees = $request->Assignees;
        if (!empty($request->Assignees)) {
            $assignees          = implode(',', $request->Assignees);
            $contact->Assignees = $assignees;
        }
        $contact->InputterID = auth()->user()->id;
        $contact->save();

        return redirect()->back()->with('success', $contact->Customer . ' was saved successfully.');
    }

    public function contact_post_ajax(Request $request)
    {
        // return response()->json($request->all(), 200);
        $validator = Validator::make($request->all(), [
            'Customer' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->messages()->all()], 500);
        }

        $contact            = Contact::create($request->except(['_token', 'Assignees']));
        $contact->CompanyID = auth()->user()->staff->CompanyID;
        if (!empty($request->AccountFlag)) {
            $contact->AccountFlag = '1';
        } else {
            $contact->AccountFlag = '0';
        }
        // $contact->Assignees = $request->Assignees;
        if (!empty($request->Assignees)) {
            $assignees          = implode(',', $request->Assignees);
            $contact->Assignees = $assignees;
        }
        $contact->InputterID = auth()->user()->id;
        $contact->save();

        return response()->json(['success' => true, 'data' => $contact, 'message' => 'Contact was added'], 200);
    }

    public function edit_contact($id)
    {
        $user               = auth()->user();
        $person             = Contact::find($id);
        $countries          = Country::orderBy('Country', 'asc')->get();
        $relationship_types = BusinessRelationshipType::select(['BusinessRelationshipTypeRef', 'RelationshipType'])->get();
        $users              = User::whereHas('staff', function ($q) use ($user) {
            $q->where('CompanyID', $user->CompanyID);
        })->get();

        return view('contacts.edit', compact('user', 'person', 'countries', 'users', 'relationship_types'));
    }

    public function update_contact(Request $request, $id)
    {
        $this->validate($request, [
            'Customer' => 'required',
        ]);

        $contact = Contact::find($id);
        $contact->fill($request->except(['_token', '_method', 'Assignees']));
        if (!empty($request->Assignees)) {
            $assignees          = implode(',', $request->Assignees);
            $contact->Assignees = $assignees;
        }
        $contact->update();

        return redirect()->route('business_contacts')->with('success', $contact->Name . ' was updated successfully.');
    }

}
