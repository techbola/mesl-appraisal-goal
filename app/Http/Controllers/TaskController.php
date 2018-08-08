<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\ProjectTask;
use Cavidel\Step;
use Cavidel\Staff;
use Cavidel\TaskUpdate;
use Carbon;
use DB;

use Cavidel\StepUpdate;

class TaskController extends Controller
{
    public function view($id)
    {
      $user = auth()->user();
      $task = ProjectTask::find($id);
      $staffs = Staff::where('CompanyID', $task->project->CompanyID)->get();
      return view('tasks.view', compact('task', 'user', 'staffs'));
    }

    public function add_step(Request $request, $id)
    {
      DB::transaction(function() use($request, $id){
        $user = auth()->user();
        $this->validate($request, [
          'Step' => 'required',
        ]);
        $step = new Step;
        $step->Step = $request->Step;
        $step->StartDate = $request->StartDate;
        $step->EndDate = $request->EndDate;
        $step->InputterID = $user->id;
        $step->TaskID = $id;
        // $step->BudgetCost = $request->BudgetCost;
        $step->save();

        if (!empty($request->BudgetCost)) {
          $pending = new StepUpdate;
          $pending->StepID = $step->StepRef;
          $pending->BudgetCost = $request->BudgetCost;
          $pending->CompanyID = $user->CompanyID;
          $pending->save();
        }
      });

      return redirect()->back()->with('success', 'Step was added successfully.');
    }

    public function toggle_step(Request $request, $id)
    {
      $step = Step::find($id);
      if ($step->Done == '0') {
        $step->Done = '1';
        $step->CompletedDate = Carbon::now();
      } else {
        $step->Done = '0';
      }
      $step->update();
      $task = ProjectTask::where('TaskRef', $step->TaskID)->first()->append('ProgressPercent');
      return Step::where('StepRef', $id)->with('task')->first();
      // return $task;
    }

    public function edit_step(Request $request, $id)
    {
      DB::transaction(function() use($request, $id){
        $user = auth()->user();
        $step = Step::find($id);
        $this->validate($request, [
          'Step' => 'required',
        ]);
        $step->Step = $request->Step;
        $step->StartDate = $request->StartDate;
        $step->EndDate = $request->EndDate;
        // $step->BudgetCost = $request->BudgetCost;
        $step->update();

        if (!empty($request->BudgetCost)){
          $pending = new StepUpdate;
          $pending->StepID = $step->StepRef;
          $pending->BudgetCost = $request->BudgetCost;
          $pending->CompanyID = $user->CompanyID;
          $pending->save();
        }

      });
      return redirect()->back()->with('success', 'Step was updated successfully.');
    }

    public function delete_step(Request $request, $id)
    {
      $step = Step::find($id);
      $step->delete();

      return redirect()->back()->with('success', 'Step was deleted successfully.');
    }

    public function save_taskupdate(Request $request, $task_id)
    {
      $this->validate($request, [
        'Body' => 'required'
      ]);

      $task = ProjectTask::find($task_id);

      $msg = new TaskUpdate;
      $msg->Body = $request->Body;
      $msg->TaskID = $task_id;
      $msg->StaffID = auth()->user()->staff->StaffRef;
      $msg->save();

      return redirect()->back()->with('success', 'Your update was posted.');
    }


    public function review_step_budget()
    {
      $user = auth()->user();
      $updates = StepUpdate::where('CompanyID', $user->CompanyID)->get();

      return view('steps.review_budget', compact('updates'));
    }

    public function approve_step_budget(Request $request, $id)
    {
      $update = StepUpdate::find($id);
      $update->Status = '1';
      $update->update();
      return redirect()->back()->with('success', 'Budget was approved successfully');
    }

    public function reject_step_budget(Request $request, $id)
    {
      $update = StepUpdate::find($id);
      $update->Status = '0';
      $update->update();
      return redirect()->back()->with('success', 'Budget was rejected successfully');
    }

}
