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
use MESL\BehaviouralItem;
use MESL\Staff;
use MESL\StaffAppraisal;
use MESL\StaffScoreReport;
use Illuminate\Http\Request;
use MESL\Http\Controllers\Controller;
use PDF;

class HrAppraisalController extends Controller
{

    public function hrStaffAppraisals()
    {

        $appraisals = Appraisal::where('hrID', auth()->user()->staff->StaffRef)
            ->where('appraisalStatus', 2)
            ->get()->all();

        return view('hr.appraisals.index')->with([
            'appraisals' => $appraisals,
        ]);

    }

    public function viewAppraisal($appraisalID)
    {

        $ap = Appraisal::find($appraisalID);

        $appraisal_finances = AppraisalFinance::where('appraisal_id', $appraisalID)->get();
        $appraisal_customers = AppraisalCustomer::where('appraisal_id', $appraisalID)->get();
        $appraisal_internals = AppraisalInternal::where('appraisal_id', $appraisalID)->get();
        $appraisal_learnings = AppraisalLearning::where('appraisal_id', $appraisalID)->get();

        $comments = AppraisalComment::where('appraisal_id', $appraisalID)->first();
        $signatures = AppraisalSignature::where('appraisal_id', $appraisalID)->first();

        $appraisal = Appraisal::find($appraisalID);
        $staffName = $appraisal->employee_name;

        $staff = Staff::find($appraisal->staffID);

        $staffBehaviouralCats = [];

        $staff_behavioural_items_catids = BehaviouralItem::where('PositionID', $staff->position->PositionRef)->pluck('behaviouralCat_id')->all();

        foreach ($staff_behavioural_items_catids as $staff_behavioural_items_catid){
            array_push($staffBehaviouralCats, (int) $staff_behavioural_items_catid);
        }

        $behaviourals = Behavioural::pluck('id')->all();

        $behaviourals2 = array_intersect ($behaviourals, $staffBehaviouralCats);

        $behaviourals3 = Behavioural::whereIn('id', $behaviourals2)->get();

        return view('hr.appraisals.appraisal')->with([
            'appraisal_finances' => $appraisal_finances,
            'appraisal_customers' => $appraisal_customers,
            'appraisal_internals' => $appraisal_internals,
            'appraisal_learnings' => $appraisal_learnings,
            'comments' => $comments,
            'signatures' => $signatures,
            'appraisalID' => $appraisalID,
            'staffName' => $staffName,
            'behaviourals' => $behaviourals3,
            'staffPositionID' => $staff->position->PositionRef,
            'ap' => $ap,
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

        return view('hr.appraisals.scrore_report')->with([
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

    public function allStaffIndexAppraisals()
    {

        return view('hr.appraisals.all_staffs_index');

    }

    public function allStaffAppraisals(Request $request)
    {

        $period = $request->appraiser_period;

        $appraisals = StaffAppraisal::where('period', $period)->get()->all();

//        dd($appraisals);

        return view('hr.appraisals.all_staff')->with([
            'appraisals' => $appraisals,
            'period' => $period,
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
