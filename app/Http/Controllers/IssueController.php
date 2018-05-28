<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\IssueItem;
use Cavidel\IssueCategory;
use Cavidel\Project;

class IssueController extends Controller
{

  public function categories()
  {
    $user = auth()->user();
    $projects = Project::where('CompanyID', $user->staff->CompanyID)->get();

    return view('issues.categories', compact('projects'));
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

  public function project_issues($id)
  {
    // $category = IssueCategory::find($id);
    $project = Project::find($id);
    $issues = IssueItem::where('ProjectID', $id)->get();

    return view('issues.project_issues1', compact('issues', 'project'));
  }


  public function save_issue(Request $request, $project_id)
  {
    $this->validate($request, [
      'Name' => 'required'
    ]);
    $user = auth()->user();
    $issue = new IssueItem;
    $issue->Name = $request->Name;
    $issue->ProjectID = $project_id;
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
