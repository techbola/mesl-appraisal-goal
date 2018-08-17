<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\ProjectTask;
use Cavidel\Project;
use Cavidel\Step;
use Cavidel\Staff;
use Cavidel\TaskUpdate;
use Carbon;
use DB;

use Cavidel\StepBudget;
use Cavidel\StepBudgetPayment;

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
          $pending = new StepBudget;
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
          $pending = new StepBudget;
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


    public function enter_step_budget($project = null, $status = null)
    {
      $user = auth()->user();

      $budgets = StepBudget::where('CompanyID', $user->CompanyID)->get();
      $incomplete_steps = Step::where('Done', '0')->with('task.project.supervisor')->get();
      $projects = Project::where('CompanyID', $user->CompanyID)->get();

      $project_id = $_GET['project'] ?? '';
      $status = $_GET['status'] ?? '1';

      if (empty($project_id)) {
        $project = Project::first();
        $project_id = $project->ProjectRef;
        $steps = $project->steps()->where('Done', $status)->get();
        // $steps = Step::where('Done', $status)->where(function($query) use($user, $status){
        //   $query->whereHas('last_budget', function($query2) use($user, $status){
        //   $query2->where('Status', '0')->orWhere('Status', NULL)->orWhere('Status', '1');
        //   })->orWhereDoesntHave('last_budget');
        // })->orderBy('CompletedDate', 'desc')->get();
      } else {
        $project = Project::find($project_id);
        $steps = $project->steps()->where('Done', $status)->get();
        // $steps = $project->steps()->where('Done', $status)->where(function($query) use($user, $status){
        //   $query->whereHas('last_budget', function($query2) use($user, $status){
        //   $query2->where('Status', '0')->orWhere('Status', NULL)->orWhere('Status', '1');
        //   })->orWhereDoesntHave('last_budget');
        // })->orderBy('CompletedDate', 'desc')->get();
      }

      return view('steps.enter_budget', compact('select_projects', 'budgets', 'steps', 'incomplete_steps', 'projects', 'project_id', 'status'));
    }

    public function submit_budget(Request $request, $id)
    {
      $step = Step::find($id);
      $user = auth()->user();
      if (!empty($request->BudgetCost)){
        $pending = new StepBudget;
        $pending->StepID = $step->StepRef;
        $pending->BudgetCost = $request->BudgetCost;
        $pending->CompanyID = $user->CompanyID;
        $pending->save();
        return redirect()->back()->with('success', 'Budget sent successfully');
      }
    }

    public function submit_variation(Request $request, $id)
    {
      $step = Step::find($id);
      if (!empty($step->last_budget) && !empty($request->Variation)){
        $budget = $step->last_budget;
        $budget->Variation = $request->Variation;
        $budget->update();
        return redirect()->back()->with('success', 'Variation submitted successfully');
      } else {
        return redirect()->back()->with('error', 'No budget found. Submit a budget cost first.');
      }
    }

    public function review_step_budget($project = null, $status = null)
    {
      $user = auth()->user();
      $projects = Project::where('CompanyID', $user->CompanyID)->get();
      $project_id = $_GET['project'] ?? '';
      $status = $_GET['status'] ?? '1';

      if (empty($project_id)) {
        // $project = Project::find($project_id);
        $updates = StepBudget::where('CompanyID', $user->CompanyID)->whereHas('step', function($query) use($status){
          $query->where('Done', $status);
        })->orderBy('created_at', 'desc')->get();
      } else {
        $project = Project::find($project_id);
        $updates = StepBudget::where('CompanyID', $user->CompanyID)->whereHas('step', function($query1) use($project_id, $status){
          $query1->where('Done', $status)->whereHas('task', function($query2) use($project_id, $status){
            $query2->where('ProjectID', $project_id);
          });
        })->orderBy('created_at', 'desc')->get();
      }


      return view('steps.review_budget', compact('updates', 'project_id', 'status', 'projects'));
    }

    public function approve_step_budget(Request $request, $id)
    {
      $update = StepBudget::find($id);
      $update->Status = '1';
      $update->PaymentRejectedFlag = '0';
      $update->ApprovedBy = auth()->user()->id;
      $update->ApprovedDate = Carbon::now();
      $update->update();
      return redirect()->back()->with('success', 'Budget was approved successfully');
    }

    public function bulk_approve_budget(Request $request)
    {
      DB::transaction(function() use($request){
        foreach ($request->budget_ids as $id) {
          $update = StepBudget::find($id);
          $update->Status = '1';
          $budget->PaymentRejectedFlag = '0';
          $update->ApprovedBy = auth()->user()->id;
          $update->ApprovedDate = Carbon::now();
          $update->update();
        }
      });
      return 'Done';
    }

    public function bulk_reject_budget(Request $request)
    {
      DB::transaction(function() use($request){
        foreach ($request->budget_ids as $id) {
          $update = StepBudget::find($id);
          $update->Status = '0';
          $update->RejectedBy = auth()->user()->id;
          $update->RejectedDate = Carbon::now();
          $update->update();
        }
      });
      return 'Done';
    }

    public function reject_step_budget(Request $request, $id)
    {
      $update = StepBudget::find($id);
      $update->Status = '0';
      $update->update();
      return redirect()->back()->with('success', 'Budget was rejected successfully');
    }


    public function pay_step_budget()
    {
      $user = auth()->user();
      // $updates = StepBudget::where('CompanyID', $user->CompanyID)->where('Status', '1')->where('PaymentRejectedFlag', '0')->get();
      $updates = StepBudget::where('CompanyID', $user->CompanyID)->where('Status', '1')->orWhere('PaymentRejectedFlag', '1')->get();

      return view('steps.pay_budget', compact('updates'));
    }

    public function reject_step_payment(Request $request)
    {
      $user = auth()->user();
      $budget = StepBudget::find($request->budget_id);
      $budget->PaymentRejectedFlag = '1';
      $budget->Status = NULL;
      $budget->Comment = $request->comment;
      $budget->update();
      return 'OK';
    }

    public function store_step_payment(Request $request, $id)
    {
      $user = auth()->user();
      $step = Step::find($id);
      if ($request->Amount <= $step->payment_outstanding) {
        $payment = new StepBudgetPayment;
        $payment->StepID = $id;
        $payment->Amount = $request->Amount;
        $payment->InputterID = $user->id;
        $payment->CompanyID = $user->CompanyID;
        $payment->save();
        return redirect()->back()->with('success', 'Payment submitted successfully.');
      } else {
        return redirect()->back()->with('error', 'Amount cannot be bigger than the outstanding amount.');
      }


    }

    public function complete_step_payments()
    {
      $user = auth()->user();
      $payments = StepBudgetPayment::where('CompanyID', $user->CompanyID)->get();

      return view('steps.complete_payments', compact('payments'));
    }

    public function mark_step_payment(Request $request, $id)
    {
      $user = auth()->user();
      $payment = StepBudgetPayment::find($id);
      $payment->IsPaid = '1';
      $payment->update();

      return redirect()->back()->with('success', 'Payment marked as paid.');
    }

}
