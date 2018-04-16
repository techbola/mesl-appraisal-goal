<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KnowledgeItem;
use App\KnowledgeCategory;

class KnowledgeController extends Controller
{

  public function categories()
  {
    $user = auth()->user();
    $categories = KnowledgeCategory::where('CompanyID', $user->staff->CompanyID)->get();

    return view('knowledgebase.categories', compact('categories'));
  }

  public function save_category(Request $request)
  {
    $this->validate($request, [
      'Name' => 'required'
    ]);
    $user = auth()->user();
    $cat = new KnowledgeCategory;
    $cat->Name = $request->Name;
    $cat->CompanyID = $user->staff->CompanyID;
    $cat->CreatedBy = $user->id;
    $cat->save();

    return redirect()->back()->with('success', 'KnowledgeBase category saved successfully');

  }


}
