<?php

namespace MESL\Http\Controllers\Supervisor;

use Illuminate\Http\Request;
use MESL\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use MESL\AppraisalFinance;
use MESL\Staff;

class FinanceAppraisalController extends Controller
{

    public function bscFinancialStore(Request $request)
    {

        $this->validate($request, [
            'financial_objective.*'  => 'required|string',
            'financial_kpi.*'        => 'required|string',
            'financial_target.*'     => 'required|string',
            'financial_constraint.*' => 'required|string',
        ]);

//        dd($request->all());

        $staff = Staff::where('UserID', auth()->user()->id)->first();

        for ($i = 0; $i < count($request->financial_objective); $i++) {

            $appraisal               = new AppraisalFinance;
            $appraisal->objective    = $request->financial_objective[$i];
            $appraisal->kpi          = $request->financial_kpi[$i];
            $appraisal->target       = $request->financial_target[$i];
            $appraisal->constraint   = $request->financial_constraint[$i];
            $appraisal->supervisorID = $staff->SupervisorID;
            $appraisal->staffID      = $staff->StaffRef;
            $appraisal->appraisal_id = $request->appraisalID;
            $appraisal->save();

        }

        Session::flash('success', 'Submitted, move to the next section.');

        return redirect()->route('appraisal.supervisorDashboard', ['appraisalID' => $request->appraisalID]);

    }

    public function updateFinanceAppraisal(Request $request)
    {

        $this->validate($request, [
            'financial_objective'  => 'required|string',
            'financial_kpi'        => 'required|string',
            'financial_target'     => 'required|string',
            'financial_constraint' => 'required|string',
        ]);

        $appraisal = AppraisalFinance::find($request->financeAppraisalID);

        $appraisal->objective  = $request->financial_objective;
        $appraisal->kpi        = $request->financial_kpi;
        $appraisal->target     = $request->financial_target;
        $appraisal->constraint = $request->financial_constraint;

        $appraisal->save();

        Session::flash('success', 'Appraisal Updated!.');

        return back();

    }

    public function deleteAppraisals(Request $request)
    {

        $allAppraisalIDs = $request->appraisalIDs;

        $allAppraisalIDs = explode(',', $allAppraisalIDs);

        foreach ($allAppraisalIDs as $allAppraisalID) {

            $appraisal = AppraisalFinance::find($allAppraisalID);

            $appraisal->delete();

        }

        Session::flash('success', 'Appraisal Deleted.');

        return back();

    }

}
