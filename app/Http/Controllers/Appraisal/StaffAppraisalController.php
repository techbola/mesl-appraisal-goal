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
use MESL\StaffScoreReport;

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

        $appraisal_finances = AppraisalFinance::where('appraisal_id', $id)->where('selfAssessment', NULL)->get()->all();

        if (!empty($appraisal_finances)){

            Session::flash('error', 'Assessment not done for all financial goals... Please Confirm!!!');

            return back();

        }

        $appraisal_customers = AppraisalCustomer::where('appraisal_id', $id)->where('selfAssessment', NULL)->get()->all();

        if (!empty($appraisal_customers)){

            Session::flash('error', 'Assessment not done for all Customer/Stakeholders goals... Please Confirm!!!');

            return back();

        }

        $appraisal_internals = AppraisalInternal::where('appraisal_id', $id)->where('selfAssessment', NULL)->get()->all();

        if (!empty($appraisal_internals)){

            Session::flash('error', 'Assessment not done for all Internal Process goals... Please Confirm!!!');

            return back();

        }

        $appraisal_learnings = AppraisalLearning::where('appraisal_id', $id)->where('selfAssessment', NULL)->get()->all();

        if (!empty($appraisal_learnings)){

            Session::flash('error', 'Assessment not done for all People/Learning goals... Please Confirm!!!');

            return back();

        }

        $staffBehaviouralItems = StaffBehaviouralItem::where('appraisal_id', $id)->where('selfAssessment', NULL)->get()->all();

        if (!empty($staffBehaviouralItems)){

            Session::flash('error', 'Assessment not done for all Behavioural Items... Please Confirm!!!');

            return back();

        }

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

    public function viewScoreReport($appraisalID)
    {

        $staffAppraisals = new StaffScoreReport();

        $staffBsc = $staffAppraisals->bsc($appraisalID);

        $staffBehaviorals = $staffAppraisals->behavioural($appraisalID);

        $financial = $staffBsc['staffFinancial'];
        $customer = $staffBsc['staffCustomer'];
        $internal = $staffBsc['staffInternal'];
        $learning = $staffBsc['staffLearning'];

        $supervisor_financial = $staffBsc['supervisor_financial'];
        $supervisor_customer = $staffBsc['supervisor_customer'];
        $supervisor_internal = $staffBsc['supervisor_internal'];
        $supervisor_learning = $staffBsc['supervisor_learning'];

        $bscStaffScore = $staffBsc['bscStaffScore'];
        $bscSupervisorScore = $staffBsc['bscSupervisorScore'];

        $staffBehavioural = $staffBehaviorals['staffBehavioural'];
        $supervisorBehavioural = $staffBehaviorals['supervisorBehavioural'];

        $overallStaffScore = $bscStaffScore + $staffBehavioural;
        $overallSupervisorScore = $bscSupervisorScore + $supervisorBehavioural;

        if ($overallStaffScore <= 100 && $overallStaffScore >= 86){
            $selfPerformanceRating = 'A+';
        }
        elseif ($overallStaffScore <= 85 && $overallStaffScore >= 76){
            $selfPerformanceRating = 'A';
        }
        elseif ($overallStaffScore <= 75 && $overallStaffScore >= 61){
            $selfPerformanceRating = 'B';
        }
        elseif ($overallStaffScore <= 60 && $overallStaffScore >= 50){
            $selfPerformanceRating = 'C';
        }
        elseif ($overallStaffScore <= 49 && $overallStaffScore >= 41){
            $selfPerformanceRating = 'D';
        }
        elseif ($overallStaffScore <= 40){
            $selfPerformanceRating = 'E';
        }

        if ($overallSupervisorScore <= 100 && $overallSupervisorScore >= 86){
            $supervisorPerformanceRating = 'A+';
        }
        elseif ($overallSupervisorScore <= 85 && $overallSupervisorScore >= 76){
            $supervisorPerformanceRating = 'A';
        }
        elseif ($overallSupervisorScore <= 75 && $overallSupervisorScore >= 61){
            $supervisorPerformanceRating = 'B';
        }
        elseif ($overallSupervisorScore <= 60 && $overallSupervisorScore >= 50){
            $supervisorPerformanceRating = 'C';
        }
        elseif ($overallSupervisorScore <= 49 && $overallSupervisorScore >= 41){
            $supervisorPerformanceRating = 'D';
        }
        elseif ($overallSupervisorScore <= 40){
            $supervisorPerformanceRating = 'E';
        }

        return view('staff.appraisals.scrore_report')->with([
            'ap' => $staffBsc['ap'],
            'staffFinancial' => $financial,
            'staffCustomer' => $customer,
            'staffInternal' => $internal,
            'staffLearning' => $learning,
            'supervisor_financial' => $supervisor_financial,
            'supervisor_customer' => $supervisor_customer,
            'supervisor_internal' => $supervisor_internal,
            'supervisor_learning' => $supervisor_learning,
            'staffBehavioural' => $staffBehavioural,
            'supervisorBehavioural' => $supervisorBehavioural,
            'bscStaffScore' => $bscStaffScore,
            'bscSupervisorScore' => $bscSupervisorScore,
            'overallStaffScore' => $overallStaffScore,
            'overallSupervisorScore' => $overallSupervisorScore,
            'selfPerformanceRating' => $selfPerformanceRating,
            'supervisorPerformanceRating' => $supervisorPerformanceRating,
        ]);

    }

    public function downloadScoreReport($apID)
    {

        $ap = Appraisal::find($apID);

        $staffAppraisals = new StaffScoreReport();

        $staffBsc = $staffAppraisals->bsc($apID);

        $staffBehaviorals = $staffAppraisals->behavioural($apID);

        $financial = $staffBsc['staffFinancial'];
        $customer = $staffBsc['staffCustomer'];
        $internal = $staffBsc['staffInternal'];
        $learning = $staffBsc['staffLearning'];

        $supervisor_financial = $staffBsc['supervisor_financial'];
        $supervisor_customer = $staffBsc['supervisor_customer'];
        $supervisor_internal = $staffBsc['supervisor_internal'];
        $supervisor_learning = $staffBsc['supervisor_learning'];

        $bscStaffScore = $staffBsc['bscStaffScore'];
        $bscSupervisorScore = $staffBsc['bscSupervisorScore'];

        $staffBehavioural = $staffBehaviorals['staffBehavioural'];
        $supervisorBehavioural = $staffBehaviorals['supervisorBehavioural'];

        $overallStaffScore = $bscStaffScore + $staffBehavioural;
        $overallSupervisorScore = $bscSupervisorScore + $supervisorBehavioural;

        $data = [
            'staffName' => $ap->staff->user->getFullNameAttribute(),
            'period' => $ap->period,
            'staffFinancial' => $financial,
            'staffCustomer' => $customer,
            'staffInternal' => $internal,
            'staffLearning' => $learning,
            'supervisor_financial' => $supervisor_financial,
            'supervisor_customer' => $supervisor_customer,
            'supervisor_internal' => $supervisor_internal,
            'supervisor_learning' => $supervisor_learning,
            'staffBehavioural' => $staffBehavioural,
            'supervisorBehavioural' => $supervisorBehavioural,
            'bscStaffScore' => $bscStaffScore,
            'bscSupervisorScore' => $bscSupervisorScore,
            'overallStaffScore' => $overallStaffScore,
            'overallSupervisorScore' => $overallSupervisorScore,
        ];

//        dd($data);

        $pdf = PDF::loadView('hr.appraisals.score_report_pdf', compact('data'));
        return $pdf->download('score_report.pdf');

    }

}
