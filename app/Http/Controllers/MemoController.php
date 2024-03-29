<?php

namespace MESL\Http\Controllers;

use DB;
use File;
use Illuminate\Http\Request;
use Mail;
use MESL\Mail\ApprovedMemo;
use MESL\Mail\ApprovedMemoConfirmation;
use MESL\Mail\SendRouteMail;
use MESL\Memo;
use MESL\MemoAttachment;
use MESL\Notifications\MemoApproval;
use MESL\Notifications\MemoReceipient;
use MESL\RequestType;
use MESL\Staff;
use MESL\User;
use Notification;
use Storage;
use ZipArchive;

class MemoController extends Controller
{

    public function index()
    {
        $memos            = Memo::all();
        $my_memos         = $memos->where('initiator_id', auth()->user()->staff->StaffRef)->where('NotifyFlag', 1)->sortByDesc('created_at');
        $my_unsent_memos  = $memos->where('initiator_id', auth()->user()->staff->StaffRef)->where('NotifyFlag', 0);
        $unapproved_memos = Memo::where('ApproverID', auth()->user()->id)
            ->where('NotifyFlag', 1)

            ->get()->sortByDesc('created_at');
        $memo_inbox = $memos->where('NotifyFlag', 1)
            ->where('ApprovedFlag', 1)
            ->where('ApproverID', 0)
            ->sortByDesc('created_at')
            ->filter(function ($value) {
                return array_intersect($value->recipients, [auth()->user()->id]);
            });

        // dd($memo_inbox->toArray());
        // return response()->json($memo_inbox->toArray(), 200);

        return view('memos.index', compact('memos', 'my_memos', 'my_unsent_memos', 'ma', 'memo_inbox', 'unapproved_memos'));
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
                return redirect()->route('memos.index', ['tab=1'])->with('success', 'Memo was created successfully.');
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
        $memo = Memo::find($id);
        // dd(collect($memo->recipients));
        // dd(collect($memo->recipients)->values());
        $employees = User::all();
        $employees = $employees->transform(function ($item, $key) {
            $item->name = $item->Fullname;
            return $item;
        });
        // dd($employees);
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
            $memo = Memo::find($value);
            $request->session()->forget('current_approver');
            $current_approver = User::find($memo->ApproverID)->fullName;
            // $request->session()->put('current_approver', $memo->ApproverID);
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
                // send email notification to the initiator

                Mail::to($memo->initiator->user->email)->send(new ApprovedMemo($memo, $next_approver, $current_approver));
            } else {
                Mail::to($memo->initiator->user->email)->send(new ApprovedMemo($memo, $next_approver, $current_approver));
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

                // send initiator email

                Mail::to($memo->initiator->user->email)->send(new ApprovedMemoConfirmation($memo));

                // send email to recipients
                // $recipients = implode(',', $memo->recipients);
                // dd($recipients);
                // $staff = User::whereHas('staff', function ($q) use ($request, $recipients) {
                //     $q->whereRaw("id in ($recipients)");
                // })->get();

                // Mail::to($staff)->send(new ApprovedMemo($memo, $next_approver = null));

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

    public function downloadAttachments($id)
    {
        $memo = Memo::find($id);

        $filename = 'myzipfile.zip';
        $files    = $memo->attachments->map(function ($item, $key) {
            return public_path('storage/memo_attachments') . '/' . $item->attachment_location;
        })->toArray();
        // dd($files);
        \Zipper::make(public_path(str_slug($memo->subject) . '.zip'))->add($files)->close();
        return response()->download(public_path(str_slug($memo->subject) . '.zip'));
    }

    public function routing()
    {
        $memos = Memo::where('processed_flag', 0)->get();
        $staff = User::all();
        return view('memos.routing', compact('memos', 'staff'));
    }

    public function routing_store(Request $request)
    {
        $memo              = Memo::find($request->id);
        $memo->ApproverID1 = $request->ApproverID1;
        $memo->ApproverID2 = $request->ApproverID2;
        $memo->ApproverID3 = $request->ApproverID3;
        $memo->ApproverID4 = $request->ApproverID4;
        $memo->save();
        // return response()->json([
        //     'success' => true,
        //     'data'    => $memo,
        //     'message' => 'Memo has been updated successfully',
        // ], 200);
        Mail::to($memo->initiator->user->email)->send(new SendRouteMail($memo));
        return redirect('/memos/routing')->with('success', 'Memo has been routed successfully');
    }

    public function fetchMemoApprovers(Request $request)
    {
        $memo = Memo::where('id', $request->id)->get();
        $memo = $memo->transform(function ($item, $key) {
            $item->approver1_name = User::find($item->ApproverID1)->FullName ?? '';
            $item->approver2_name = User::find($item->ApproverID2)->FullName ?? '';
            $item->approver3_name = User::find($item->ApproverID3)->FullName ?? '';
            $item->approver4_name = User::find($item->ApproverID4)->FullName ?? '';
            return $item;
        });

        if ($memo) {
            // return redirect()->with('success', 'Memo has been routed successfully');
            return response()->json([
                'success' => true,
                'data'    => $memo[0],
                'message' => 'Approvers Fetched Successfully',
            ], 200);
        } else {
            // return redirect()->with('danger', 'Memo routing failed');
            return response()->json([
                'success' => false,
                'data'    => $memo[0],
                'message' => 'Memo was not found',
            ], 200);
        }

    }
}
