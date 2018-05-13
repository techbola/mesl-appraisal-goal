<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectTask;
use App\Step;
use App\Staff;

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
      $this->validate($request, [
        'Step' => 'required',
      ]);
      $step = new Step;
      $step->Step = $request->Step;
      $step->StartDate = $request->StartDate;
      $step->EndDate = $request->EndDate;
      $step->TaskID = $id;
      $step->save();

      return redirect()->back()->with('success', 'Step was added successfully.');
    }

    public function toggle_step(Request $request, $id)
    {
      $step = Step::find($id);
      if ($step->Done == '0') {
        $step->Done = '1';
      } else {
        $step->Done = '0';
      }
      $step->save();
      $task = ProjectTask::find($step->TaskID);
      return $task->ProgressPercent;
    }

    public function edit_step(Request $request, $id)
    {
      $step = Step::find($id);
      $this->validate($request, [
        'Step' => 'required',
      ]);
      $step->Step = $request->Step;
      $step->StartDate = $request->StartDate;
      $step->EndDate = $request->EndDate;
      $step->save();
      return redirect()->back()->with('success', 'Step was updated successfully.');
    }

    public function delete_step(Request $request, $id)
    {
      $step = Step::find($id);
      $step->delete();

      return redirect()->back()->with('success', 'Step was deleted successfully.');
    }

}
