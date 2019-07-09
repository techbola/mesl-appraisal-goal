<?php

namespace MESL\Http\Controllers\SupervisorAppraisal;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use MESL\AppraisalCustomer;
use MESL\Http\Controllers\Controller;

class SupervisorCustomerAppraisalController extends Controller
{

    public function appraisalStore(Request $request)
    {

        $this->validate($request, [
            'selfAssessment.*' => 'required|numeric|max:5',
        ]);

        $customerGoals = AppraisalCustomer::where('appraisal_id', $request->appraisalID)->get()->all();

        $i = 0;
        foreach ($customerGoals as $customerGoal) {
            $customerGoal->staffAppraisalComment = $request->comment[$i];
            $customerGoal->selfAssessment        = $request->selfAssessment[$i];
            $customerGoal->save();
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

        $customerGoals = AppraisalCustomer::where('appraisal_id', $request->appraisalID)->get()->all();

        $i = 0;
        foreach ($customerGoals as $customerGoal) {
            $customerGoal->staffAppraisalComment = $request->comment[$i];
            $customerGoal->selfAssessment        = $request->selfAssessment[$i];
            $customerGoal->save();
            $i++;
        }

        Session::flash('success', 'Saved, move to the next section.');

        return redirect()->route('appraisal.staffAppraisalEdit', ['appraisalID' => $request->appraisalID]);

    }

}
