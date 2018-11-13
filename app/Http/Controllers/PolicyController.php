<?php

namespace Cavi\Http\Controllers;

use Cavi\Policy;
use Cavi\PolicySegment;
use Cavi\PolicyApprover;
use Cavi\User;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function index()
    {
        $id       = \Auth()->user()->id;
        $check    = PolicyApprover::where('UserID', $id)->first();
        $policies = Policy::orderBy('Policy', 'asc')->get();
        return view('policies.index', compact('policies', 'check'));
    }

    public function create()
    {
        $id       = \Auth()->user()->id;
        $check    = PolicyApprover::where('UserID', $id)->first();
        $policies = \DB::table('tblPolicy')
            ->join('users', 'tblPolicy.EnteredBy', '=', 'users.id')
            ->orderBy('PolicyRef', 'desc')
            ->get();

        return view('policies.create', compact('policies', 'check'));
    }

    public function store_policy(Request $request)
    {
        $date                = \Carbon::now();
        $user_id             = \Auth::user()->id;
        $policies            = new policy($request->all());
        $policies->EntryDate = $date;
        $policies->EnteredBy = $user_id;
        $policies->save();
        return 'done';

    }

    public function delete_policy($id)
    {
        $id    = $id;
        $trans = \DB::table('tblpolicy')->where('PolicyRef', $id)->delete();
        return 'done';
    }

    public function update_policy($id, $policy)
    {
        $id     = $id;
        $policy = $policy;
        $trans  = \DB::table('tblpolicy')->where('PolicyRef', $id)->update(['Policy' => $policy]);
        return 'done';
    }

    public function policy_segments($policy_id)
    {
        $id       = $policy_id;
        $segments = PolicySegment::where('PolicyID', $id)->get();
        return response()->json($segments)->setStatusCode(200);
    }

    public function policy_approver()
    {
        $id    = \Auth()->user()->id;
        $check = PolicyApprover::where('UserID', $id)->first();

        $approves = \DB::table('tblPolicyApprover')
            ->join('users', 'tblPolicyApprover.UserID', '=', 'users.id')
            ->get();

        $users = \DB::table('users')
            ->select('id', \DB::raw('CONCAT("last_name", \'  \' ,"first_name") AS Fullname'))
            ->get();
        return view('policies.policy_approver', compact('users', 'approves', 'check'));
    }

    public function store_policy_approvers(Request $request)
    {
        $details = new PolicyApprover($request->all());
        $details->save();
        return 'Done';
    }

    public function change_policy_approvers($id)
    {
        $id              = $id;
        $update_approver = \DB::table('tblPolicyApprover')->where('PolicyApproverRef', $id)->update(['Status' => 0]);
        return 'done';
    }
}
