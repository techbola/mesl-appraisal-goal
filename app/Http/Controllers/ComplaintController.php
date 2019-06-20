<?php

namespace MESL\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use MESL\BuildingProject;
use MESL\CompanyOffice;
use MESL\Complaint;
use MESL\ComplaintAttachment;
use MESL\ComplaintCategory;
use MESL\ComplaintComment;
use MESL\Customer;
use MESL\Department;
use MESL\Location;
use MESL\Notifications\SendComplaintNotification;
use MESL\Staff;
use MESL\User;
use Storage;

class ComplaintController extends Controller
{
    public function index()
    {
        $clients    = Customer::all();
        $locations  = BuildingProject::all();
        $auth_ref   = auth()->user()->id;
        $complaints = Complaint::where('sender_id', $auth_ref)->get()->transform(function ($item, $key) {
            $item->recipient_dept = !empty($item->current_queue) ? Department::find($item->current_queue)->Department : '';
            return $item;
        });
        // dd($complaints);
        $comments = ComplaintComment::all();
        // dd($complaint_discussions);
        $departments = Department::get(['Department', 'DepartmentRef']);
        // dd($departments);
        // ------------------------------- //

        $staff  = auth()->user()->staff;
        $_depts = Staff::where('StaffRef', $staff->StaffRef)->get(['DepartmentID'])->first();
        $depts  = explode(',', $_depts->DepartmentID);
        // department is always IT Helpdesk @ satrt
        // dd($depts);
        // dd(explode(',', ));
        $my_departments = Department::whereIn('DepartmentRef', $depts)->get();
        // $recipient_dept =  Department::find();
        $complaint_sent_to_dept = Complaint::whereIn('current_queue', $depts)
            ->where('notify_flag', 1)->get();

        $complaint_discussions = Complaint::whereIn('current_queue', $depts)->get();

        $locations = collect([
            [
                "id"   => 1,
                "text" => "Abuja HQT Office",
            ],
            [
                "id"   => 2,
                "text" => "Jebba Office",
            ],
            [
                "id"   => 3,
                "text" => "Kanji Office",
            ],
        ]);

        return view('facility_management.complaints.index', compact('locations', 'clients', '_depts', 'depts', 'complaints', 'departments', 'comments', 'complaint_sent_to_dept'));
    }

    public function create()
    {
        $clients    = Customer::all();
        $locations  = CompanyOffice::all();
        $categories = ComplaintCategory::all();
        $employees  = Staff::select('UserID', 'StaffRef')->get();
        return view('facility_management.complaints.create', compact('locations', 'clients', 'categories', 'employees'));
    }

    public function send(Request $request)
    {
        try {
            $complaint = Complaint::find($request->complaint_id);
            DB::beginTransaction();
            // dd($request->current_queue);
            $complaint->notify_flag   = true; // flag complaint as sent [denotes that process has started]
            $complaint->current_queue = $request->current_queue; // department that sees it next
            $staff                    = Staff::whereIn('DepartmentID', [$request->current_queue])->get();

            $complaint->save();

            $user_email = [];
            foreach ($staff as $staff) {
                if (!is_null($staff->user['email'])) {
                    array_push($user_email, User::whereEmail($staff->user['email'])->first());
                }
            }

            // dd($user_email);
            \Notification::send($user_email, new SendComplaintNotification($complaint));
            DB::commit();
            return redirect()->route('facility-management.complaints.index')->with('success', 'Complaint was sent successfully');

        } catch (Exception $e) {
            DB::rollback();
        }

    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            // 'client_id' => 'required',
        ], [
            // custom messags
        ]);

        if ($validator->fails()) {
            return redirect()->route('facility-management.complaints.index')->with('danger', 'Complaints failed to save');
        }

        //  save record
        $complaint = new Complaint($request->all() + ['sender_id' => auth()->user()->id]);
        // department is always IT Helpdesk @ satrt
        $complaint->current_queue = ''; // empty at forst;
        $complaint->location_id   = auth()->user()->staff->location->LocationRef ?? 1;
        // $complaint->client_id = auth()->use
        // $complaint->location_id = auth()->user()->staff->location->LocationRef;

        try {
            DB::beginTransaction();
            $complaint->save();
            // TODO: send email to
            DB::commit();
            return redirect()->route('facility-management.complaints.create')->with('success', 'Compaints have been saved successfully');

        } catch (Exception $e) {
            DB::rollback();
            dump($e);
        }

    }

    public function edit($id)
    {
        $complaint  = Complaint::find($id);
        $clients    = Customer::all();
        $locations  = Location::all();
        $employees  = Staff::select('UserID', 'StaffRef')->get();
        $categories = ComplaintCategory::all();
        return view('facility_management.complaints.edit', compact('complaint', 'clients', 'locations', 'employees', 'categories'));

    }

    public function comment(Request $request)
    {
        try {
            DB::beginTransaction();
            $complaint = Complaint::find($request->complaint_id)->first();
            // dd($complaint);
            // create comment
            $staff                    = auth()->user()->staff;
            $_depts                   = Staff::where('StaffRef', $staff->StaffRef)->get(['DepartmentID'])->first();
            $depts                    = explode(',', $_depts->DepartmentID);
            $comment                  = new ComplaintComment($request->except('complaint_attachment'));
            $comment->complaint_id    = $request->complaint_id;
            $comment->has_cost        = $request->has_cost ?? 0;
            $comment->queue_sender_id = auth()->user()->staff->DepartmentID ?? 1; //dept_id

            if ($comment->save()) {
                // attachment_upload
                if ($request->hasFile('complaint_attachment')) {
                    foreach ($request->complaint_attachment as $key => $value) {
                        $file = $request->file('complaint_attachment')[$key];
                        // $filename = uniqid() . '-' . $file->getClientOriginalName();
                        // $value->storeAs('complaint_attachments', $filename);
                        Storage::disk('public')->put('complaint_attachments', $file);
                        // $attachment = new MemoAttachment;
                        ComplaintAttachment::create([
                            'complaint_id'        => $request->complaint_id,
                            'comment_id'          => $comment->id,
                            'attachment_location' => $file->hashName(),
                        ]);
                    }
                }
                DB::commit();
                return redirect()->route('facility-management.complaints.index')->with('success', 'Feedback posted. ');
            }

        } catch (Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function view_comments($id)
    {
        $complaint             = Complaint::find($id);
        $comments              = ComplaintComment::all();
        $complaint_discussions = $complaint->comments->transform(function ($item, $key) {
            $item->department = Department::find($item->queue_sender_id);
            return $item;
        })->sortByDesc('created_at');
        return view('facility_management.complaints.comments', compact('complaint_discussions', 'complaint', 'comments'));
    }

    public function update(Request $request, $id)
    {
        $complaint                = Complaint::find($id);
        $complaint->current_queue = 14;
        $complaint->location_id   = auth()->user()->staff->location->LocationRef ?? 1;
        if ($complaint->update($request->all())) {
            return redirect()->route('facility-management.complaints.edit', ['id' => $id])->with('success', 'Complaint was updated successfully');
        }
    }

    public function show($id)
    {
        $client    = Customer::find($id);
        $clients   = Customer::all();
        $locations = Location::all();
        return view('facility_management.complaints.create2', compact('locations', 'clients', 'client'));
    }
}
