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
    $cat->Name = $request->Name;
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
      'Name' => 'required'
    ]);
    $user = auth()->user();
    $issue = new IssueItem;
    $issue->Name = $request->Name;
    $issue->CategoryID = $cat_id;
    $issue->Description = $request->Description;
    $issue->Solution = $request->Solution;
    $issue->CompanyID = $user->staff->CompanyID;
    $issue->CreatedBy = $user->id;
    $issue->save();

    return redirect()->back()->with('success', 'Issue was saved successfully');

  }

  public function update_issue(Request $request, $id)
  {
    $this->validate($request, [
      'Name' => 'required'
    ]);
    $user = auth()->user();
    $issue = IssueItem::find($id);
    $issue->Name = $request->Name;
    $issue->Description = $request->Description;
    $issue->Solution = $request->Solution;
    // $issue->CreatedBy = $user->id;
    $issue->update();

    return redirect()->back()->with('success', 'Issue was updated successfully');

  }

  public function view_issue($id)
  {
    $issue = IssueItem::find($id);

    return view('issues.view', compact('issue'));
  }


}
