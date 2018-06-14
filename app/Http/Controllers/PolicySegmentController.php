<?php

namespace Cavidel\Http\Controllers;

use Cavidel\Policy;
use Cavidel\PolicySegment;
use Illuminate\Http\Request;

class PolicySegmentController extends Controller
{

    public function create()
    {
        $policies = Policy::all();
        $segments = \DB::table('tblPolicySegment')
            ->join('users', 'tblPolicySegment.EnteredBy', '=', 'users.id')
            ->join('tblPolicy', 'tblPolicySegment.PolicyID', '=', 'tblPolicy.PolicyRef')
            ->orderBy('SegmentRef', 'desc')
            ->get();
        return view('policysegments.create', compact('policies', 'segments'));
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

    public function update_policy_segment($id, $segment, $policy)
    {
        $id        = $id;
        $policy_id = $policy;
        $seg       = $segment;
        $trans     = \DB::table('tblpolicySegment')->where('SegmentRef', $id)->update(['PolicyID' => $policy_id, 'Segment' => $seg]);
        return 'done';
    }

}
