<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IssueItem;
use App\IssueCategory;

class IssueController extends Controller
{

  public function categories()
  {
    $user = auth()->user();
    $categories = IssueCategory::where('CompanyID', $user->staff->CompanyID)->get();

    return view('issues.categories', compact('categories'));
  }

  public function save_category(Request $request)
  {
    $this->validate($request, [
      'Category' => 'required'
    ]);
    $user = auth()->user();
    $cat = new IssueCategory;
    $cat->Name = $request->Category;
    $cat->CompanyID = $user->staff->CompanyID;
    $cat->CreatedBy = $user->id;
    $cat->save();

    return redirect()->back()->with('success', 'Issue category was saved successfully');

  }

  public function category_items($id)
  {
    $category = IssueCategory::find($id);
    $issues = IssueItem::all();

    return view('issues.category_items', compact('issues', 'category'));
  }


  public function save_issue(Request $request, $cat_id)
  {
    $this->validate($request, [
      'Item' => 'required'
    ]);
    $user = auth()->user();
    $issue = new IssueItem;
    $issue->Item = $request->Item;
    $issue->CategoryID = $user->staff->CompanyID;
    $issue->Description = $request->Description;
    $issue->Solution = $request->Solution;
    $issue->CompanyID = $user->staff->CompanyID;
    $issue->CreatedBy = $user->id;
    $issue->save();

    return redirect()->back()->with('success', 'Issue was saved successfully');

  }


}
