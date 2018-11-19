<?php
namespace Cavi\Http\Controllers;

use Cavi\Customer;
use Cavi\GL;
use Cavi\PostingType;
use Cavi\Transaction;
use Cavi\TransactionMP;
use Cavi\TransactionType;
use Illuminate\Http\Request;
use Cavi\AccountType;
use Cavi\Staff;
use Auth;
use DB;
use Cavi\Rules\ValidateValueDateYear;

class TransactionController extends Controller
{

    public function index()
    {
        $gls = \DB::select('SELECT GLRef, CustomerID, Customer FROM tblGl Join tblCustomer ON tblGl.CustomerID = tblCustomer.CustomerRef
            where  tblGl.AccountTypeID = 1
            Group by CustomerID, Customer,GLRef');
        return view('transactions.index', compact('gls'));
    }

    public function BankDetails()
    {
        $gls = \DB::select("SELECT tblGL.GLRef, tblCustomer.Customer, tblAccountType.AccountType, tblGL.Description,CONCAT(tblAccountType.AccountType,tblGL.Description) AS CUST_ACCT
            FROM tblGL INNER JOIN tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef
            INNER JOIN tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef
            WHERE (tblGL.CustomerID = 195)");
        return view('transactions.viewcompanies', compact('gls'));
    }

    public function TransactionList()
    {
        $trans = \DB::select("EXEC procTransactionsList");
        return view('transactions.transactionlist', compact('trans'));
    }

    public function TransactionListRange(Request $request)
    {
        $StartDate = $request->StartDate;
        $EndDate   = $request->EndDate;
        $trans     = \DB::select("EXEC procTransactionsListRange '$StartDate', '$EndDate' ");
        return view('transactions.transactionlistrange', compact('trans'));
    }

    public function create()
    {
        $gls               = GL::all();
        $posting_types     = PostingType::all();
        $transactions      = Transaction::all();
        $transaction_types = TransactionType::all();
        return view('transactions.create', compact('transactions', 'gls', 'posting_types', 'transaction_types'));
    }

    public function transactionrange()
    {
        $customer_details = \DB::table('tblGL')
            ->select('GLRef', 'tblGL.Description as des', \DB::raw('CONCAT("Customer", \' - \' ,"AccountType", \' - \',"AccountNo", \' - \',"BookBalance") AS CUST_ACCT'))
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->leftJoin('tblAccountType', 'tblGL.AccountTypeID', '=', 'tblAccountType.AccountTypeRef')
            ->leftJoin('tblCurrency', 'tblGL.CurrencyID', '=', 'tblCurrency.CurrencyRef')
            ->leftJoin('tblBranch', 'tblGL.BranchID', '=', 'tblBranch.BranchRef')
            ->get();
        return view('transactions.transactionrange', compact('customer_details'));
    }

    public function printStatement(Request $request)
    {
        $StartDate  = $request->StartDate;
        $EndDate    = $request->EndDate;
        $GLRef      = $request->GLRef;
        $trans      = \DB::select("EXEC procStatementDetailsDateRange $GLRef, '$StartDate', '$EndDate' ");
        $statements = \DB::select("EXEC procViewBalances $GLRef");
        return view('transactions.statement', compact('trans', 'statements'));
    }

    public function store(Request $request)
    {
        $transaction = new Transaction($request->all());
        $this->validate($request, [
            'Amount' => 'required',
        ]);
        if ($transaction->save()) {
            return redirect()->route('transactions.create')->with('success', 'Transaction was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Transaction failed to save');
        }
    }

    public function show($id)
    {
        $gls = Transaction::where('GLID', $id)->first();
        if (!empty($gls)) {
            $trans = \DB::select("EXEC procViewBalances $gls->GLID");
        }

        $gls = Transaction::where('GLID', $id)->first();
        if (!empty($gls)) {
            $statements = \DB::select("EXEC procStatementDetails $gls->GLID");
        }
        return view('transactions.show', compact('trans', 'details', 'statements'));
    }

    public function showDetails()
    {
        $accounts = AccountType::all();
        return view('transactions.showdetails', compact('accounts'));
    }

    public function show_searched_result(Request $request)
    {
        $accounts   = AccountType::all();
        $account_id = $request->AccountType;
        $statements = \DB::select("EXEC procViewBalancesAll $account_id");
        return view('transactions.show_searched_result', compact('statements', 'accounts'));
    }

    public function all_transactions(Request $request)
    {
        $accounts   = AccountType::all();
        $statements = collect(\DB::select("EXEC procViewBalancesAllExtended "))->transform(function ($item, $key) {
            $item->Debit  = is_null($item->Debit) ? 0 : $item->Debit;
            $item->Credit = is_null($item->Credit) ? 0 : $item->Credit;
            return $item;
        });
        // return response()->json($statements, 200);
        return view('transactions.show_all_transactions', compact('statements', 'accounts'));
    }

    public function edit($id)
    {
        $gls               = GL::all();
        $posting_types     = PostingType::all();
        $transaction       = Transaction::where('TransactionRef', $id)->first();
        $transaction_types = DB::table('tblTransaction')
            ->join('tblPostingType', 'tblTransaction.PostingTypeID', '=', 'tblPostingType.PostingTypeRef')
            ->join('tblGL', 'tblTransaction.GLID', '=', 'tblGL.GLRef')
            ->get();
        // return dd($TradeRef);
        return view('transactions.edit', compact('transaction', 'gls', 'posting_types', 'transaction_types'));
    }

    public function update(Request $request, $id)
    {
        $transaction = \DB::table('tblTransaction')->where('TransactionRef', $id);
        if ($transaction->update($request->except(['_token', '_method']))) {
            return redirect()->route('transactions.create')->with('success', 'Transaction was updated successfully');
        } else {
            return back()->withInput()->with('error', 'Transaction failed to update');
        }
    }

    public function multipost()
    {
        $gls       = GL::all();
        $all_staff = Staff::all();
        $accounts  = collect(DB::select("EXEC ProcAccountNames"));
        // dd($accounts);
        return view('transactions.multipost', compact('gls', 'accounts', 'all_staff'));
    }

    public function multipost_store(Request $request)
    {
        // validation for value date

        // $validator = \Validator::make($request->all(), [
        //     'GLIDDebit'  => "required",
        //     'GLIDCredit' => "required",
        //     'Amount'     => 'required',
        // ], [
        //     'GLIDDebit.required'  => 'Account to Debit not selected',
        //     'GLIDCredit.required' => 'Account to Credit not selected',
        // ]);
        // if ($validator->fails()) {
        //     return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        // }

        $user       = Auth::user();
        $sum_debit  = '0';
        $sum_credit = '0';

        foreach ($request->type as $key => $type) {

            if ($type == '3') {
                $sum_debit += $request->amount[$key];
            } elseif ($type == '4') {
                $sum_credit += $request->amount[$key];
            }

        }

        // dd($sum_credit.' = '.$sum_debit);

        if ($sum_debit != $sum_credit) {
            return redirect()->back()->withInput()->with('error', 'Debit amount is not equal to credit amount. Please check the input amounts and try again.');
        } else {
            $code = uniqid('MP-') . '-' . time();
            foreach ($request->type as $key => $type) {
                // dd($request->amount[$key]);
                $row                    = new TransactionMP;
                $row->AlphaCode         = $code;
                $row->TransactionTypeID = $type;
                if (!empty($request->amount[$key])) {
                    $row->Amount = $request->amount[$key];
                }
                if (!empty($request->account[$key])) {
                    $row->GLID = $request->account[$key];
                }
                if (!empty($request->post_date[$key])) {
                    $row->PostDate = $request->post_date[$key];
                }
                if (!empty($request->value_date[$key])) {
                    $row->ValueDate = $request->value_date[$key];
                }
                if (!empty($request->narration[$key])) {
                    $row->Narration = $request->narration[$key];
                }
                // $row->BankSlipNo = $request->slip_no[$key];
                // $row->StaffID = $request->staff[$key];
                $row->InputterID      = $user->id;
                $row->TransactionCode = 'Deposit' . uniqid();
                $row->CurrencyID      = '1';
                $row->PostingTypeID   = '1';
                $row->save();
            }
            return redirect()->back()->with('success', 'Transactions posted successfully.');
        }
    }

    public function multipost_listing()
    {
        // 4 Credit
        // 3 debit
        $unsent_transaction = TransactionMP::where('ApprovedFlag', 0)
        // ->groupBy(['AlphaCode', 'PostDate', 'ValueDate', 'Amount'])
            ->select('AlphaCode', 'PostDate', 'ValueDate', 'Amount', 'Narration', 'TransactionTypeID', 'GLID')
            ->where('NotifyFlag', 0)
            ->orderBy('AlphaCode')

            ->get();
        $unapproved_transaction = TransactionMP::where('ApprovedFlag', 0)
        // ->groupBy(['AlphaCode', 'PostDate', 'ValueDate', 'Amount'])
            ->select('AlphaCode', 'PostDate', 'ValueDate', 'Amount', 'Narration', 'TransactionTypeID', 'GLID')
            ->where('NotifyFlag', 1)
            ->orderBy('AlphaCode')

            ->get();
        $approved_transaction = TransactionMP::where('ApprovedFlag', 1)
        // ->groupBy(['AlphaCode', 'PostDate', 'ValueDate', 'Amount'])
            ->where('NotifyFlag', 1)
            ->select('AlphaCode', 'PostDate', 'ValueDate', 'Amount', 'Narration', 'TransactionTypeID', 'GLID')
            ->orderBy('AlphaCode')
            ->get();

        $posted_transaction = TransactionMP::where('ApprovedFlag', 1)
        // ->groupBy(['AlphaCode', 'PostDate', 'ValueDate', 'Amount'])
            ->where('NotifyFlag', 1)
            ->where('PostFlag', 1)
            ->select('AlphaCode', 'PostDate', 'ValueDate', 'Amount', 'Narration', 'TransactionTypeID', 'GLID')
            ->orderBy('AlphaCode')
            ->get();

        return view('transactions.mp_approvallist', compact('unapproved_transaction', 'unsent_transaction', 'approved_transaction'));
    }

    // send multi post for approval
    public function multipost_send(Request $request)
    {
        $ref = $request->AlphaCode;
        // return response()->json($refs);
        // foreach ($refs as $key => $ref) {
        $transaction = TransactionMP::where('AlphaCode', $ref);
        $transaction->update(['NotifyFlag' => 1]);
        // }
        return response()->json(['success' => true, 'message' => str_plural('Transaction', count($ref))]);
    }

    public function multipost_detail($alpha_code)
    {
        $transactions = TransactionMP::where('AlphaCode', $alpha_code)->get();
        return response()->json(['success' => true, 'message', 'transactions' => $transactions]);
    }

    public function multipost_update(Request $request, $alpha_code)
    {

    }

    public function multipost_approve(Request $request)
    {
        $refs = $request->TransactionRef;

        foreach ($refs as $key => $ref) {
            $transaction = TransactionMP::where('AlphaCode', $ref);
            $transaction->update([
                'ApprovedFlag' => 1,
                'PostFlag'     => 1,
                'ApproverID'   => auth()->user()->id,
            ]);
        }
    }

    public function delete_batch(Request $request)
    {
        $refs = $request->AlphaCode;

        // foreach ($refs as $key => $ref) {
        $transaction = TransactionMP::where('AlphaCode', $refs);
        $transaction->delete();
        // }
        return response()->json(['success' => true, 'message' => 'Deleted Successfully']);
    }

    public function multipost_reject(Request $request)
    {
        $refs = $request->TransactionRef;
        foreach ($refs as $key => $ref) {
            $transaction = TransactionMP::where('AlphaCode', $ref);
            $transaction->update(['ApprovedFlag' => 0, 'PostFlag' => 0, 'NotifyFlag' => 0]);
        }
    }

    public function multipost_post(Request $request)
    {
        $refs = $request->TransactionRef;
        foreach ($refs as $key => $ref) {
            $transaction = TransactionMP::where('AlphaCode');
            $transaction->update(['PostFlag' => 1]);
        }
    }

    public function reversal_list()
    {
        $trans = collect(\DB::select("EXEC procTransactionsList"))->where('ReversedFlag', '<>', 1);
        return view('transactions.transactionlist_reversal', compact('trans'));
    }

    public function reversal_range(Request $request)
    {
        $StartDate = $request->StartDate;
        $EndDate   = $request->EndDate;
        $trans     = collect(\DB::select("EXEC procTransactionsListRange '$StartDate', '$EndDate' "))->where('ReversedFlag', '<>', 1);
        return view('transactions.transactionlistrange_reversal', compact('trans'));
    }

    public function reversal_post(Request $request)
    {
        $trans_code = $request->trans_code;
        $user_id    = auth()->user()->id;
        \DB::statement("EXEC procReversal $user_id, '$trans_code'");
        return response()->json(['success' => true], 200);
    }

}
