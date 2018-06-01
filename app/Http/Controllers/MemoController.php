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
use Cavidel\User;
use Cavidel\Staff;
use Cavidel\Memo;
use Cavidel\RequestType;
use Cavidel\MemoAttachment;

class MemoController extends Controller
{

    public function index()
    {
        $memos = Memo::all();
        return view('memos.index', compact('memos'));
    }

    public function create()
    {
        $employees = User::all();
        $employees = $employees->transform(function ($item, $key) {
            $item->name = $item->Fullname;
            return $item;
        });
        $request_types = RequestType::all();
        return view('memos.create', compact('employees', 'request_types'));
    }

    public function send($id)
    {
        try {
            DB::beginTransaction();
            $memo             = Memo::findorFail($id);
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
            'body'            => 'required',
            'receiver_id'     => 'required',
        ], [
            'request_type_id.required' => 'Choosing a request type is compulsory',
            'receiver_id.required'     => 'Choosing a receipient is compulsory',
        ]);
        try {

            DB::beginTransaction();
            $new_memo               = new Memo($request->except('memo_attachment'));
            $new_memo->initiator_id = auth()->user()->staff->StaffRef;
            $new_memo->ApproverID   = $request->ApproverID1;
            if ($new_memo->save()) {
                // START attachment
                if ($request->hasFile('memo_attachment')) {
                    foreach ($request->memo_attachment as $key => $value) {
                        $file     = $request->file('memo_attachment')[$key];
                        $filename = $file->hashName();

                        if (!File::exists(public_path('images/memo_attachments')) && File::exists(public_path('images'))) {
                            File::makeDirectory(public_path('images/memo_attachments'));
                        }

                        Image::make($file)->orientate()->resize(300, null, function ($constraint) {$constraint->aspectRatio();})->save('images/memo_attachments/' . $filename);
                        // $attachment = new MemoAttachment;
                        MemoAttachment::create([
                            'memo_id'             => $new_memo->id,
                            'attachment_location' => $filename,
                        ]);
                    }
                }
                // END attachment upload
                DB::commit();
                return redirect()->route('memos.create')->with('success', 'Memo was created successfully. <a href="' . route('memos.index') . '">Go to queue</a>');
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
            $item->sender      = $item->initiator->Fullname;
            $item->approvers   = $item->approvers();
            $item->approved    = $item->approved();
            $item->status      = $item->status();
            $item->attachments = $item->attachments;
            return $item;
        });
        return $memo->first();
    }

    public function edit($id)
    {
        $memo = Memo::find($id);
        return view('memos.edit', compact('memo'));

    }

    public function update(Request $request, $id)
    {
        $memo = Memo::find($id);
        if ($memo->update($request->all())) {
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

        // approved docs
        $approved_memos = Memo::where('ApproverID', 0)
            ->where('ApprovedFlag', 1)
            ->whereIn('ApproverID1', [auth()->user()->id])
            ->orWhereIn('ApproverID2', [auth()->user()->id])
            ->orWhereIn('ApproverID3', [auth()->user()->id])
            ->orWhereIn('ApproverID4', [auth()->user()->id])
            ->get();

        return view('memos.approvallist', compact('approved_memos', 'unapproved_memos'));
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
        }
        $selected_ids = (implode(',', $new_array));

        $approve_proc = \DB::statement(
            "EXEC procApproveRequest  '$ApprovedDate', '$selected_ids', $ModuleID, '$Comment', $ApproverID, $ApprovedFlag"
        );

        return response()->json([
            'message' => 'Memo was approved successfully',
        ])->setStatusCode(200);
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
