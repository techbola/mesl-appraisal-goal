<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\Contact;
use Cavidel\Title;
use Cavidel\HouseType;
use Cavidel\Conversation;
use DB;

class ConversationController extends Controller
{
  public function contacts()
  {
    $user = auth()->user();
    $contacts = Contact::where('CompanyID', $user->CompanyID)->whereHas('conversations')->get();
    $contacts_all = Contact::where('CompanyID', $user->CompanyID)->get();
    $titles = Title::all();
    $housetypes = HouseType::all();
    return view('conversations.contacts', compact('contacts', 'contacts_all', 'titles', 'housetypes'));
  }

  public function store_call_contact(Request $request)
  {
    $user = auth()->user();
    DB::transaction(function() use($request, $user){

      $conv = new Conversation;
      $conv->Conversation = $request->Conversation;

      if (!empty($request->ContactID)) {
        $conv->ContactID = $request->ContactID;
      } elseif (!empty($request->Customer)) {
        $contact = new Contact;
        $contact->Customer = $request->Customer;
        $contact->TitleID = $request->TitleID;
        $contact->MobilePhone1 = $request->MobilePhone1;
        $contact->Estate = $request->Estate;
        $contact->HouseTypeID = $request->HouseTypeID;
        $contact->CompanyID = $user->CompanyID;
        $contact->save();
        $conv->ContactID = $contact->CustomerRef;
      }

      $conv->Date = $request->Date;
      if ($request->SiteVisit) {
        $conv->SiteVisit = '1';
      } else{
        $conv->SiteVisit = '0';
      }
      if ($request->VisitCompleted) {
        $conv->VisitCompleted = '1';
      } else{
        $conv->VisitCompleted = '0';
      }
      $conv->save();
    });
    return redirect()->back()->with('success', 'Conversation added successfully.');
  }

  public function view_conversations($id)
  {
    $contact = Contact::find($id);
    return view('conversations.view_conversations', compact('contact'));
  }

  public function store_conversation(Request $request, $id)
  {
    $user = auth()->user();
    DB::transaction(function() use($request, $user, $id){

      $conv = new Conversation;
      $conv->Conversation = $request->Conversation;
      $conv->ContactID = $id;

      $conv->Date = $request->Date;
      if ($request->SiteVisit) {
        $conv->SiteVisit = '1';
      } else{
        $conv->SiteVisit = '0';
      }
      if ($request->VisitCompleted) {
        $conv->VisitCompleted = '1';
      } else{
        $conv->VisitCompleted = '0';
      }
      $conv->save();
    });
    return redirect()->back()->with('success', 'Conversation added successfully.');
  }

}
