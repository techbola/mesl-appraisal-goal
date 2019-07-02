<?php

namespace MESL\Http\Controllers\Appraisal;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use MESL\AppraisalInternal;
use MESL\Http\Controllers\Controller;

class StaffInternalAppraisalController extends Controller
{

    public function appraisalStore(Request $request)
    {

        $this->validate($request, [
            'selfAssessment.*' => 'required|numeric|max:5',
        ]);

        $internalGoals = AppraisalInternal::where('appraisal_id', $request->appraisalID)->get()->all();

        $i = 0;
        foreach ($internalGoals as $internalGoal) {
            $internalGoal->staffAppraisalComment = $request->comment[$i];
            $internalGoal->selfAssessment        = $request->selfAssessment[$i];
            $internalGoal->save();
            $i++;
        }

        Session::flash('success', 'Submitted, move to the next section.');

        return redirect()->route('appraisal.staffAppraisalEdit', ['appraisalID' => $request->appraisalID]);

    }

    public function appraisalUpdate(Request $request)
    {

        $this->validate($request, [
            'selfAssessment.*' => 'required|numeric|max:5',
        ]);

        $internalGoals = AppraisalInternal::where('appraisal_id', $request->appraisalID)->get()->all();

        $i = 0;
        foreach ($internalGoals as $internalGoal) {
            $internalGoal->staffAppraisalComment = $request->comment[$i];
            $internalGoal->selfAssessment        = $request->selfAssessment[$i];
            $internalGoal->save();
            $i++;
        }

        Session::flash('success', 'Submitted, move to the next section.');

        return redirect()->route('appraisal.staffAppraisalEdit', ['appraisalID' => $request->appraisalID]);

    }

}
