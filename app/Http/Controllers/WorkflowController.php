<?php

namespace Cavi\Http\Controllers;

use Validator;
use Cavi\User;
use Cavi\Workflow;
use Illuminate\Http\Request;

class WorkflowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $workflowdata = Workflow::all();
        $staff        = User::all();
        $staff        = $staff->transform(function ($item, $key) {
            $item->name = $item->Fullname;
            return $item;
        });
        return view('workflow.create', compact('staff', 'workflowdata'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $workflow = new Workflow($request->all());
        $this->validate($request, [
            'RequesterID' => 'required',
            'ApproverID1' => 'required',
        ]);

        if ($workflow->save()) {
            return redirect()->route('workflow.create')->with('success', 'Workflow updated successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staff = User::all();
        $staff = $staff->transform(function ($item, $key) {
            $item->name = $item->Fullname;
            return $item;
        });
        $workflow = Workflow::find($id);
        return view('workflow.edit', compact('workflow', 'staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $workflow = Workflow::find($id);
        if ($workflow->update($request->all())) {
            return redirect()->route('workflow.create')->with('success', 'Workflow has been updated successfully');
        } else {
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
