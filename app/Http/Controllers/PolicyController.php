<?php

namespace Cavidel\Http\Controllers;

use Cavidel\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function index()
    {
        $policies = Policy::all();

        return view('policies.index', compact('policies'));
    }

    public function create()
    {
        $policies = \DB::table('tblPolicy')
            ->join('users', 'tblPolicy.EnteredBy', '=', 'users.id')
            ->orderBy('PolicyRef', 'desc')
            ->get();

        return view('policies.create', compact('policies'));
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
}
