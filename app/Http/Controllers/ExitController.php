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
use MESL\ExitNotification;
use MESL\Mail\ExitInterviewResponse;
use Mail;
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
        $exits = ExitInterview::Orderby('ExitInterviewRef', 'DESC')->where('InputterID', auth()->user()->id)->where('SentResponse', 0)->get();
        $exitreasons = ExitReason::all();
        $relocation = RelocationReason::all();
        $employmentreason = EmploymentReason::all();
        $option = Options::all();
        $obligation = Obligation::all();
        $department = Department::all();
        $staff = auth()->user()->staff;
        $staff_departments = $staff->DepartmentID;
        // $hr = DB::table('role_user')->where('user_id', Auth::id())->get();
        $hr = User::whereHas('roles', function($q){
            $q->where('id', '38');
        })->get();
        return view('exit.create', compact('exitreasons', 'relocation', 'employmentreason', 'option', 'obligation', 'department', 'hr', 'exits', 'staff_departments', 'staff'));
    }

    public function store_exit_interview(Request $request)
    {
        $exit = new ExitInterview($request->all());

        $exit->InputterID = auth()->user()->id;



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

    public function edit_exit_interview($id)
    {
        $exitinterview = ExitInterview::where('ExitInterviewRef', $id)->first();
        return response()->json($exitinterview);
    }

    public function delete_exit_interview($id)
    {
        $exitinterview = ExitInterview::where("ExitInterviewRef", $id);

        $exitinterview->delete();

        return redirect()->back()->with('success',  'Deleted successfully');
    }

    public function update_exit_interview(Request $request)
    {
        $exitinterview = ExitInterview::find($request->ExitInterviewRef);

        $exitinterview->update($request->except(['_token']));

        return redirect()->back()->with('success',  'Updated successfully');
    }

    public function send_exit_interview(Request $request, $id)
    {
        $user = User::all();

        $exit = ExitInterview::where('ExitInterviewRef', $id)->where('SentResponse', '0')->first();
        if($exit){
            $exit->SentResponse = '1';
            $exit->update();

            $hr = User::whereHas('roles', function($q){
                $q->where('id', '38');
            })->get();

            Mail::to($hr)->send(new ExitInterviewResponse($exit));

            return redirect()->back()->with('success', 'Response was sent successfully');
        }else {
            return redirect()->back()->with('error', 'Response already/not sent');
        }
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
