<?php

namespace Cavidel\Http\Controllers;

use Cavidel\Process;
use Cavidel\ProcessSteps;
use Cavidel\User;
use Illuminate\Http\Request;

class ProcessController extends Controller
{

    public function index()
    {
        $id        = \Auth()->user()->id;
        $processes = Process::all();
        return view('processes.index', compact('processes'));
    }

    public function create()
    {
        $id = \Auth()->user()->id;
        // $check    = PolicyApprover::where('UserID', $id)->first();
        $processes = \DB::table('tblProcesses')
            ->join('users', 'tblProcesses.EnteredBy', '=', 'users.id')
            ->orderBy('processRef', 'desc')
            ->get();

        return view('processes.create', compact('processes'));
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
        $processes = Process::all();
        return view('processes.create_process_steps', compact('processes'));
    }

    public function get_process_steps($id)
    {
        $id          = $id;
        $steps_datas = ProcessSteps::where('ProcessID', $id)->orderBy('Step_Number', 'asc')->get();
        return response()->json($steps_datas)->setStatusCode(200);
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
        return response()->json($steps_datas)->setStatusCode(200);
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
        return response()->json($steps_datas)->setStatusCode(200);

    }

}
