<?php

namespace MESL\Http\Controllers;

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
use MESL\Mail\StaffSendAppraisal;
use MESL\Staff;
use MESL\StaffBehaviouralItem;
use MESL\Traits\UploadTrait;
use MESL\User;

class AppraisalController extends Controller
{

    use UploadTrait;

    public function index()
    {

        if (!auth()->user()->staff->SupervisorFlag && !auth()->user()->hasRole('HR Supervisor')) {

            return view('staff.index');

        } elseif (auth()->user()->hasRole('HR Supervisor') && auth()->user()->staff->SupervisorFlag) {

            return redirect()->route('appraisal.hr.index');

        } elseif (auth()->user()->hasRole('HR Supervisor')) {

            return redirect()->route('appraisal.hr.index');

        } elseif (auth()->user()->staff->SupervisorFlag) {

            return redirect()->route('appraisal.supervisor.index');

        }

    }

    public function allAppraisals()
    {

        $appraisals = Appraisal::where('StaffID', auth()->user()->staff->StaffRef)->get();

        return view('staff.queues')->with([
            'appraisals' => $appraisals,
        ]);

    }

    public function dashboard($appraisalID)
    {

        if (!auth()->user()->staff->SupervisorFlag && !auth()->user()->hasRole('HR Supervisor')) {

            $appraisal_finances = AppraisalFinance::where('staffID', auth()->user()->staff->StaffRef)
                ->where('appraisal_id', $appraisalID)->get();
            $appraisal_customers = AppraisalCustomer::where('staffID', auth()->user()->staff->StaffRef)->where('appraisal_id', $appraisalID)->get();
            $appraisal_internals = AppraisalInternal::where('staffID', auth()->user()->staff->StaffRef)->where('appraisal_id', $appraisalID)->get();
            $appraisal_learnings = AppraisalLearning::where('staffID', auth()->user()->staff->StaffRef)->where('appraisal_id', $appraisalID)->get();

            $comments   = AppraisalComment::where('staffID', auth()->user()->staff->StaffRef)->first();
            $signatures = AppraisalSignature::where('staffID', auth()->user()->staff->StaffRef)->first();

            $behavioural  = new Behavioural();
            $behaviourals = $behavioural->getUserBehaviourals();

            return view('staff.goals.new_goal.staff')->with([
                'appraisalID'         => $appraisalID,
                'appraisal_finances'  => $appraisal_finances,
                'appraisal_customers' => $appraisal_customers,
                'appraisal_internals' => $appraisal_internals,
                'appraisal_learnings' => $appraisal_learnings,
                'comments'            => $comments,
                'signatures'          => $signatures,
                'behaviourals'        => $behaviourals,
            ]);

        } elseif (auth()->user()->hasRole('HR Supervisor') && !auth()->user()->staff->SupervisorFlag) {

            return redirect()->route('appraisal.hr.index');

        } elseif (auth()->user()->staff->SupervisorFlag) {

            return redirect()->route('appraisal.supervisor.index');

        }

    }

    public function staffDetailsStore(Request $request)
    {

        $this->validate($request, [

            'employee_name'    => 'required|string',
            'appraiser_period' => 'required|string',

        ]);

        $data = Appraisal::where('period', $request->appraiser_period)->where('StaffID', auth()->user()->staff->StaffRef)->first();

        if ($data) {

            Session::flash('errorFlag', 'Appraisal for this period already started, check your queue.');

            return back();

        } else {

            $appraisal = new Appraisal;

            $staff = Staff::where('UserID', auth()->user()->id)->first();

            $appraisal->supervisorID  = $staff->SupervisorID;
            $appraisal->staffID       = $staff->StaffRef;
            $appraisal->employee_name = $request->employee_name;
            $appraisal->period        = $request->appraiser_period;

            $appraisal->save();

            Session::flash('success', 'Saved, move to the next section.');

            return redirect()->route('appraisal.dashboard', ['appraisalID' => $appraisal->id]);

        }

    }

    public function otherAppraisalStore(Request $request)
    {

        if (!auth()->user()->staff->SupervisorFlag) {

            $this->validate($request, [

                'appraisee_comment' => 'required|string',
                'appraisee_sign'    => 'required|image',

            ]);

            $appraisal = new AppraisalComment;

            $staff = Staff::where('UserID', auth()->user()->id)->first();

            $appraisal->staffID          = $staff->StaffRef;
            $appraisal->supervisorID     = $staff->SupervisorID;
            $appraisal->appraiseeComment = $request->appraisee_comment;
            $appraisal->appraisal_id     = $request->appraisalID;

            $appraisal->save();

            // Get image file
            $image = $request->file('appraisee_sign');
            // Make a image name based on user name and current timestamp
            $name = str_slug($request->input('appraisee_sign')) . '_' . time();
            // Define folder path
            $folder = '/uploads/appraisals/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            // Upload image
            $appraisee_sign = $this->uploadOne($image, $folder, 'public', $name);

            $appraisal2 = new AppraisalSignature;

            $appraisal2->staffID       = $staff->StaffRef;
            $appraisal2->supervisorID  = $staff->SupervisorID;
            $appraisal2->appraiseeSign = $filePath;
            $appraisal2->appraisal_id  = $request->appraisalID;

            $appraisal2->save();

            Session::flash('success', 'Saved, move to the next section.');

            return redirect()->route('appraisal.dashboard', ['appraisalID' => $request->appraisalID]);

        }

    }

    public function editAppraisal($id)
    {

        $appraisal_finances  = AppraisalFinance::where('appraisal_id', $id)->get();
        $appraisal_customers = AppraisalCustomer::where('appraisal_id', $id)->get();
        $appraisal_internals = AppraisalInternal::where('appraisal_id', $id)->get();
        $appraisal_learnings = AppraisalLearning::where('appraisal_id', $id)->get();

        $comments   = AppraisalComment::where('appraisal_id', $id)->first();
        $signatures = AppraisalSignature::where('appraisal_id', $id)->first();

        $behavioural           = new Behavioural();
        $behaviourals          = $behavioural->getUserBehaviourals();
        $staffBehaviouralItems = StaffBehaviouralItem::where('appraisal_id', $id);

        return view('staff.goals.edit_goal.staff')->with([
            'appraisalID'           => $id,
            'appraisal_finances'    => $appraisal_finances,
            'appraisal_customers'   => $appraisal_customers,
            'appraisal_internals'   => $appraisal_internals,
            'appraisal_learnings'   => $appraisal_learnings,
            'comments'              => $comments,
            'signatures'            => $signatures,
            'behaviourals'          => $behaviourals,
            'staffBehaviouralItems' => $staffBehaviouralItems,
        ]);

    }

    public function rejectedGoalsa($id)
    {

        $appraisal_finances  = AppraisalFinance::where('appraisal_id', $id)->get();
        $appraisal_customers = AppraisalCustomer::where('appraisal_id', $id)->get();
        $appraisal_internals = AppraisalInternal::where('appraisal_id', $id)->get();
        $appraisal_learnings = AppraisalLearning::where('appraisal_id', $id)->get();

        $comments   = AppraisalComment::where('appraisal_id', $id)->first();
        $signatures = AppraisalSignature::where('appraisal_id', $id)->first();

        $behavioural           = new Behavioural();
        $behaviourals          = $behavioural->getUserBehaviourals();
        $staffBehaviouralItems = StaffBehaviouralItem::where('appraisal_id', $id);

        return view('staff.goals.rejected.staff')->with([
            'appraisalID'           => $id,
            'appraisal_finances'    => $appraisal_finances,
            'appraisal_customers'   => $appraisal_customers,
            'appraisal_internals'   => $appraisal_internals,
            'appraisal_learnings'   => $appraisal_learnings,
            'comments'              => $comments,
            'signatures'            => $signatures,
            'behaviourals'          => $behaviourals,
            'staffBehaviouralItems' => $staffBehaviouralItems,
        ]);

    }

    public function viewGoals($id)
    {

        $appraisal_finances  = AppraisalFinance::where('appraisal_id', $id)->get();
        $appraisal_customers = AppraisalCustomer::where('appraisal_id', $id)->get();
        $appraisal_internals = AppraisalInternal::where('appraisal_id', $id)->get();
        $appraisal_learnings = AppraisalLearning::where('appraisal_id', $id)->get();

        $comments   = AppraisalComment::where('appraisal_id', $id)->first();
        $signatures = AppraisalSignature::where('appraisal_id', $id)->first();

        $behavioural           = new Behavioural();
        $behaviourals          = $behavioural->getUserBehaviourals();
        $staffBehaviouralItems = StaffBehaviouralItem::where('appraisal_id', $id);

        return view('staff.goals.view_goals.staff')->with([
            'appraisalID'           => $id,
            'appraisal_finances'    => $appraisal_finances,
            'appraisal_customers'   => $appraisal_customers,
            'appraisal_internals'   => $appraisal_internals,
            'appraisal_learnings'   => $appraisal_learnings,
            'comments'              => $comments,
            'signatures'            => $signatures,
            'behaviourals'          => $behaviourals,
            'staffBehaviouralItems' => $staffBehaviouralItems,
        ]);

    }

    public function submitAppraisalSupervisor($id)
    {

        $appraisal = Appraisal::find($id);

        $supervisorID = $appraisal->supervisorID;

        $supervisor       = Staff::find($supervisorID);
        $supervisor_email = $supervisor->user->email;

        Mail::to($supervisor_email)->send(new StaffSendAppraisal());

        $appraisal->sentFlag = true;
        $appraisal->status   = 1;

        $appraisal->save();

        Session::flash('success', 'Goals Submitted!');

        return back();

    }

    public function deleteAppraisal($id)
    {
        $appraisal = Appraisal::find($id);

        $appraisal->delete();

        Session::flash('success', 'Appraisal Deleted.');

        return back();

    }

}
