<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\Project;
use Cavidel\Staff;
use Cavidel\User;
use Cavidel\ProjectTask;
use Cavidel\ProjectChat;
use Cavidel\Client;
use Cavidel\Customer;
use DB;
use Auth;
use Carbon;

use Event;
use Cavidel\Events\NewTaskEvent;
use Cavidel\Events\ProjectChatEvent;

use Notification;
use Cavidel\Notifications\NewTask;
use Cavidel\Notifications\ProjectChatNotification;

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
        if ($user->hasRole('admin')) {
          $projects = Project::where('CompanyID', $user->staff->CompanyID)->get();
        } else {
          $projects = $user->staff->projects_extended;
        }
        $supervisors = Staff::where('CompanyID', $user->staff->CompanyID)->get();
        $assignees = Staff::where('CompanyID', $user->staff->CompanyID)->get();
        $customers = Customer::where('CompanyID', $user->staff->CompanyID)->get();
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
        $project->CreatedBy = $user->id;
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
      $project = Project::where('ProjectRef', $id)->with(['tasks.staff', 'chats.staff', 'tasks.steps'])->first();

      // dd(Carbon::parse($project->EndDate)->format('m/d/Y'));

      $staffs = Staff::where('CompanyID', $project->CompanyID)->get();

      // For Edit Form
      if ($user->is_superadmin) {
        $supervisors = Staff::all();
        // $assignees = Staff::all();
        $customers = Customer::all();
      } else{
        $supervisors = Staff::where('CompanyID', $user->staff->CompanyID)->get();
        // $assignees = Staff::where('CompanyID', $user->staff->CompanyID)->get();
        $customers = Customer::where('CompanyID', $user->staff->CompanyID)->get();
      }

      $colors = ["#E65100", "#EF6C00", "#F57C00", "#558B2F", "#689F38", "#7CB342", "#8BC34A", "#4527A0", "#512DA8", "#5E35B1", "#673AB7", "#0277BD", "#0288D1", "#039BE5"];
      $gantt = [];
      foreach ($project->tasks as $key => $gtask) {
        $gantt[$key]['name'] = $gtask->Task;
        $gantt[$key]['series'] = [];
        foreach ($gtask->steps as $step_key => $gstep) {
          $gantt[$key]['series'][$step_key]['name'] = $gstep->Step;
          $gantt[$key]['series'][$step_key]['sub_series'] = [];
          $gantt[$key]['series'][$step_key]['sub_series'][0]['id'] = $step_key;
          $gantt[$key]['series'][$step_key]['sub_series'][0]['start'] = ($gstep->StartDate)? Carbon::parse($gstep->StartDate)->format('m-d-y') : date('m-d-Y');
          $gantt[$key]['series'][$step_key]['sub_series'][0]['end'] = ($gstep->EndDate)? Carbon::parse($gstep->EndDate)->format('m-d-y') : date('m-d-Y');
          $gantt[$key]['series'][$step_key]['sub_series'][0]['color'] = $colors[array_rand($colors)];
        }
      }
      $gantt = json_encode($gantt);
      // dd((object)$gantt);

      return view('projects.view_', compact('project', 'staffs', 'supervisors', 'assignees', 'customers', 'gantt'));
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
        $project->UpdatedBy = $user->id;
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

        if (!empty($request->StaffID)) {
          $staff_user = Staff::find($request->StaffID)->user;

          // I initiated the action so dont send notifications to me.
          if ($staff_user->id != $user->id) {
            Notification::send($staff_user, new NewTask($task));
            Event::fire(new NewTaskEvent($task->toArray()));
          }
        }


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

      $project = Project::find($request->ProjectID);

      $msg = new ProjectChat;
      $msg->Body = $request->Body;
      $msg->ProjectID = $request->ProjectID;
      $msg->StaffID = auth()->user()->staff->StaffRef;
      $msg->save();

      // Recipients to array
      $people = $project->user_ids;
      // Get sender's array key
      $my_key = array_search($msg->staff->UserID, $people);

      // Remove sender, replace with nothing. (haystack, start_key, count, replacement)
      array_splice($people, $my_key, 1);


      $event_data = [
        'body' => $msg->Body,
        'project_id' => $msg->ProjectID,
        'project' => $msg->project->Project,
        'sender' => $msg->staff->user->FullName,
        'sender_id' => $msg->StaffID,
        'date' => $msg->created_at->format('jS M, Y g:ia'),
        'recipients' => $people,
        'link' => route('view_project', $msg->ProjectID),
        'text' => 'New chat message in "'.$msg->project->Project.'" by '.$msg->staff->user->FullName
      ];
      $users = User::whereIn('id', $people)->get();

      Event::fire(new ProjectChatEvent( $event_data ));
      Notification::send($users, new ProjectChatNotification($msg));

      return redirect()->back()->with('success', 'Your message was posted.');
    }

}
