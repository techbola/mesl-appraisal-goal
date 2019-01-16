<?php

namespace MESL\Http\Controllers;

use MESL\Policy;
use MESL\PolicySegment;
use MESL\PolicyApprover;
use Illuminate\Http\Request;

class PolicySegmentController extends Controller
{

    public function create()
    {
        $id       = \Auth()->user()->id;
        $check    = count(PolicyApprover::where('UserID', $id)->get()) > 0 ? PolicyApprover::where('UserID', $id)->get() : [];
        $policies = Policy::orderBy('Policy', 'asc')->get();
        $segments = \DB::table('tblPolicySegment')
            ->join('users', 'tblPolicySegment.EnteredBy', '=', 'users.id')
            ->join('tblPolicy', 'tblPolicySegment.PolicyID', '=', 'tblPolicy.PolicyRef')
            ->orderBy('SegmentRef', 'desc')
            ->get();
        return view('policysegments.create', compact('policies', 'segments', 'check'));
    }

    public function store_policy(Request $request)
    {
        $date                = \Carbon::now();
        $user_id             = \Auth::user()->id;
        $policies            = new PolicySegment($request->all());
        $policies->EntryDate = $date;
        $policies->EnteredBy = $user_id;
        $policies->save();
        return 'done';

    }

    public function delete_policy_segment($id)
    {
        $id    = $id;
        $trans = \DB::table('tblPolicySegment')->where('SegmentRef', $id)->delete();
        return 'done';
    }

    public function update_policy_segment($id, $segment)
    {
        $id    = $id;
        $seg   = $segment;
        $trans = \DB::table('tblpolicySegment')->where('SegmentRef', $id)->update(['Segment' => $seg]);
        return 'done';
    }

}
