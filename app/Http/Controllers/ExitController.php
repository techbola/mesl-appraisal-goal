<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use MESL\ExitInterview;
use MESL\ExitReason;
use MESL\RelocationReason;
use MESL\EmploymentReason;
use MESL\Options;
use MESL\Obligation;
use MESL\Department;
use MESL\User;
use DB;
use Auth;

class ExitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exitreasons = ExitReason::all();
        $relocation = RelocationReason::all();
        $employmentreason = EmploymentReason::all();
        $option = Options::all();
        $obligation = Obligation::all();
        $department = Department::all();
        // $hr = DB::table('role_user')->where('user_id', Auth::id())->get();
        $hr = User::whereHas('roles', function($q){
            $q->where('id', '38');
        })->get();
        return view('exit.create', compact('exitreasons', 'relocation', 'employmentreason', 'option', 'obligation', 'department', 'hr'));
    }

    public function store_exit_interview(Request $request)
    {
        $exit = new ExitInterview($request->all());

        if($exit->save()) {
            $data = [
                'status'    => 'success',
                'message'   => 'Exit Interview was created successfully!'
            ];
        }else{
            $data = [
                'status'    => 'error',
                'message'   =>  'Exit Interview was not successful!'
            ];
        }

        return redirect()->route('StoreExitInterview')->with($data['status'], $data['message']);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
