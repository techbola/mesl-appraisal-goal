<?php

namespace MESL\Http\Controllers\Appraisal;

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
use MESL\Http\Controllers\Controller;
use MESL\Mail\SupervisorApproveAppraisal;
use MESL\Mail\SupervisorRejectAppraisal;
use MESL\Staff;
use MESL\StaffAppraisal;
use MESL\StaffBehaviouralItem;
use MESL\StaffScoreReport;

class SupervisorAppraisalController extends Controller
{

    public function staffAppraisal($appraisalID)
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

        return view('supervisor.appraisal.appraisal')->with([
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

    public function staffAppraisalApproval(Request $request, $appraisalID)
    {

        switch ($request->input('action')) {

            case 'approve':

                $this->validate($request, [
                    'f_supervisorAssessment.*' => 'required|numeric|max:5',
                    'c_supervisorAssessment.*' => 'required|numeric|max:5',
                    'i_supervisorAssessment.*' => 'required|numeric|max:5',
                    'l_supervisorAssessment.*' => 'required|numeric|max:5',
                ]);

                $appraisal = Appraisal::find($appraisalID);

                $staffID = $appraisal->staffID;

                $staff = Staff::find($staffID);

                $f_supervisorAssessments = $request->f_supervisorAssessment;
                $f_supervisorComments    = $request->f_supervisorComment;

                $c_supervisorAssessments = $request->c_supervisorAssessment;
                $c_supervisorComments    = $request->c_supervisorComment;

                $i_supervisorAssessments = $request->i_supervisorAssessment;
                $i_supervisorComments    = $request->i_supervisorComment;

                $l_supervisorAssessments = $request->l_supervisorAssessment;
                $l_supervisorComments    = $request->l_supervisorComment;

                $financeGoals  = AppraisalFinance::where('appraisal_id', $appraisalID)->get()->all();
                $customerGoals = AppraisalCustomer::where('appraisal_id', $appraisalID)->get()->all();
                $internalGoals = AppraisalInternal::where('appraisal_id', $appraisalID)->get()->all();
                $learningGoals = AppraisalLearning::where('appraisal_id', $appraisalID)->get()->all();

                $i = 0;
                foreach ($financeGoals as $financeGoal) {
                    $financeGoal->supervisorAssessment       = $f_supervisorAssessments[$i];
                    $financeGoal->supervisorAppraisalComment = $f_supervisorComments[$i];
                    $financeGoal->save();
                    $i++;
                }

                $j = 0;
                foreach ($customerGoals as $customerGoal) {
                    $customerGoal->supervisorAssessment       = $c_supervisorAssessments[$j];
                    $customerGoal->supervisorAppraisalComment = $c_supervisorComments[$j];
                    $customerGoal->save();
                    $j++;
                }

                $k = 0;
                foreach ($internalGoals as $internalGoal) {
                    $internalGoal->supervisorAssessment       = $i_supervisorAssessments[$k];
                    $internalGoal->supervisorAppraisalComment = $i_supervisorComments[$k];
                    $internalGoal->save();
                    $k++;
                }

                $l = 0;
                foreach ($learningGoals as $learningGoal) {
                    $learningGoal->supervisorAssessment       = $l_supervisorAssessments[$l];
                    $learningGoal->supervisorAppraisalComment = $l_supervisorComments[$l];
                    $learningGoal->save();
                    $l++;
                }

                $behaviouralCatIds   = [];
                $behaviouralItemsIds = [];

                foreach (json_decode($request->behaviourals) as $b) {

                    $behavioural = Behavioural::find($b);

                    $behaviouralItems = $behavioural->behaviouralItems->where('level_id', $staff->user->level_id)->all();

                    foreach ($behaviouralItems as $b_item) {

                        array_push($behaviouralCatIds, $b_item->behaviouralCat_id);
                        array_push($behaviouralItemsIds, $b_item->id);

                    }

                }

                $items = StaffBehaviouralItem::where('appraisal_id', $request->appraisalID)->get()->all();

                for ($i = 0; $i < count($items); $i++) {

                    $items[$i]->supervisorAssessment = $request->supervisorAssessment[$i];
                    $items[$i]->supervisorComment    = $request->supervisorComment[$i];

                    $items[$i]->save();

                }

                $staffAppraisals = new StaffScoreReport();

                $staffBsc = $staffAppraisals->bsc($appraisalID);

                $staffBehaviorals = $staffAppraisals->behavioural($appraisalID);

//                dd($staffBehaviorals);

                $financial = $staffBsc['staffFinancial'];
                $customer  = $staffBsc['staffCustomer'];
                $internal  = $staffBsc['staffInternal'];
                $learning  = $staffBsc['staffLearning'];

                $supervisor_financial = $staffBsc['supervisor_financial'];
                $supervisor_customer  = $staffBsc['supervisor_customer'];
                $supervisor_internal  = $staffBsc['supervisor_internal'];
                $supervisor_learning  = $staffBsc['supervisor_learning'];

                $bscStaffScore      = $staffBsc['bscStaffScore'];
                $bscSupervisorScore = $staffBsc['bscSupervisorScore'];

                $staffBehavioural      = $staffBehaviorals['staffBehavioural'];
                $supervisorBehavioural = $staffBehaviorals['supervisorBehavioural'];

                $overallStaffScore      = $bscStaffScore + $staffBehavioural;
                $overallSupervisorScore = $bscSupervisorScore + $supervisorBehavioural;

                $newStaffScoreReport = new StaffAppraisal();

                $newStaffScoreReport->staff_id                 = $staffID;
                $newStaffScoreReport->appraisal_id             = $appraisalID;
                $newStaffScoreReport->staffFinancialScore      = $financial;
                $newStaffScoreReport->staffCustomerScore       = $customer;
                $newStaffScoreReport->staffInternalScore       = $internal;
                $newStaffScoreReport->staffLearningScore       = $learning;
                $newStaffScoreReport->supervisorFinancialScore = $supervisor_financial;
                $newStaffScoreReport->supervisorCustomerScore  = $supervisor_customer;
                $newStaffScoreReport->supervisorInternalScore  = $supervisor_internal;
                $newStaffScoreReport->supervisorLearningScore  = $supervisor_learning;
                $newStaffScoreReport->bscStaffScore            = $bscStaffScore;
                $newStaffScoreReport->bscSupervisorScore       = $bscSupervisorScore;
                $newStaffScoreReport->staffBehavioural         = $staffBehavioural;
                $newStaffScoreReport->supervisorBehavioural    = $supervisorBehavioural;
                $newStaffScoreReport->overallStaffScore        = $overallStaffScore;
                $newStaffScoreReport->overallSupervisorScore   = $overallSupervisorScore;
                $newStaffScoreReport->period                   = $appraisal->period;

//                dd($newStaffScoreReport);

                $newStaffScoreReport->save();

                $staff = Staff::find($staffID);

                $staff_email = $staff->user->email;

                Mail::to($staff_email)->send(new SupervisorApproveAppraisal($staff, $appraisal));

                $appraisal->appraisalStatus = 2;

                $appraisal->save();

                Session::flash('success', 'Appraisal Approved!');

                return redirect()->route('appraisal.supervisor.index');

                break;

            case 'reject':

                $this->validate($request, [
                    'f_supervisorAssessment.*' => 'required|numeric|max:5',
                    'c_supervisorAssessment.*' => 'required|numeric|max:5',
                    'i_supervisorAssessment.*' => 'required|numeric|max:5',
                    'l_supervisorAssessment.*' => 'required|numeric|max:5',
                ]);

                $appraisal = Appraisal::find($appraisalID);

                $staffID = $appraisal->staffID;

                $staff = Staff::find($staffID);

                $f_supervisorAssessments = $request->f_supervisorAssessment;
                $f_supervisorComments    = $request->f_supervisorComment;

                $c_supervisorAssessments = $request->c_supervisorAssessment;
                $c_supervisorComments    = $request->c_supervisorComment;

                $i_supervisorAssessments = $request->i_supervisorAssessment;
                $i_supervisorComments    = $request->i_supervisorComment;

                $l_supervisorAssessments = $request->l_supervisorAssessment;
                $l_supervisorComments    = $request->l_supervisorComment;

                $financeGoals  = AppraisalFinance::where('appraisal_id', $appraisalID)->get()->all();
                $customerGoals = AppraisalCustomer::where('appraisal_id', $appraisalID)->get()->all();
                $internalGoals = AppraisalInternal::where('appraisal_id', $appraisalID)->get()->all();
                $learningGoals = AppraisalLearning::where('appraisal_id', $appraisalID)->get()->all();

                $i = 0;
                foreach ($financeGoals as $financeGoal) {
                    $financeGoal->supervisorAssessment       = $f_supervisorAssessments[$i];
                    $financeGoal->supervisorAppraisalComment = $f_supervisorComments[$i];
                    $financeGoal->save();
                    $i++;
                }

                $j = 0;
                foreach ($customerGoals as $customerGoal) {
                    $customerGoal->supervisorAssessment       = $c_supervisorAssessments[$j];
                    $customerGoal->supervisorAppraisalComment = $c_supervisorComments[$j];
                    $customerGoal->save();
                    $j++;
                }

                $k = 0;
                foreach ($internalGoals as $internalGoal) {
                    $internalGoal->supervisorAssessment       = $i_supervisorAssessments[$k];
                    $internalGoal->supervisorAppraisalComment = $i_supervisorComments[$k];
                    $internalGoal->save();
                    $k++;
                }

                $l = 0;
                foreach ($learningGoals as $learningGoal) {
                    $learningGoal->supervisorAssessment       = $l_supervisorAssessments[$l];
                    $learningGoal->supervisorAppraisalComment = $l_supervisorComments[$l];
                    $learningGoal->save();
                    $l++;
                }

                $behaviouralCatIds   = [];
                $behaviouralItemsIds = [];

                foreach (json_decode($request->behaviourals) as $b) {

                    $behavioural = Behavioural::find($b);

                    $behaviouralItems = $behavioural->behaviouralItems->where('level_id', $staff->user->level_id)->all();

                    foreach ($behaviouralItems as $b_item) {

                        array_push($behaviouralCatIds, $b_item->behaviouralCat_id);
                        array_push($behaviouralItemsIds, $b_item->id);

                    }

                }

                $items = StaffBehaviouralItem::where('appraisal_id', $request->appraisalID)->get()->all();

                for ($i = 0; $i < count($items); $i++) {

                    $items[$i]->supervisorAssessment = $request->supervisorAssessment[$i];
                    $items[$i]->supervisorComment    = $request->supervisorComment[$i];

                    $items[$i]->save();

                }

                $staff_email = $staff->user->email;

                $appraisal->appraisalStatus = 3;

                $appraisal->save();

                Mail::to($staff_email)->send(new SupervisorRejectAppraisal($staff, $appraisal));

                Session::flash('success', 'Appraisal Rejected!');

                return redirect()->route('appraisal.supervisor.index');

                break;

        }

    }

}
