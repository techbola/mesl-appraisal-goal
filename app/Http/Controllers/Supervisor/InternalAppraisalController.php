<?php

namespace MESL\Http\Controllers\Supervisor;

use Illuminate\Http\Request;
use MESL\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use MESL\AppraisalInternal;
use MESL\Staff;

class InternalAppraisalController extends Controller
{

    public function bscInternalStore(Request $request)
    {

        $this->validate($request, [

            'internal_process_objective.*'  => 'required|string',
            'internal_process_kpi.*'        => 'required|string',
            'internal_process_target.*'     => 'required|string',
            'internal_process_constraint.*' => 'required|string',

        ]);

        $staff = Staff::where('UserID', auth()->user()->id)->first();

        for ($i = 0; $i < count($request->internal_process_objective); $i++) {

            $appraisal               = new AppraisalInternal;
            $appraisal->objective    = $request->internal_process_objective[$i];
            $appraisal->kpi          = $request->internal_process_kpi[$i];
            $appraisal->target       = $request->internal_process_target[$i];
            $appraisal->constraint   = $request->internal_process_constraint[$i];
            $appraisal->supervisorID = $staff->SupervisorID;
            $appraisal->staffID      = $staff->StaffRef;
            $appraisal->appraisal_id = $request->appraisalID;
            $appraisal->save();

        }

        Session::flash('success', 'Submitted, move to the next section.');

        return redirect()->route('appraisal.supervisorDashboard', ['appraisalID' => $request->appraisalID]);

    }

    public function updateInternalAppraisal(Request $request)
    {

        $this->validate($request, [

            'internal_process_objective.*'  => 'required|string',
            'internal_process_kpi.*'        => 'required|string',
            'internal_process_target.*'     => 'required|string',
            'internal_process_constraint.*' => 'required|string',

        ]);

        $appraisal = AppraisalInternal::find($request->internalAppraisalID);

        $appraisal->objective  = $request->internal_process_objective;
        $appraisal->kpi        = $request->internal_process_kpi;
        $appraisal->target     = $request->internal_process_target;
        $appraisal->constraint = $request->internal_process_constraint;

        $appraisal->save();

        Session::flash('success', 'Appraisal Updated!');

        return back();

    }

    public function deleteAppraisals(Request $request)
    {

        $allAppraisalIDs = $request->appraisalIDs;

        $allAppraisalIDs = explode(',', $allAppraisalIDs);

        foreach ($allAppraisalIDs as $allAppraisalID) {

            $appraisal = AppraisalInternal::find($allAppraisalID);

            $appraisal->delete();

        }

        Session::flash('success', 'Appraisal Deleted.');

        return back();

    }

}
