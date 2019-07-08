<?php

namespace MESL\Http\Controllers\Supervisor;

use Illuminate\Http\Request;
use MESL\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use MESL\Behavioural;
use MESL\Staff;
use MESL\StaffBehaviouralItem;

class StaffBehaviouralItemController extends Controller
{

    public function staffBehaviouralStore(Request $request)
    {

        $staff = Staff::where('UserID', auth()->user()->id)->first();

        $behaviouralCatIds   = [];
        $behaviouralItemsIds = [];

        foreach (json_decode($request->behaviourals) as $b) {

            $behavioural = Behavioural::find($b);

            $behaviouralItems = $behavioural->behaviouralUserItems->all();

            foreach ($behaviouralItems as $b_item) {

                array_push($behaviouralCatIds, $b_item->behaviouralCat_id);
                array_push($behaviouralItemsIds, $b_item->id);

            }

        }

        for ($i = 0; $i < count($request->selfAssess); $i++) {

            $staff_behavioural_item = new StaffBehaviouralItem();

            $staff_behavioural_item->behaviouralCat_id  = $behaviouralCatIds[$i];
            $staff_behavioural_item->behaviouralItem_id = $behaviouralItemsIds[$i];
            $staff_behavioural_item->selfAssessment     = $request->selfAssess[$i];
            $staff_behavioural_item->supervisorID       = $staff->SupervisorID;
            $staff_behavioural_item->staffID            = $staff->StaffRef;
            $staff_behavioural_item->appraisal_id       = $request->appraisalID;

            $staff_behavioural_item->save();

        }

        Session::flash('success', 'Saved!');

        return redirect()->route('appraisal.staffAppraisalEdit', ['appraisalID' => $request->appraisalID]);

    }

    public function updateStaffBehavioural(Request $request)
    {

        $items = StaffBehaviouralItem::where('appraisal_id', $request->appraisalID)->get()->all();

        if ($items){

            $staff = Staff::where('UserID', auth()->user()->id)->first();

            $behaviouralCatIds   = [];
            $behaviouralItemsIds = [];

            foreach (json_decode($request->behaviourals) as $b) {

                $behavioural = Behavioural::find($b);

                $behaviouralItems = $behavioural->behaviouralUserItems->all();

                foreach ($behaviouralItems as $b_item) {

                    array_push($behaviouralCatIds, $b_item->behaviouralCat_id);
                    array_push($behaviouralItemsIds, $b_item->id);

                }

            }

            for ($i = 0; $i < count($items); $i++) {

                $items[$i]->behaviouralCat_id  = $behaviouralCatIds[$i];
                $items[$i]->behaviouralItem_id = $behaviouralItemsIds[$i];
                $items[$i]->selfAssessment     = $request->selfAssess[$i];
                $items[$i]->supervisorID       = $staff->SupervisorID;
                $items[$i]->staffID            = $staff->StaffRef;
                $items[$i]->appraisal_id       = $request->appraisalID;

                $items[$i]->save();

            }

            Session::flash('success', 'Saved!');

            return redirect()->route('appraisal.staffAppraisalEdit', ['appraisalID' => $request->appraisalID]);

        }else{

            $staff = Staff::where('UserID', auth()->user()->id)->first();

            $behaviouralCatIds   = [];
            $behaviouralItemsIds = [];

            foreach (json_decode($request->behaviourals) as $b) {

                $behavioural = Behavioural::find($b);

                $behaviouralItems = $behavioural->behaviouralUserItems->all();

                foreach ($behaviouralItems as $b_item) {

                    array_push($behaviouralCatIds, $b_item->behaviouralCat_id);
                    array_push($behaviouralItemsIds, $b_item->id);

                }

            }

            for ($i = 0; $i < count($request->selfAssess); $i++) {

                $staff_behavioural_item = new StaffBehaviouralItem();

                $staff_behavioural_item->behaviouralCat_id  = $behaviouralCatIds[$i];
                $staff_behavioural_item->behaviouralItem_id = $behaviouralItemsIds[$i];
                $staff_behavioural_item->selfAssessment     = $request->selfAssess[$i];
                $staff_behavioural_item->supervisorID       = $staff->SupervisorID;
                $staff_behavioural_item->staffID            = $staff->StaffRef;
                $staff_behavioural_item->appraisal_id       = $request->appraisalID;

                $staff_behavioural_item->save();

            }

            Session::flash('success', 'Saved!');

            return redirect()->route('appraisal.staffAppraisalEdit', ['appraisalID' => $request->appraisalID]);

        }


    }

}
