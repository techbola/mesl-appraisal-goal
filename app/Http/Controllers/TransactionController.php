<?php
namespace Cavidel\Http\Controllers;

use Cavidel\Customer;
use Cavidel\GL;
use Cavidel\PostingType;
use Cavidel\Transaction;
use Cavidel\TransactionMP;
use Cavidel\TransactionType;
use Illuminate\Http\Request;
use Cavidel\AccountType;
use Cavidel\Staff;
use Auth;
use DB;

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
        $user = Auth::user();
        // dd($request->all());

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
                $row->Amount            = $request->amount[$key];
                $row->GLID              = $request->account[$key];
                $row->PostDate          = $request->post_date[$key];
                $row->ValueDate         = $request->value_date[$key];
                $row->Narration         = $request->narration[$key];
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
        $unapproved_transaction = TransactionMP::where('ApprovedFlag', 0)
            ->groupBy(['AlphaCode', 'PostDate', 'ValueDate', 'Amount'])
            ->having('Amount', '>', 0)
            ->select('AlphaCode', 'PostDate', 'ValueDate', 'Amount')->get();
        $approved_transaction = TransactionMP::where('ApprovedFlag', 1)
            ->groupBy(['AlphaCode', 'PostDate'])
            ->select('AlphaCode', 'PostDate')->get();

        return view('transactions.mp_approvallist', compact('unapproved_transaction', 'approved_transaction'));
    }

    public function multipost_approve(Request $request)
    {
        $refs = $request->TransactionRef;
        
        foreach ($refs as $key => $ref) {
            $transaction = TransactionMP::where('AlphaCode', $ref);
            $transaction->update(['ApprovedFlag' => 1, 'PostFlag' => 1]);
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

}
