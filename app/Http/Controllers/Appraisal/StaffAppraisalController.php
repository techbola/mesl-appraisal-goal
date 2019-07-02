<?php

namespace MESL\Http\Controllers\Appraisal;

use MESL\Appraisal;
use MESL\AppraisalComment;
use MESL\AppraisalCustomer;
use MESL\AppraisalFinance;
use MESL\AppraisalInternal;
use MESL\AppraisalLearning;
use MESL\AppraisalSignature;
use MESL\Behavioural;
use MESL\Mail\StaffSendAppraisal;
use MESL\Mail\StaffSubmitAppraisal;
use MESL\Staff;
use MESL\StaffBehaviouralItem;
use Illuminate\Http\Request;
use MESL\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class StaffAppraisalController extends Controller
{

    public function staffAppraisalCreate($appraisalID)
    {

        $ap = Appraisal::find($appraisalID);
        $ap->startAppraisalFlag = 1;
        $ap->save();

        $appraisal_finances = AppraisalFinance::where('staffID', auth()->user()->staff->StaffRef)
            ->where('appraisal_id', $appraisalID)->get();
        $appraisal_customers = AppraisalCustomer::where('staffID', auth()->user()->staff->StaffRef)->where('appraisal_id', $appraisalID)->get();
        $appraisal_internals = AppraisalInternal::where('staffID', auth()->user()->staff->StaffRef)->where('appraisal_id', $appraisalID)->get();
        $appraisal_learnings = AppraisalLearning::where('staffID', auth()->user()->staff->StaffRef)->where('appraisal_id', $appraisalID)->get();

        $comments = AppraisalComment::where('staffID', auth()->user()->staff->StaffRef)->first();
        $signatures = AppraisalSignature::where('staffID', auth()->user()->staff->StaffRef)->first();

        $behavioural = new Behavioural();
        $behaviourals = $behavioural->getUserBehaviourals();

        return view('staff.appraisals.new_appraisal.staff')->with([
            'appraisalID' => $appraisalID,
            'appraisal_finances' => $appraisal_finances,
            'appraisal_customers' => $appraisal_customers,
            'appraisal_internals' => $appraisal_internals,
            'appraisal_learnings' => $appraisal_learnings,
            'comments' => $comments,
            'signatures' => $signatures,
            'behaviourals' => $behaviourals,
        ]);


    }

    public function staffAppraisalSubmitSupervisor($id)
    {

        $appraisal = Appraisal::find($id);

        $supervisorID = $appraisal->supervisorID;

        $supervisor = Staff::find($supervisorID);
        $supervisor_email = $supervisor->user->email;

        Mail::to($supervisor_email)->send(new StaffSubmitAppraisal());

        $appraisal->appraisalStatus = 1;

        $appraisal->save();

        Session::flash('success', 'Appraisal Submitted!');

        return back();

    }

    public function viewAppraisal($id)
    {

        $appraisal_finances = AppraisalFinance::where('appraisal_id', $id)->get();
        $appraisal_customers = AppraisalCustomer::where('appraisal_id', $id)->get();
        $appraisal_internals = AppraisalInternal::where('appraisal_id', $id)->get();
        $appraisal_learnings = AppraisalLearning::where('appraisal_id', $id)->get();

        $comments = AppraisalComment::where('appraisal_id', $id)->first();
        $signatures = AppraisalSignature::where('appraisal_id', $id)->first();

        $behavioural = new Behavioural();
        $behaviourals = $behavioural->getUserBehaviourals();
        $staffBehaviouralItems = StaffBehaviouralItem::where('appraisal_id', $id);

        return view('staff.appraisals.view_appraisal.staff')->with([
            'appraisalID' => $id,
            'appraisal_finances' => $appraisal_finances,
            'appraisal_customers' => $appraisal_customers,
            'appraisal_internals' => $appraisal_internals,
            'appraisal_learnings' => $appraisal_learnings,
            'comments' => $comments,
            'signatures' => $signatures,
            'behaviourals' => $behaviourals,
            'staffBehaviouralItems' => $staffBehaviouralItems,
        ]);

    }

    public function staffAppraisalEdit($appraisalID)
    {

        $appraisal_finances = AppraisalFinance::where('staffID', auth()->user()->staff->StaffRef)
            ->where('appraisal_id', $appraisalID)->get();
        $appraisal_customers = AppraisalCustomer::where('staffID', auth()->user()->staff->StaffRef)->where('appraisal_id', $appraisalID)->get();
        $appraisal_internals = AppraisalInternal::where('staffID', auth()->user()->staff->StaffRef)->where('appraisal_id', $appraisalID)->get();
        $appraisal_learnings = AppraisalLearning::where('staffID', auth()->user()->staff->StaffRef)->where('appraisal_id', $appraisalID)->get();

        $comments = AppraisalComment::where('staffID', auth()->user()->staff->StaffRef)->first();
        $signatures = AppraisalSignature::where('staffID', auth()->user()->staff->StaffRef)->first();

        $behavioural = new Behavioural();
        $behaviourals = $behavioural->getUserBehaviourals();

        return view('staff.appraisals.edit_appraisal.staff')->with([
            'appraisalID' => $appraisalID,
            'appraisal_finances' => $appraisal_finances,
            'appraisal_customers' => $appraisal_customers,
            'appraisal_internals' => $appraisal_internals,
            'appraisal_learnings' => $appraisal_learnings,
            'comments' => $comments,
            'signatures' => $signatures,
            'behaviourals' => $behaviourals,
        ]);


    }

}
