<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use MESL\Appraisal;
use MESL\AppraisalComment;
use MESL\AppraisalCustomer;
use MESL\AppraisalFinance;
use MESL\AppraisalInternal;
use MESL\AppraisalLearning;
use MESL\AppraisalSignature;
use MESL\Behavioural;
use MESL\BehaviouralItem;
use MESL\Mail\ApproveStaffGoals;
use MESL\Mail\RejectStaffGoals;
use MESL\Mail\SendGoalsToHr;
use MESL\Role;
use MESL\Staff;
use MESL\User;

class SupervisorController extends Controller
{

    public function index()
    {

        $appraisals = Appraisal::where('supervisorID', auth()->user()->staff->StaffRef)
            ->where('sentFlag', true)
            ->get()->all();

        return view('supervisor.goals.index')->with([
            'appraisals' => $appraisals,
        ]);

    }

    public function appraisal($appraisalID)
    {

        $ap = Appraisal::find($appraisalID);

        $appraisal_finances  = AppraisalFinance::where('appraisal_id', $appraisalID)->get();
        $appraisal_customers = AppraisalCustomer::where('appraisal_id', $appraisalID)->get();
        $appraisal_internals = AppraisalInternal::where('appraisal_id', $appraisalID)->get();
        $appraisal_learnings = AppraisalLearning::where('appraisal_id', $appraisalID)->get();

        $comments   = AppraisalComment::where('appraisal_id', $appraisalID)->first();
        $signatures = AppraisalSignature::where('appraisal_id', $appraisalID)->first();

        $appraisal = Appraisal::find($appraisalID);
        $staffName = $appraisal->employee_name;

        $staff = Staff::find($appraisal->staffID);

        $staffBehaviouralCats = [];

        $staff_behavioural_items_catids = BehaviouralItem::where('level_id', $staff->user->level_id)->pluck('behaviouralCat_id')->all();

        foreach ($staff_behavioural_items_catids as $staff_behavioural_items_catid) {
            array_push($staffBehaviouralCats, (int) $staff_behavioural_items_catid);
        }

        $behaviourals = Behavioural::pluck('id')->all();

        $behaviourals2 = array_intersect($behaviourals, $staffBehaviouralCats);

        $behaviourals3 = Behavioural::whereIn('id', $behaviourals2)->get();

        return view('supervisor.goals.appraisal')->with([
            'appraisal_finances'  => $appraisal_finances,
            'appraisal_customers' => $appraisal_customers,
            'appraisal_internals' => $appraisal_internals,
            'appraisal_learnings' => $appraisal_learnings,
            'comments'            => $comments,
            'signatures'          => $signatures,
            'appraisalID'         => $appraisalID,
            'staffName'           => $staffName,
            'behaviourals'        => $behaviourals3,
            'staffLevelID'        => $staff->user->level_id,
            'ap'                  => $ap,
        ]);

    }

    public function goalsApproval(Request $request, $appraisalID)
    {

        switch ($request->input('action')) {

            case 'approve':

                $appraisal = Appraisal::find($appraisalID);

                $staffID = $appraisal->staffID;

                $staff       = Staff::find($staffID);
                $staff_email = $staff->user->email;

//                if (!empty($request->comment)){
                //
                //                    $comment = $request->comment;
                //
                //                    Mail::to($staff_email)->send(new ApproveStaffGoals($staff, $appraisal));
                //
                //                    $appraisal->supervisorComment = $comment;
                //                    $appraisal->status = 2;
                //
                //                    $appraisal->save();
                //
                //                }
                //                else{

                Mail::to($staff_email)->send(new ApproveStaffGoals($staff, $appraisal));

                $appraisal->status = 2;

                $appraisal->save();

//                }

                Session::flash('success', 'Goals Approved!');

                return redirect()->route('appraisal.supervisor.index');

                break;

            case 'reject':

                $financialComments = $request->financial_comment;
                $customerComments  = $request->customer_comment;
                $internalComments  = $request->internal_comment;
                $learningComments  = $request->learning_comment;

                $financeGoals  = AppraisalFinance::where('appraisal_id', $appraisalID)->get()->all();
                $customerGoals = AppraisalCustomer::where('appraisal_id', $appraisalID)->get()->all();
                $internalGoals = AppraisalInternal::where('appraisal_id', $appraisalID)->get()->all();
                $learningGoals = AppraisalLearning::where('appraisal_id', $appraisalID)->get()->all();

                $i = 0;
                foreach ($financeGoals as $financeGoal) {
                    $financeGoal->justification = $financialComments[$i];
                    $financeGoal->save();
                    $i++;
                }

                $j = 0;
                foreach ($customerGoals as $customerGoal) {
                    $customerGoal->justification = $customerComments[$j];
                    $customerGoal->save();
                    $j++;
                }

                $k = 0;
                foreach ($internalGoals as $internalGoal) {
                    $internalGoal->justification = $internalComments[$k];
                    $internalGoal->save();
                    $k++;
                }

                $l = 0;
                foreach ($learningGoals as $learningGoal) {
                    $learningGoal->justification = $learningComments[$l];
                    $learningGoal->save();
                    $l++;
                }

                $appraisal = Appraisal::find($appraisalID);

                $staffID = $appraisal->staffID;

                $staff       = Staff::find($staffID);
                $staff_email = $staff->user->email;

                $comment = $request->comment;

                Mail::to($staff_email)->send(new RejectStaffGoals($staff, $appraisal));

                $appraisal->sentFlag = false;
                $appraisal->status   = 3;

                $appraisal->save();

                Session::flash('success', 'Goals Rejected!');

                return redirect()->route('appraisal.supervisor.index');

                break;

        }

    }

    public function submitToHr($appraisalID)
    {

        $users = Role::where('name', 'HR Supervisor')->first()->users()->get()->all();

        $hr = $users[0];

//        dd($hr->staff->StaffRef);

        $appraisal = Appraisal::find($appraisalID);

        $staffID = $appraisal->staffID;

        $staff = Staff::find($staffID);

        Mail::to($hr->email)->send(new SendGoalsToHr($staff));

        $appraisal->status = 4;
        $appraisal->hrID   = $hr->staff->StaffRef;

        $appraisal->save();

        Session::flash('success', 'Goals Sent to HR!');

        return redirect()->route('appraisal.supervisor.index');

    }

}
