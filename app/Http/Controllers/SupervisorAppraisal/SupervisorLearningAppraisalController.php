<?php

namespace MESL\Http\Controllers\SupervisorAppraisal;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use MESL\AppraisalLearning;
use MESL\Http\Controllers\Controller;

class SupervisorLearningAppraisalController extends Controller
{

    public function appraisalStore(Request $request)
    {

        $this->validate($request, [
            'selfAssessment.*' => 'required|numeric|max:5',
        ]);

        $learningGoals = AppraisalLearning::where('appraisal_id', $request->appraisalID)->get()->all();

        $i = 0;
        foreach ($learningGoals as $learningGoal) {
            $learningGoal->staffAppraisalComment = $request->comment[$i];
            $learningGoal->selfAssessment        = $request->selfAssessment[$i];
            $learningGoal->save();
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

        $learningGoals = AppraisalLearning::where('appraisal_id', $request->appraisalID)->get()->all();

        $i = 0;
        foreach ($learningGoals as $learningGoal) {
            $learningGoal->staffAppraisalComment = $request->comment[$i];
            $learningGoal->selfAssessment        = $request->selfAssessment[$i];
            $learningGoal->save();
            $i++;
        }

        Session::flash('success', 'Submitted, move to the next section.');

        return redirect()->route('appraisal.staffAppraisalEdit', ['appraisalID' => $request->appraisalID]);

    }

}
