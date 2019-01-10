<?php

namespace Cavi\Http\Controllers;

use Illuminate\Http\Request;
use Cavi\User;
use Cavi\Staff;
use Cavi\RequestList;
use Cavi\ApproverRole;
use Cavi\ExpenseManagement;
use Cavi\ExpenseManagementFile;
use Cavi\ExpenseComment;
use Cavi\LotDescription;
use Cavi\ExpenseCommentFile;
use Cavi\Notifications\ExpenseReceipient;
use Cavi\Notifications\ExpenseApproval;
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

        // dd($exp_inbox->toArray());
        // return response()->json($exp_inbox->toArray(), 200);

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
            if ($exp->ApproverID == 0) {
                // send meo to recipients
                $exp->ApprovedFlag = true;
                $exp->NotifyFlag   = true;
                $exp->save();
                DB::commit();
                Notification::send($recipients->all(), new ExpenseReceipient($exp));
                return redirect()->route('expense_management.index')->with('success', 'Expense has been sent to recipients successfully');
            } else {
                $exp->NotifyFlag = true;
                if ($exp->save()) {
                    // TODO: send notification here
                    $next_approver = $exp->ApproverID != 0 ? Staff::where('UserID', $exp->ApproverID)->first()->user : null;
                    if (!is_null($next_approver)) {
                        Notification::send($next_approver, new ExpenseApproval($exp));
                    }
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
        return view('expense_management.create', compact('request_list', 'employees', 'debit_acct_details', 'lot_descriptions'));
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
        $employees          = User::all();
        $employees          = $employees->transform(function ($item, $key) {
            $item->name = $item->Fullname;
            return $item;
        });
        $request_types = RequestType::all();
        return view('expense_management.edit', compact('expense_management', 'employees', 'request_types'));
    }

    public function approve(Request $request)
    {

        // $ApprovedDate = $request->ApprovedDate;
        $SelectedID                           = collect($request->ExpenseManagementRef);
        $ApproverID                           = auth()->user()->id;
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
                    "EXEC procApproveExpenseRequest   '$value', $ModuleID, '$Comment', $ApproverID, $ApprovedFlag"
                );
                // $exp                             = ExpenseManagement::find($value);
                // $users_approver_roles            = User::where('ApproverRoleIDs', '<>', null);
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

    public function authorize_expense()
    {
        return view('expense_management.authorize_expense');
    }
}
