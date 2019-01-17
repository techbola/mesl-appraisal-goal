<?php

namespace MESL\Http\Controllers;

use MESL\Process;
use MESL\ProcessApprover;
use MESL\ProcessAttribute;
use MESL\ProcessRiskControl;
use MESL\ProcessSteps;
use MESL\ProcessDept;
use MESL\User;
use Illuminate\Http\Request;

class ProcessController extends Controller
{

    public function index()
    {
        $id        = \Auth()->user()->id;
        $check     = count(PolicyApprover::where('UserID', $id)->get()) > 0 ? PolicyApprover::where('UserID', $id)->get() : [];
        $depts     = ProcessDept::all();
        $processes = Process::all();

        return view('processes.index', compact('processes', 'check', 'depts'));
    }

    public function create()
    {
        $id        = \Auth()->user()->id;
        $check     = count(PolicyApprover::where('UserID', $id)->get()) > 0 ? PolicyApprover::where('UserID', $id)->get() : [];
        $processes = \DB::table('tblProcesses')
            ->join('users', 'tblProcesses.EnteredBy', '=', 'users.id')
            ->join('tblProcessDept', 'tblProcesses.process_dept_id', '=', 'tblProcessDept.DeptRef')
            ->orderBy('processRef', 'desc')
            ->get();
        $depts = ProcessDept::all();
        return view('processes.create', compact('processes', 'check', 'depts'));
    }

    public function store_process(Request $request)
    {
        $date               = \Carbon::now();
        $user_id            = \Auth::user()->id;
        $process            = new Process($request->all());
        $process->EntryDate = $date;
        $process->EnteredBy = $user_id;
        $process->save();
        return 'done';

    }

    public function delete_process($id)
    {
        $id    = $id;
        $trans = \DB::table('tblProcesses')->where('processRef', $id)->delete();
        return 'done';
    }

    public function update_process($id, $pro)
    {
        $id      = $id;
        $process = $pro;
        $trans   = \DB::table('tblProcesses')->where('processRef', $id)->update(['process' => $process]);
        return 'done';
    }

    public function create_process_steps()
    {
        $id        = \Auth()->user()->id;
        $check     = count(PolicyApprover::where('UserID', $id)->get()) > 0 ? PolicyApprover::where('UserID', $id)->get() : [];
        $depts     = ProcessDept::all();
        $processes = Process::all();
        return view('processes.create_process_steps', compact('processes', 'check', 'depts'));
    }

    public function get_process_steps($id)
    {
        $id          = $id;
        $steps_datas = ProcessSteps::where('ProcessID', $id)->orderBy('Step_Number', 'asc')->get();
        $attribute   = ProcessAttribute::where('process_id', $id)->first();
        $risk        = ProcessRiskControl::where('process_id', $id)->get();
        $multiple    = [
            'step'      => $steps_datas,
            'attribute' => $attribute == null ? collect([]) : $attribute,
            'risk'      => $risk,
        ];
        return response()->json($multiple)->setStatusCode(200);
    }

    public function get_process_steps_dept($id)
    {
        $id        = $id;
        $processes = Process::where('process_dept_id', $id)->get();
        return response()->json($processes)->setStatusCode(200);
    }

    public function get_process_steps_dept_index($id)
    {
        $id        = $id;
        $processes = Process::where('process_dept_id', $id)->get();
        return response()->json($processes)->setStatusCode(200);
    }

    public function post_process_step(Request $request)
    {
        $user_id    = \Auth::user()->id;
        $process_id = $request->ProcessID;
        $step_count = \DB::table('tblProcessSteps')
            ->where('ProcessID', $process_id)
            ->count();
        $step_number = $step_count + 1;

        $process_step              = new ProcessSteps($request->all());
        $process_step->Step_Number = $step_number;
        $process_step->EnteredBy   = $user_id;
        $process_step->save();

        $steps       = $request->ProcessID;
        $steps_datas = ProcessSteps::where('ProcessID', $steps)->orderBy('Step_Number', 'asc')->get();
        $attribute   = ProcessAttribute::where('process_id', $steps)->get();

        $multiple = [
            'step'      => $steps_datas,
            'attribute' => $attribute,
        ];
        return response()->json($multiple)->setStatusCode(200);
    }

    public function update_process_step(Request $request)
    {
        foreach ($request->ProcessStepRef as $key => $Ref) {
            \DB::table('tblProcessSteps')
                ->where('ProcessStepRef', $Ref)
                ->update(['Step_Number' => $request->Step_Number[$key]]);
        }

        $process_id = \DB::table('tblProcessSteps')
            ->select('ProcessID')
            ->where('ProcessStepRef', $request->ProcessStepRef[0])
            ->first();

        $steps_datas = ProcessSteps::where('ProcessID', $process_id->ProcessID)->orderBy('Step_Number', 'asc')->get();
        $attribute   = ProcessAttribute::where('process_id', $process_id->ProcessID)->get();

        $multiple = [
            'step'      => $steps_datas,
            'attribute' => $attribute,
        ];
        return response()->json($multiple)->setStatusCode(200);

    }

    public function get_step_values($id)
    {
        $process_step_id = $id;
        $step_datas      = ProcessSteps::where('ProcessStepRef', $process_step_id)->first();
        return response()->json($step_datas)->setStatusCode(200);
    }

    public function update_step_values(Request $request)
    {
        $id           = $request->ProcessStepRef;
        $process_step = ProcessSteps::where('ProcessStepRef', $id)->first();
        $process_step->update($request->except(['ProcessStepRef', 'ProcessID']));

        $steps_datas = ProcessSteps::where('ProcessID', $request->ProcessID)->orderBy('Step_Number', 'asc')->get();
        $attribute   = ProcessAttribute::where('process_id', $request->ProcessID)->get();

        $multiple = [
            'step'      => $steps_datas,
            'attribute' => $attribute,
        ];
        return response()->json($multiple)->setStatusCode(200);
    }

    public function delete_process_step($id, $proc)
    {
        $id          = $id;
        $process_id  = $proc;
        $delete_step = ProcessSteps::where('ProcessStepRef', $id)->delete();
        $steps_datas = ProcessSteps::where('ProcessID', $process_id)->orderBy('Step_Number', 'asc')->get();
        return response()->json($steps_datas)->setStatusCode(200);
    }

    public function process_approver()
    {
        $id    = \Auth()->user()->id;
        $check = ProcessApprover::where('UserID', $id)->first();

        $approves = \DB::table('tblProcessApprover')
            ->join('users', 'tblProcessApprover.UserID', '=', 'users.id')
            ->get();

        $users = \DB::table('users')
            ->select('id', \DB::raw('CONCAT("last_name", \'  \' ,"first_name") AS Fullname'))
            ->get();
        return view('processes.process_approvers', compact('users', 'approves', 'check'));
    }

    public function store_process_approvers(Request $request)
    {
        $details = new ProcessApprover($request->all());
        $details->save();
        return 'Done';
    }

    public function change_process_approvers($id)
    {
        $id              = $id;
        $update_approver = \DB::table('tblProcessApprover')->where('ProcessApproverRef', $id)->update(['Status' => 0]);
        return 'done';
    }

    public function submit_process_attribute(Request $request)
    {
        $process_attribute = new ProcessAttribute($request->all());
        $process_attribute->save();
        $get_attribute = ProcessAttribute::where('process_id', $request->process_id)->first();
        return response()->json($get_attribute)->setStatusCode(200);
    }

    public function submit_process_risk(Request $request)
    {
        $process_risk = new ProcessRiskControl($request->all());
        $process_risk->save();

        $get_risk = ProcessRiskControl::where('process_id', $request->process_id)->get();
        return response()->json($get_risk)->setStatusCode(200);
    }

    public function get_attribute_values($id)
    {
        $id            = $id;
        $get_attribute = ProcessAttribute::where('process_attribute_ref', $id)->first();
        return response()->json($get_attribute)->setStatusCode(200);

    }

    public function process_dept_index()
    {
        $id    = \Auth()->user()->id;
        $check = ProcessApprover::where('UserID', $id)->where('Status', 1)->first();
        $depts = \DB::table('tblProcessDept')
            ->join('users', 'tblProcessDept.EnteredBy', '=', 'users.id')
            ->orderBy('DeptRef', 'desc')
            ->get();
        return view('processes.process_dept', compact('check', 'depts'));
    }

    public function store_process_department(Request $request)
    {
        $date               = \Carbon::now();
        $user_id            = \Auth::user()->id;
        $process            = new ProcessDept($request->all());
        $process->EntryDate = $date;
        $process->EnteredBy = $user_id;
        $process->save();
        return 'done';

    }

    public function delete_process_dept($id)
    {
        $id    = $id;
        $trans = \DB::table('tblProcessDept')->where('DeptRef', $id)->delete();
        return 'done';
    }

    public function update_process_dept($id, $pro)
    {
        $id      = $id;
        $process = $pro;
        $trans   = \DB::table('tblProcessDept')->where('DeptRef', $id)->update(['ProcessDept' => $process]);
        return 'done';
    }

}
