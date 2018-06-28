<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use File;
use Image;
use ZipArchive;
use Storage;
use Notification;
use Cavidel\Notifications\MemoApproval;
use Cavidel\Notifications\MemoReceipient;
use Cavidel\User;
use Cavidel\Staff;
use Cavidel\Memo;
use Cavidel\RequestType;
use Cavidel\MemoAttachment;

class MemoController extends Controller
{

    public function index()
    {
        $memos            = Memo::all();
        $my_memos         = $memos->where('initiator_id', auth()->user()->staff->StaffRef)->where('NotifyFlag', 1);
        $my_unsent_memos  = $memos->where('initiator_id', auth()->user()->staff->StaffRef)->where('NotifyFlag', 0);
        $unapproved_memos = Memo::where('ApproverID', auth()->user()->id)
            ->where('NotifyFlag', 1)
            ->get();
        $memo_inbox = $memos->where('NotifyFlag', 1)
            ->where('ApprovedFlag', 1)
            ->where('ApproverID', 0)
            ->filter(function ($value) {
                return array_intersect($value->recipients, [auth()->user()->id]);
            });

        return view('memos.index', compact('memos', 'my_memos', 'my_unsent_memos', 'memo_inbox', 'unapproved_memos'));
    }

    public function create()
    {

        $employees = Staff::where('CompanyID', auth()->user()->CompanyID)->get();
        // dd($employees);
        $employees = $employees->transform(function ($item, $key) {
            $item->name = $item->FullName;
            return $item;
        });
        $request_types = RequestType::all();
        return view('memos.create', compact('employees', 'request_types'));
    }

    public function send($id)
    {
        try {
            DB::beginTransaction();
            $memo       = Memo::findorFail($id);
            $recipients = $memo->recipients;
            $recipients = collect($recipients);

            $recipients->transform(function ($item, $key) {
                $item = Staff::where('UserID', $item)->first()->user;
                return $item;
            });

            // if no approvers
            if ($memo->ApproverID == 0) {
                // send meo to recipients
                $memo->ApprovedFlag = true;
                $memo->NotifyFlag   = true;
                $memo->save();
                DB::commit();
                Notification::send($recipients->all(), new MemoReceipient($memo));
                return redirect()->route('memos.index')->with('success', 'Memo has been sent to recipients successfully');
            } else {
                $memo->NotifyFlag = true;
                if ($memo->save()) {
                    // TODO: send notification here
                    $next_approver = $memo->ApproverID != 0 ? Staff::where('UserID', $memo->ApproverID)->first()->user : null;
                    if (!is_null($next_approver)) {
                        Notification::send($next_approver, new MemoApproval($memo));
                    }
                    DB::commit();
                    return redirect()->route('memos.index')->with('success', 'Memo has been sent for approval successfully');
                } else {
                    return back()->withInput()->with('error', 'Failed to send Memo for approval');
                }
            }

        } catch (Exception $e) {
            DB::rollback();
        }

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'subject'         => 'required',
            'purpose'         => 'required',
            'request_type_id' => 'required',
            'recipients'      => 'required',
            'body'            => 'required',

            // 'receiver_id'     => 'required',
        ], [
            'request_type_id.required' => 'Choosing a request type is compulsory',
            // 'receiver_id.required'     => 'Choosing a receipient is compulsory',
        ]);
        try {

            DB::beginTransaction();
            $new_memo               = new Memo($request->except('memo_attachment'));
            $new_memo->initiator_id = auth()->user()->staff->StaffRef;
            $new_memo->ApproverID   = $request->ApproverID1;
            // $new_memo->recipients   = json_encode($request->recipients);
            if ($new_memo->save()) {
                // START attachment
                if ($request->hasFile('memo_attachment')) {
                    foreach ($request->memo_attachment as $key => $value) {
                        $file = $request->file('memo_attachment')[$key];
                        // $filename = uniqid() . '-' . $file->getClientOriginalName();
                        // $value->storeAs('memo_attachments', $filename);
                        Storage::disk('public')->put('memo_attachments', $file);
                        // $attachment = new MemoAttachment;
                        MemoAttachment::create([
                            'memo_id'             => $new_memo->id,
                            'attachment_location' => $file->hashName(),
                        ]);
                    }
                }
                // END attachment upload
                DB::commit();
                return redirect()->route('memos.create')->with('success', 'Memo was created successfully.');
            }
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function show($id)
    {

        $memo = Memo::where('id', $id)->get();
        // dd($memo->subject);
        $memo = $memo->transform(function ($item, $key) {
            $item->sender         = $item->initiator->Fullname;
            $item->approvers      = $item->approvers();
            $item->approved       = $item->approved();
            $item->status         = $item->status();
            $item->attachments    = $item->attachments;
            $item->recipient_list = $item->recipients_list();
            return $item;
        });
        return $memo->first();
    }

    public function edit($id)
    {
        $memo      = Memo::find($id);
        $employees = User::all();
        $employees = $employees->transform(function ($item, $key) {
            $item->name = $item->Fullname;
            return $item;
        });
        $request_types = RequestType::all();
        return view('memos.edit', compact('memo', 'employees', 'request_types'));
    }

    public function update(Request $request, $id)
    {
        $memo = Memo::find($id);
        if ($memo->update($request->except('memo_attachment'))) {
            return redirect()->route('memos.create')->with('success', 'Memo has been updated successfully');
        } else {
            return back()->withInput()->with('error', 'Memo failed to updated');
        }
    }

    public function approval_list()
    {

        // unapproved docs
        $unapproved_memos = Memo::where('ApproverID', auth()->user()->id)
            ->where('NotifyFlag', 1)
            ->get();
        $my_unsent_memos = Memo::where('initiator_id', auth()->user()->staff->StaffRef)->where('NotifyFlag', 0);
        // approved docs
        $approved_memos = Memo::where('ApproverID', 0)
            ->where('ApprovedFlag', 1)
            ->whereIn('ApproverID1', [auth()->user()->id])
            ->orWhereIn('ApproverID2', [auth()->user()->id])
            ->orWhereIn('ApproverID3', [auth()->user()->id])
            ->orWhereIn('ApproverID4', [auth()->user()->id])
            ->get();

        return view('memos.approvallist', compact('approved_memos', 'unapproved_memos', 'my_unsent_memos'));
    }

    public function approve(Request $request)
    {

        $ApprovedDate = $request->ApprovedDate;
        $SelectedID   = collect($request->SelectedID);
        $ApproverID   = $request->ApproverID;
        $Comment      = $request->Comment;
        $ModuleID     = $request->ModuleID;
        $ApprovedFlag = $request->ApprovedFlag;
        $new_array    = array();
        foreach ($SelectedID as $value) {
            array_push($new_array, intval($value));
            $approve_proc = \DB::statement(
                "EXEC procApproveRequest  '$ApprovedDate', '$value', $ModuleID, '$Comment', $ApproverID, $ApprovedFlag"
            );
            $memo = Memo::find($value);

            $next_approver = $memo->ApproverID != 0 ? Staff::where('UserID', $memo->ApproverID)->first()->user : null;
            $recipients    = $memo->recipients;
            $recipients    = collect($recipients);

            $recipients->transform(function ($item, $key) {
                $item = Staff::where('UserID', $item)->first()->user;
                return $item;
            });

            if (!is_null($next_approver) || $next_approver != 0) {
                Notification::send($next_approver, new MemoApproval($memo));
            } else {
                // send mail to reciepient, notifying them of the memo approval
                Notification::send($recipients->all(), new MemoReceipient($memo));
            }
        }
        // $selected_ids = (implode(',', $new_array));

        // Send Notification to next Approver

        return response()->json([
            'message' => 'Memo was approved successfully',
        ])->setStatusCode(200);
    }

    public function process(Request $request)
    {

        try {
            DB::beginTransaction();
            $memo                 = Memo::find($request->id);
            $memo->processed_flag = 1;
            if ($memo->save()) {
                DB::commit();
                return redirect('/memos')->with('success', 'Memo was marked as complete');
            }
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function reject(Request $request)
    {
        // return dd($request);
        // Call rejection procedure
        $RejectedDate = $request->RejectedDate;
        $SelectedID   = collect($request->SelectedID);
        $RejecterID   = $request->RejecterID;
        $Comment      = $request->Comment;
        $ModuleID     = $request->ModuleID;
        $RejectedFlag = $request->RejectedFlag;
        $new_array    = array();
        foreach ($SelectedID as $value) {
            array_push($new_array, intval($value));
        }
        $selected_ids = (implode(',', $new_array));

        $approve_proc = \DB::statement(
            "EXEC procRejectRequest  '$selected_ids', $ModuleID, '$Comment'"
        );

        return response()->json([
            'message' => 'Memo was rejected successfully',
        ])->setStatusCode(200);
    }

    public function download_memo_attachments($id)
    {
        $memo    = Memo::find($id);
        $files   = $memo->attachments;
        $zipname = $memo->subject . '.zip';
        $zip     = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);
        foreach ($files as $file) {
            $zip->addFile($file, storage_path('memo_attachments'));
        }
        $zip->close();
        // dd($zip);
        // return response()->download($zipname);
    }

    public function destroy($id)
    {

        $memo = Memo::find($id);
        if ($menu->delete()) {
            return redirect()->route('memos.index')->with('success', 'Memo was deleted successfully');
        } else {
            return back()->withInput();
        }
    }
}
