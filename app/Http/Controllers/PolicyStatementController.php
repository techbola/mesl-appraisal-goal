<?php

namespace Cavidel\Http\Controllers;

use Cavidel\Policy;
use Cavidel\PolicySegment;
use Cavidel\PolicyStatement;
use Illuminate\Http\Request;

class PolicyStatementController extends Controller
{
    public function create()
    {
        $policies = Policy::all();
        $segments = \DB::table('tblPolicyStatement')
            ->join('users', 'tblPolicyStatement.EnteredBy', '=', 'users.id')
            ->join('tblPolicy', 'tblPolicyStatement.PolicyID', '=', 'tblPolicy.PolicyRef')
            ->join('tblPolicySegment', 'tblPolicyStatement.SegmentID', '=', 'tblPolicySegment.SegmentRef')
            ->orderBy('StatementRef', 'desc')
            ->get();
        return view('policystatements.create', compact('policies', 'segments'));
    }

    public function Post_Policy_statement(Request $request)
    {
        $date                = \Carbon::now();
        $user_id             = \Auth::user()->id;
        $policies            = new PolicyStatement($request->all());
        $policies->EntryDate = $date;
        $policies->EnteredBy = $user_id;
        $policies->save();
        return 'done';

    }

    public function get_newSegment($policy)
    {
        $policy_id = $policy;
        $segments  = PolicySegment::where('PolicyID', $policy_id)->get();
        return response()->json($segments)->setStatusCode(200);
    }

    public function statement_result($policy, $segment)
    {
        $policy  = $policy;
        $segment = $segment;

        $statement = \DB::table('tblPolicyStatement')
            ->select('Policy', 'Segment', 'Statement', 'first_name', 'last_name', 'tblPolicyStatement.EntryDate')
            ->join('tblPolicy', 'tblPolicyStatement.PolicyID', '=', 'tblPolicy.PolicyRef')
            ->join('tblPolicySegment', 'tblPolicyStatement.segmentID', '=', 'tblPolicySegment.SegmentRef')
            ->join('users', 'tblPolicyStatement.EnteredBy', '=', 'users.id')
            ->where('tblPolicyStatement.PolicyID', $policy)
            ->where('SegmentID', $segment)
            ->first();
        return response()->json($statement)->setStatusCode(200);
    }

    public function delete_policy_statement($id)
    {
        $id    = $id;
        $trans = \DB::table('tblPolicyStatement')->where('StatementRef', $id)->delete();
        return 'done';
    }

    public function get_statement_record($id)
    {
        $id      = $id;
        $details = PolicyStatement::where('StatementRef', $id)->first();
        return response()->json($details)->setStatusCode(200);
    }

    public function Update_Policy_statement(Request $request, $id)
    {
        $id            = $id;
        $update_policy = PolicyStatement::find($id);
        $update_policy->update($request->all());
        return 'done';

    }
}
