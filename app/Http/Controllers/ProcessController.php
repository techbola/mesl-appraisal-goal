<?php

namespace Cavidel\Http\Controllers;

use Cavidel\Process;
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
        $processes = \DB::table('tblProcess')
            ->join('users', 'tblProcess.EnteredBy', '=', 'users.id')
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
        $trans = \DB::table('tblProcess')->where('processRef', $id)->delete();
        return 'done';
    }

    public function update_process($id, $pro)
    {
        $id      = $id;
        $process = $pro;
        $trans   = \DB::table('tblProcess')->where('processRef', $id)->update(['process' => $process]);
        return 'done';
    }

    //     public function policy_segments($policy_id)
    //     {
    //         $id       = $policy_id;
    //         $segments = PolicySegment::where('PolicyID', $id)->get();
    //         return response()->json($segments)->setStatusCode(200);
    //     }

    //     public function policy_approver()
    //     {
    //         $id    = \Auth()->user()->id;
    //         $check = PolicyApprover::where('UserID', $id)->first();

    //         $approves = \DB::table('tblPolicyApprover')
    //             ->join('users', 'tblPolicyApprover.UserID', '=', 'users.id')
    //             ->get();

    //         $users = \DB::table('users')
    //             ->select('id', \DB::raw('CONCAT("last_name", \'  \' ,"first_name") AS Fullname'))
    //             ->get();
    //         return view('policies.policy_approver', compact('users', 'approves', 'check'));
    //     }

    //     public function store_policy_approvers(Request $request)
    //     {
    //         $details = new PolicyApprover($request->all());
    //         $details->save();
    //         return 'Done';
    //     }

    //     public function change_policy_approvers($id)
    //     {
    //         $id              = $id;
    //         $update_approver = \DB::table('tblPolicyApprover')->where('PolicyApproverRef', $id)->update(['Status' => 0]);
    //         return 'done';
    //     }
    // }

}
