<?php

namespace MESL\Http\Controllers\SupervisorAppraisal;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use MESL\AppraisalFinance;
use MESL\Http\Controllers\Controller;

class SupervisorFinanceAppraisalController extends Controller
{

    public function appraisalStore(Request $request)
    {

        $this->validate($request, [
            'selfAssessment.*' => 'required|numeric|max:5',
        ]);

        $financeGoals = AppraisalFinance::where('appraisal_id', $request->appraisalID)->get()->all();

        $i = 0;
        foreach ($financeGoals as $financeGoal) {
            $financeGoal->staffAppraisalComment = $request->comment[$i];
            $financeGoal->selfAssessment        = $request->selfAssessment[$i];
            $financeGoal->save();
            $i++;
        }

        Session::flash('success', 'Saved, move to the next section.');

        return redirect()->route('appraisal.staffAppraisalEdit', ['appraisalID' => $request->appraisalID]);

    }

    public function appraisalUpdate(Request $request)
    {

        $this->validate($request, [
            'selfAssessment.*' => 'required|numeric|max:5',
        ]);

        $financeGoals = AppraisalFinance::where('appraisal_id', $request->appraisalID)->get()->all();

        $i = 0;
        foreach ($financeGoals as $financeGoal) {
            $financeGoal->staffAppraisalComment = $request->comment[$i];
            $financeGoal->selfAssessment        = $request->selfAssessment[$i];
            $financeGoal->save();
            $i++;
        }

        Session::flash('success', 'Saved, move to the next section.');

        return redirect()->route('appraisal.staffAppraisalEdit', ['appraisalID' => $request->appraisalID]);

    }

}
