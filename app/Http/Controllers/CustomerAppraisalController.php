<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use MESL\AppraisalCustomer;
use MESL\Staff;

class CustomerAppraisalController extends Controller
{

    public function bscCustomerStore(Request $request)
    {

        if (!auth()->user()->staff->SupervisorFlag) {

            $this->validate($request, [

                'stakeholders_objective.*'  => 'required|string',
                'stakeholders_kpi.*'        => 'required|string',
                'stakeholders_target.*'     => 'required|string',
                'stakeholders_constraint.*' => 'required|string',

            ]);

            $staff = Staff::where('UserID', auth()->user()->id)->first();

            for ($i = 0; $i < count($request->stakeholders_objective); $i++) {

                $appraisal               = new AppraisalCustomer;
                $appraisal->objective    = $request->stakeholders_objective[$i];
                $appraisal->kpi          = $request->stakeholders_kpi[$i];
                $appraisal->target       = $request->stakeholders_target[$i];
                $appraisal->constraint   = $request->stakeholders_constraint[$i];
                $appraisal->supervisorID = $staff->SupervisorID;
                $appraisal->staffID      = $staff->StaffRef;
                $appraisal->appraisal_id = $request->appraisalID;
                $appraisal->save();

            }

            Session::flash('success', 'Submitted, move to the next section.');

            return redirect()->route('appraisal.dashboard', ['appraisalID' => $request->appraisalID]);

        }

    }

    public function updateCustomerAppraisal(Request $request)
    {

        $this->validate($request, [

            'stakeholders_objective'  => 'required|string',
            'stakeholders_kpi'        => 'required|string',
            'stakeholders_target'     => 'required|string',
            'stakeholders_constraint' => 'required|string',

        ]);

        $appraisal = AppraisalCustomer::find($request->customerAppraisalID);

        $appraisal->objective  = $request->stakeholders_objective;
        $appraisal->kpi        = $request->stakeholders_kpi;
        $appraisal->target     = $request->stakeholders_target;
        $appraisal->constraint = $request->stakeholders_constraint;

        $appraisal->save();

        Session::flash('success', 'Appraisal Updated!');

        return back();

    }

    public function deleteAppraisals(Request $request)
    {

        $allAppraisalIDs = $request->appraisalIDs;

        $allAppraisalIDs = explode(',', $allAppraisalIDs);

//        dd($allAppraisalIDs);

        foreach ($allAppraisalIDs as $allAppraisalID) {

            $appraisal = AppraisalCustomer::find($allAppraisalID);

            $appraisal->delete();

        }

        Session::flash('success', 'Appraisal Deleted.');

        return back();

    }

}
