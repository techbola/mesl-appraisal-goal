<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Staff;
use App\User;
use App\ProjectTask;
use App\ProjectChat;
use App\Client;
use App\Customer;
use DB;
use Auth;

class ProjectController extends Controller
{
    public function index()
    {
      $user = auth()->user();

      if ($user->is_superadmin) {
        $supervisors = Staff::all();
        $assignees = Staff::all();
        $customers = Customer::all();
        $projects = Project::all();
      } else{
        $supervisors = Staff::where('CompanyID', $user->staff->CompanyID)->get();
        $assignees = Staff::where('CompanyID', $user->staff->CompanyID)->get();
        $customers = Customer::where('CompanyID', $user->staff->CompanyID)->get();
        $projects = Project::where('CompanyID', $user->staff->CompanyID)->get();
      }
      return view('projects.index', compact('projects', 'supervisors', 'assignees', 'customers'));
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'Project' => 'required',
        'StartDate' => 'required',
      ]);

      $user = Auth::user();

      try {
        DB::beginTransaction();
        $project = new Project;
        $project->Project = $request->Project;
        $project->SupervisorID = $request->SupervisorID;
        $project->StartDate = $request->StartDate;
        $project->EndDate = $request->EndDate;
        $project->Description = $request->Description;
        if ($user->is_superadmin) {
          $project->CompanyID = $request->CompanyID;
        } else {
          $project->CompanyID = auth()->user()->staff->CompanyID;
        }
        $project->CustomerID = $request->CustomerID;
        $project->save();

        // $project->assignees()->attach($request->Assignees);
        DB::commit();
        return redirect()->back()->with('success', 'The project was saved successfully');

      } catch (Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', 'The project could not be created at this time.');
      }

    }

    public function view_project($id)
    {
      $user = auth()->user();
      $project = Project::find($id);

      $staffs = Staff::where('CompanyID', $project->CompanyID)->get();

      // For Edit Form
      if ($user->is_superadmin) {
        $supervisors = Staff::all();
        $assignees = Staff::all();
        $customers = Customer::all();
      } else{
        $supervisors = Staff::where('CompanyID', $user->staff->CompanyID)->get();
        $assignees = Staff::where('CompanyID', $user->staff->CompanyID)->get();
        $customers = Customer::where('CompanyID', $user->staff->CompanyID)->get();
      }

      return view('projects.view', compact('project', 'staffs', 'supervisors', 'assignees', 'customers'));
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'Project' => 'required',
        'StartDate' => 'required',
      ]);

      $user = Auth::user();

      try {
        DB::beginTransaction();
        $project = Project::find($id);
        $project->Project = $request->Project;
        $project->SupervisorID = $request->SupervisorID;
        $project->StartDate = $request->StartDate;
        $project->EndDate = $request->EndDate;
        $project->Description = $request->Description;
        if ($user->is_superadmin) {
          $project->CompanyID = $request->CompanyID;
        } else {
          $project->CompanyID = auth()->user()->staff->CompanyID;
        }
        $project->CustomerID = $request->CustomerID;
        $project->save();

        // $project->assignees()->attach($request->Assignees);
        DB::commit();
        return redirect()->back()->with('success', 'The project was updated successfully');

      } catch (Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', 'The project could not be updated at this time.');
      }

    }


    public function save_task(Request $request)
    {
      $this->validate($request, [
        'Task' => 'required',
        'ProjectID' => 'required'
      ]);

      $user = Auth::user();

      try {
        DB::beginTransaction();
        $task = new ProjectTask;
        $task->Task = $request->Task;
        $task->ProjectID = $request->ProjectID;
        $task->StaffID = $request->StaffID;
        // $tak->StartDate = $request->StartDate;
        $task->EndDate = $request->EndDate;
        $task->CreatedBy = $user->id;

        $task->save();

        // $project->assignees()->attach($request->Assignees);
        DB::commit();
        return redirect()->back()->with('success', 'The task was saved successfully');

      } catch (Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', 'The task could not be created at this time.');
      }

    }

    public function update_task(Request $request, $id)
    {
      $this->validate($request, [
        'Task' => 'required',
      ]);

      $user = Auth::user();

      try {
        DB::beginTransaction();
        $task = ProjectTask::where('TaskRef', $id)->first();
        $task->Task = $request->Task;
        $task->StaffID = $request->StaffID;
        // $tak->StartDate = $request->StartDate;
        $task->EndDate = $request->EndDate;
        $task->UpdatedBy = $user->id;

        $task->update();

        // $project->assignees()->attach($request->Assignees);
        DB::commit();
        return redirect()->back()->with('success', 'The task was updated successfully');

      } catch (Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', 'The task could not be updated at this time.');
      }

    }

    public function save_projectchat(Request $request)
    {
      $this->validate($request, [
        'Body' => 'required'
      ]);

      $msg = new ProjectChat;
      $msg->Body = $request->Body;
      $msg->ProjectID = $request->ProjectID;
      $msg->StaffID = auth()->user()->staff->StaffRef;
      $msg->save();
      return redirect()->back()->with('success', 'Your message was posted.');
    }

}
