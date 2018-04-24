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
      return 'OK';
    }

    public function edit_step(Request $request, $id)
    {
      $step = Step::find($id);
      $this->validate($request, [
        'Step' => 'required',
      ]);
      $step->Step = $request->Step;
      $step->save();
      return redirect()->back()->with('success', 'Step was updated successfully.');
    }

}
