<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use MESL\User;
use MESL\Staff;
use MESL\RequestList;
use MESL\ApproverRole;
use MESL\ExpenseManagement;
use MESL\ExpenseManagementFile;
use MESL\ExpenseComment;
use MESL\Department;
use MESL\Bank;
use MESL\Location;
use MESL\LotDescription;
use MESL\ExpenseCategory;
use MESL\ExpenseCommentFile;
use MESL\Notifications\ExpenseReceipient;
use MESL\Notifications\ExpenseApproval;
use DB, Storage, Notification;

class ExpenseManagementController extends Controller
{

    public function index()
    {
        $expense_management            = ExpenseManagement::all();
        $my_expense_management         = $expense_management->where('inputter_id', auth()->user()->id)->where('NotifyFlag', 1);
        $my_unsent_expense_management  = $expense_management->where('inputter_id', auth()->user()->id)->where('NotifyFlag', 0);
        $unapproved_expense_management = ExpenseManagement::whereIn('ApproverRoleID', explode(',', auth()->user()->ApproverRoleIDs))
            ->where('NotifyFlag', 1)
            ->get();
        $exp_inbox = $expense_management->where('NotifyFlag', 1)
        // ->where('ApprovedFlag', 1)
            ->whereIn('ApproverRoleID', explode(',', auth()->user()->ApproverRoleIDs));

        return view('expense_management.index', compact('expense_management', 'my_expense_management', 'my_unsent_expense_management', 'ma', 'exp_inbox', 'unapproved_expense_management'));
    }

    public function send($id)
    {
        try {
            DB::beginTransaction();
            $exp        = ExpenseManagement::findorFail($id);
            $recipients = $exp->recipients;
            $recipients = collect($recipients);

            $recipients->transform(function ($item, $key) {
                $item = Staff::where('UserID', $item)->first()->user;
                return $item;
            });

            // if no approvers
            if ($exp->ApproverRoleID == 0) {
                // send meo to recipients
                $exp->ApprovedFlag = true;
                $exp->NotifyFlag   = true;
                $exp->save();
                DB::commit();

                return redirect()->route('expense_management.index')->with('success', 'Expense has been sent to recipients successfully');
            } else {
                $exp->NotifyFlag = true;
                if ($exp->save()) {
                    // TODO: send notification here
                    //send mail to supervisor
                    $supervisor = User::find(Staff::find(User::find($exp->inputter_id)->staff->SupervisorID)->UserID);
                    Notification::send($supervisor, new ExpenseReceipient($exp));
                    DB::commit();
                    return redirect()->route('expense_management.index')->with('success', 'Expense has been sent for approval successfully');
                } else {
                    return back()->withInput()->with('error', 'Failed to send Expense for approval');
                }
            }

        } catch (Exception $e) {
            DB::rollback();
        }

    }

    public function create()
    {
        $employees = Staff::where('CompanyID', auth()->user()->CompanyID)->get();
        // dd($employees);
        $employees = $employees->transform(function ($item, $key) {
            $item->name = $item->FullName;
            return $item;
        });
        $request_list       = RequestList::all();
        $lot_descriptions   = LotDescription::all();
        $locations          = Location::all();
        $departments        = Department::all();
        $banks              = Bank::all();
        $expense_categories = ExpenseCategory::all();
        $bank_acct_details  = LotDescription::all();
        $debit_acct_details = collect(\DB::select("SELECT        tblTransaction.GLID as GLRef, tblGL.Description  + ' - ' +  tblCurrency.Currency + CONVERT(varchar, format((SUM(tblTransaction.Amount * tblTransactionType.TradeSign)),'#,##0.00'))  AS CUST_ACCT
            FROM            tblTransaction
            INNER JOIN tblTransactionType ON tblTransaction.TransactionTypeID = tblTransactionType.TransactionTypeRef
            INNER JOIN tblGL on tblTransaction.GLID=tblGL.GLRef
            inner join tblCurrency on tblGL.CurrencyID=tblCurrency.CurrencyRef
            CROSS JOIN tblConfig
             INNER JOIN tblBranch ON tblGL.BranchID = tblBranch.BranchRef
             Where tblGL.AccountTypeID between ? and ? OR tblGL.AccountTypeID between ? and ?
             GROUP BY tblTransaction.GLID,tblGL.Description,Currency
             Order By tblGL.Description", [11, 12, 27, 39]));
        return view('expense_management.create', compact('request_list', 'employees', 'locations', 'banks', 'departments', 'expense_categories', 'debit_acct_details', 'lot_descriptions'));
    }

    public function show($id)
    {
        $exp = ExpenseManagement::where('ExpenseManagementRef', $id)->with('expense_comments')->get();
        // dd($exp->subject);
        $exp = $exp->transform(function ($item, $key) {
            $item->approvers     = $item->request_type->approvers_formatted('<b style="font-size: 1.4rem; color: red">&rarr;</b>');
            $item->comment_files = $item->expense_comments->transform(function ($item, $key) {
                $item->files = $item->attachments->transform(function ($item, $key) {
                    return '<b><a href="' . asset('storage/expense_management_files') . '/' . $item->FileName . '" target="_blank">file#' . ++$key . '</a></b> ';
                });
                $item->approved_by = ApproverRole::find($item->ApproverRoleID)->ApproverRole;
                return $item;
            });
            return $item;
        });
        return $exp->first();
    }

    public function store(Request $request)
    {
        $expense_management              = new ExpenseManagement($request->except(['attachment']));
        $expense_management->inputter_id = auth()->user()->id;

        // dd($debit_acct_details);
        try {

            DB::beginTransaction();
            $expense_management->save();
            if ($request->hasFile('attachment')) {
                $e_id = $expense_management->ExpenseManagementRef;
                // dd($expense_management);
                foreach ($request->attachment as $key => $value) {
                    $file = $request->file('attachment')[$key];
                    // $filename = uniqid() . '-' . $file->getClientOriginalName();
                    // $value->storeAs('attachments', $filename);
                    Storage::disk('public')->put('expense_management_files', $file);
                    // $attachment = new ExpenseManagementFile

                    ExpenseManagementFile::create([
                        'ExpenseManagementID' => $e_id,
                        'FileName'            => $file->hashName(),
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('expense_management.create')->with('success', 'Expense Saved');

        } catch (Exception $e) {
            return back()->withErrors($e->getMessages());
            DB::rollback();
        }

    }

    public function edit($id)
    {
        $expense_management = ExpenseManagement::find($id);
        $employees          = Staff::where('CompanyID', auth()->user()->CompanyID)->get();
        // dd($employees);
        $employees = $employees->transform(function ($item, $key) {
            $item->name = $item->FullName;
            return $item;
        });
        $request_list       = RequestList::all();
        $lot_descriptions   = LotDescription::all();
        $departments        = Department::all();
        $banks              = Bank::all();
        $locations          = Location::all();
        $expense_categories = ExpenseCategory::all();
        $bank_acct_details  = LotDescription::all();
        $debit_acct_details = collect(\DB::select("SELECT        tblTransaction.GLID as GLRef, tblGL.Description  + ' - ' +  tblCurrency.Currency + CONVERT(varchar, format((SUM(tblTransaction.Amount * tblTransactionType.TradeSign)),'#,##0.00'))  AS CUST_ACCT
            FROM            tblTransaction
            INNER JOIN tblTransactionType ON tblTransaction.TransactionTypeID = tblTransactionType.TransactionTypeRef
            INNER JOIN tblGL on tblTransaction.GLID=tblGL.GLRef
            inner join tblCurrency on tblGL.CurrencyID=tblCurrency.CurrencyRef
            CROSS JOIN tblConfig
             INNER JOIN tblBranch ON tblGL.BranchID = tblBranch.BranchRef
             Where tblGL.AccountTypeID between ? and ? OR tblGL.AccountTypeID between ? and ?
             GROUP BY tblTransaction.GLID,tblGL.Description,Currency
             Order By tblGL.Description", [11, 12, 27, 39]));
        return view('expense_management.edit', compact('expense_management', 'locations', 'employees', 'departments', 'banks', 'lot_descriptions', 'expense_categories', 'bank_acct_details',
            'debit_acct_details', 'request_list'));
    }

    public function update(Request $request, $id)
    {
        $memo = ExpenseManagement::find($id);
        if ($memo->update($request->except('attachment'))) {
            return redirect()->route('expense_management.create')->with('success', 'Expense Request has been updated successfully');
        } else {
            return back()->withInput()->with('error', 'Expense Request failed to updated');
        }
    }

    public function approve(Request $request)
    {

        // $ApprovedDate = $request->ApprovedDate;
        $SelectedID                           = collect($request->ExpenseManagementRef);
        $ApproverRoleID                       = auth()->user()->id;
        $Comment                              = $request->Comment;
        $ModuleID                             = $request->RequestListID;
        $ApprovedFlag                         = 1;
        $new_array                            = array();
        $expense_comment                      = new ExpenseComment($request->except(['attachment', 'ExpenseManagementRef', 'RequestListID']));
        $expense_comment->inputter_id         = auth()->user()->id;
        $expense_comment->ApproverRoleID      = $request->ApproverRoleID;
        $expense_comment->ExpenseManagementID = $request->ExpenseManagementRef;
        try {
            DB::beginTransaction();
            foreach ($SelectedID as $value) {
                array_push($new_array, intval($value));
                $approve_proc = \DB::statement(
                    "EXEC procApproveExpenseRequest   '$value', $ModuleID, '$Comment', $ApproverRoleID, $ApprovedFlag"
                );

                if (!is_null(ExpenseManagement::find($value)->ApproverRoleID)) {
                    $users = User::whereRaw("CONCAT(',',ApproverRoleIDs,',') LIKE CONCAT('%,'," . ExpenseManagement::find($value)->ApproverRoleID . ",',%')")->get();
                    Notification::send($users, new ExpenseReceipient(ExpenseManagement::find($value)));
                } else {
                    $exp                = ExpenseManagement::find($value);
                    $exp->CompletedFlag = 1;
                    $exp->save();
                }

            }
            $expense_comment->save();
            if ($request->hasFile('attachment')) {
                $e_id = $expense_comment->ExpenseCommentRef;
                // dd($expense_management);
                foreach ($request->attachment as $key => $value) {
                    $file = $request->file('attachment')[$key];
                    // $filename = uniqid() . '-' . $file->getClientOriginalName();
                    // $value->storeAs('attachments', $filename);
                    Storage::disk('public')->put('expense_management_files', $file);
                    // $attachment = new ExpenseManagementFile

                    ExpenseCommentFile::create([
                        'ExpenseCommentID' => $e_id,
                        'FileName'         => $file->hashName(),
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('expense_management.index')->with('success', 'Expense Saved');

        } catch (Exception $e) {
            return back()->withErrors($e->getMessages());
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
            $approve_proc = \DB::statement(
                "EXEC procRejectExpenseRequest  '$value', $ModuleID, '$Comment'"
            );

        }

        return response()->json([
            'message' => 'Memo was rejected successfully',
        ])->setStatusCode(200);
    }

    public function authorize_expense()
    {
        return view('expense_management.authorize_expense');
    }

    public function approval_list()
    {
        // dd("aye");
        // Get requester's supervisor
        $supervisors_log = ExpenseManagement::where('ApproverRoleID', '<>', '')->get()
            ->transform(function ($item, $key) {
                $supervisor = User::find($item->inputter_id)->staff->SupervisorID;
                // $item->supervisors = Staff::where('SupervisorID', '<>', '')
                //     ->where('SupervisorID', $supervisor)
                //     ->first();
                $item->requests = ExpenseManagement::where('ApproverRoleID', $supervisor)->get();
                return $item;
            });
        // unapproved reqa
        $unapproved_requests = $supervisors_log->where('SupervisorApproved', 0);
        // dd($unapproved_requests);
        // $my_unsent_requests  = ExpenseManagement::where('initiator_id', auth()->user()->staff->StaffRef)->where('NotifyFlag', 0);
        // approved docs
        $approved_requests = $supervisors_log->where('SupervisorApproved', 1);

        return view('expense_management.approvallist', compact('approved_requests', 'unapproved_requests', 'my_unsent_requests'));
    }

    public function fetchRoles(Request $request)
    {
        $roles = RequestList::find($request->RequestListID);
        return $roles->approvers_formatted('<b style="font-size: 1.4rem; color: red">&rarr;</b>');
    }

    public function supervisor_approval(Request $request)
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
            $exp                     = ExpenseManagement::find($value);
            $exp->SupervisorApproved = 1;
            $exp->save();
            //  send a mail to curent approver
            $approver_id = $exp->ApproverRoleID;
            $users       = User::whereRaw("CONCAT(',',ApproverRoleIDs,',') LIKE CONCAT('%,'," . $exp->ApproverRoleID . ",',%')")->get();
            Notification::send($users, new ExpenseReceipient($exp));

            // response($approver_id);

        }
        // $selected_ids = (implode(',', $new_array));

        // Send Notification to next Approver

        return response()->json([
            'message' => 'Request was sent for approval successfully',
        ])->setStatusCode(200);
    }
}