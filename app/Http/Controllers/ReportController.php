<?php

namespace MESL\Http\Controllers;

use MESL\AccountGroup;
use MESL\AccountCategory;
use MESL\AccountType;
use MESL\TransactionEntry;
use MESL\Document;
use MESL\GL;
use DB;
use Carbon\Carbon;
use Auth;
use MESL\Config;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function balance_sheet()
    {
        // $categories = AccountCategory::whereIn('AccountCategoryRef', ['1', '2', '6'])->orderBy('AccountCategory')->get();
        if (empty($_GET['to'])) {
            $today = date('Y-m-d');
            $bs    = collect(DB::select("exec procBalanceSheet '$today'"));
        } else {
            $date = $_GET['to'];
            $bs   = collect(DB::select("exec procBalanceSheet '$date'"));
        }
        // dd($bs);

        return view('reports.balance_sheet3', compact('bs', 'date'));
    }

    public function balance_sheet2()
    {
        if (!empty($_GET['from'])) {
            $from = $_GET['from'];
        }

        if (!empty($_GET['to'])) {
            $to = $_GET['to'];
        }

        $categories = AccountCategory::whereIn('AccountCategoryRef', ['1', '2', '6'])->orderBy('AccountCategory')->get();
        return view('reports.balance_sheet2', compact('categories', 'from', 'to'));
    }

    public function balance_sheet_vce()
    {
        $config = Config::where('ConfigRef', '1')->first();
        if (empty($_GET['date'])) {
            $date = date('Y-m-d');
        } else {
            $date = $_GET['date'];
        }

        $data      = collect(\DB::select("exec procBalanceSheet '$date'"));
        $fixed     = $data->where('AccountCategory', 'Fixed Assets')->first();
        $debtors   = $data->where('AccountCategory', 'Debtors & Prepayments')->first();
        $cash      = $data->where('AccountCategory', 'Cash & Bank')->first();
        $creditors = $data->where('AccountCategory', 'Creditors & Accruals')->first();
        $tax       = $data->where('AccountCategory', 'Tax Provision')->first();
        $capital   = $data->where('AccountCategory', 'Share Capital')->first();
        $reserves  = $data->where('AccountCategory', 'Reserves')->first();
        $directors = $data->where('AccountCategory', 'Directors Current Account')->first();

        $current_assets = ($debtors->Amount ?? '0') + ($cash->Amount ?? '0');
        $amount_falling = ($creditors->Amount ?? '0') + ($tax->Amount ?? '0');
        $net_current    = $current_assets - $amount_falling;
        $shareholders   = ($capital->Amount ?? '0') + ($reserves->Amount ?? '0') + ($directors->Amount ?? '0');

        // dd($data);
        return view('reports.balance_sheet_vce', compact('config', 'data', 'fixed', 'debtors', 'cash', 'creditors', 'tax', 'capital', 'reserves', 'directors', 'current_assets', 'amount_falling', 'net_current', 'shareholders', 'date'));
    }

    public function bsdetails($ref, $to)
    {
        $data     = collect(\DB::select("exec procBSDetails '$to', '$ref'"));
        $category = AccountCategory::where('AccountCategoryRef', $ref)->first();
        // dd($data);
        return view('reports.bsdetails', compact('data', 'date', 'category'));
    }

    public function pldetails($ref, $to)
    {
        $data     = collect(\DB::select("exec procPLDetails '$to', '$ref'"));
        $category = AccountCategory::where('AccountCategoryRef', $ref)->first();
        // dd($data);
        return view('reports.pldetails', compact('data', 'date', 'category'));
    }

    public function profit_loss_vce()
    {
        $config = Config::where('ConfigRef', '1')->first();
        if (empty($_GET['from']) && empty($_GET['to'])) {
            $from = date('Y-m-d', strtotime("3 months ago"));
            $to   = date('Y-m-d');
        } else {
            $from = $_GET['from'];
            $to   = $_GET['to'];
        }

        $data      = collect(\DB::select("exec procProfitandLoss '$from', '$to'"));
        $fee       = $data->where('AccountCategory', 'Fee Income')->first();
        $other     = $data->where('AccountCategory', 'Other Income')->first();
        $cost      = $data->where('AccountCategory', 'Cost of Sales')->first();
        $expense   = $data->where('AccountCategory', 'Operating Expense')->first();
        $provision = $data->where('AccountCategory', 'Provision for Taxes')->first();
        $reserve   = $data->where('AccountCategory', 'Transfer to Reserve')->first();

        $fee_other    = ($fee->Amount ?? '0') + ($other->Amount ?? '0');
        $gross_profit = $fee_other - ($cost->Amount ?? '0');
        $before_tax   = $gross_profit - ($expense->Amount ?? '0');
        $after_tax    = $before_tax - ($provision->Amount ?? '0');

        return view('reports.profit_loss_vce', compact('config', 'data', 'fee', 'other', 'cost', 'expense', 'provision', 'reserve', 'fee_other', 'gross_profit', 'before_tax', 'after_tax', 'from', 'to'));
    }

    public function accounting_period(Request $request)
    {
        $config            = Config::where('ConfigRef', '1')->first();
        $config->YearStart = $request->YearStart;
        $config->YearEnd   = $request->YearEnd;
        $config->save();
        return redirect()->back()->with('success', 'Accounting period saved successfully');
    }

    public function trial_balance()
    {

        $categories = AccountCategory::whereIn('AccountCategoryRef', ['1', '2', '3', '4', '5'])->orderBy('AccountCategory')->get();
        return view('reports.trial_balance', compact('categories'));
    }

    public function trial_balance2()
    {
        if (!empty($_GET['from'])) {
            $from = $_GET['from'];
        }

        if (!empty($_GET['to'])) {
            $to = $_GET['to'];
        }

        $categories = AccountCategory::whereIn('AccountCategoryRef', ['1', '2', '3', '4', '5'])->orderBy('AccountCategory')->get();
        return view('reports.trial_balance2', compact('categories', 'from', 'to'));
    }

    public function trial_balance3()
    {
        $config = Config::where('ConfigRef', '1')->first();
        if (!empty($_GET['from'])) {
            $from = $_GET['from'];
        } else {
            $from = $config->YearStart;
        }

        if (!empty($_GET['to'])) {
            $to = $_GET['to'];
        } else {
            $to = date('Y-m-d');
        }

        $tbs = collect(DB::select("exec procTrialBalance '$from', '$to'"));
        // dd($tbs);
        return view('reports.trial_balance3', compact('tbs', 'date'));
    }

    public function savings()
    {
        $accounts = collect(DB::select("exec procSavingsAccounts"));
// dd($accounts);
        return view('reports.savings', compact('accounts'));
    }

    public function profit_loss()
    {
        // $categories = AccountCategory::whereIn('AccountCategoryRef', ['4', '3'])->orderBy('AccountCategory', 'desc')->get();
        // $income_groups = AccountGroup::where('AccountCategoryID', '4')->get();
        // $expense_groups = AccountGroup::where('AccountCategoryID', '3')->get();

        if (!empty($_GET['from']) && !empty($_GET['to'])) {
            $from = $_GET['from'];
            $to   = $_GET['to'];
            $pls  = collect(DB::select("exec procPL '$from', '$to'"));
        } else {
            $config = Config::where('ConfigRef', '1')->first();
            $today  = date('Y-m-d');
            $pls    = collect(DB::select("exec procPL '$config->YearStart', '$today'"));
        }

        return view('reports.profit_loss3', compact('pls', 'from', 'to'));
    }

    public function profit_loss2()
    {
        if (!empty($_GET['from'])) {
            $from = $_GET['from'];
        }

        if (!empty($_GET['to'])) {
            $to = $_GET['to'];
        }

        $today = date('Y-m-d');

        $categories = AccountCategory::whereIn('AccountCategoryRef', ['4', '3'])->orderBy('AccountCategory', 'desc')->get();

        if (empty($_GET['from']) && empty($_GET['to'])) {
            $totalPL = collect(DB::select("exec procPLTotal '2015-01-01', '$today'"))->first()->RetainedPL;
        } else {
            $totalPL = collect(DB::select("exec procPLTotal '$from', '$to'"))->first()->RetainedPL;
        }

        return view('reports.profit_loss2', compact('categories', 'from', 'to', 'totalPL'));
    }

    public function profit_loss3()
    {
        if (!empty($_GET['from']) && !empty($_GET['to'])) {
            $from = $_GET['from'];
            $to   = $_GET['to'];
            $pls  = collect(DB::select("exec procPL '$from', '$to'"));
        } else {
            $today = date('Y-m-d');
            $pls   = collect(DB::select("exec procPL '2005-01-01', '$today'"));
        }

        // dd($pls);
        return view('reports.profit_loss3', compact('pls', 'from', 'to'));
    }

    public function loans_report()
    {
        $categories = AccountCategory::whereIn('AccountCategoryRef', ['1', '2', '6'])->orderBy('AccountCategory')->get();
        $loan_group = AccountGroup::where('id', '9')->first();
        return view('reports.loans_report', compact('categories', 'loan_group'));
    }

    public function matured_loans()
    {
        $types = AccountType::whereIn('AccountTypeRef', ['2', '106', '107', '108'])->get();

        if (!empty($_GET['type'])) {
            $get_type = $_GET['type'];
        }

        if (empty($_GET['type'])) {
            $accounts = GL::whereIn('AccountTypeID', ['2', '106', '107', '108'])->whereDate('LoanMaturityDate', '<=', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
        } elseif ($_GET['type'] == '2') {
            $accounts = GL::where('AccountTypeID', '2')->whereDate('LoanMaturityDate', '<=', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
        } elseif ($_GET['type'] == '106') {
            $accounts = GL::where('AccountTypeID', '106')->whereDate('LoanMaturityDate', '<=', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
        } elseif ($_GET['type'] == '107') {
            $accounts = GL::where('AccountTypeID', '107')->whereDate('LoanMaturityDate', '<=', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
        } elseif ($_GET['type'] == '108') {
            $accounts = GL::where('AccountTypeID', '108')->whereDate('LoanMaturityDate', '<=', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
        }
        foreach ($accounts as $account) {
            // $MatY = date('Y', strtotime($account->LoanMaturityDate));
            // $MatM = date('m', strtotime($account->LoanMaturityDate));
            // $MatD = date('d', strtotime($account->LoanMaturityDate));
            $account->LoanMaturityDays = Carbon::parse($account->LoanMaturityDate)->diffInDays(Carbon::now());
            $account->Outstanding      = number_format($account->LoanAmount + ($account->ClearedBalance));

            // $account->LoanDate = date('jS M, Y', strtotime($account->LoanDate));
            // $account->LoanMaturityDate = date('jS M, Y', strtotime($account->LoanMaturityDate));
        }
        return view('reports.matured_loans', compact('accounts', 'types', 'get_type'));
    }

    public function outstanding_loans()
    {
        $types = AccountType::whereIn('AccountTypeRef', ['2', '106', '107', '108'])->get();

        if (!empty($_GET['type'])) {
            $get_type = $_GET['type'];
        }

        if (empty($_GET['type'])) {
            $accounts = GL::whereIn('AccountTypeID', ['2', '106', '107', '108'])->whereDate('LoanMaturityDate', '>', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
        } elseif ($_GET['type'] == '2') {
            $accounts = GL::where('AccountTypeID', '2')->whereDate('LoanMaturityDate', '>', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
        } elseif ($_GET['type'] == '106') {
            $accounts = GL::where('AccountTypeID', '106')->whereDate('LoanMaturityDate', '>', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
        } elseif ($_GET['type'] == '107') {
            $accounts = GL::where('AccountTypeID', '107')->whereDate('LoanMaturityDate', '>', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
        } elseif ($_GET['type'] == '108') {
            $accounts = GL::where('AccountTypeID', '108')->whereDate('LoanMaturityDate', '>', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
        }

        foreach ($accounts as $account) {
            // $account->LoanDateDays
            $account->LoanMaturityDays = Carbon::parse($account->LoanMaturityDate)->diffInDays(Carbon::now());
            $account->Outstanding      = number_format($account->LoanAmount + ($account->ClearedBalance));
        }
        return view('reports.outstanding_loans', compact('accounts', 'types', 'get_type'));
    }

    public function endofday()
    {
        return view('reports.endofday');
    }

    public function run_endofday()
    {
        DB::statement("EXEC procEOD");
        return redirect()->back()->with('success', 'End of Day was successfully executed.');
    }

    public function loan_status()
    {
        $start = '2000-01-01';
        $end   = date('Y-m-d');

        if (!empty($_GET['from'])) {
            $from = $_GET['from'];
        }

        if (!empty($_GET['to'])) {
            $to = $_GET['to'];
        }

        if (!empty($from) && !empty($to)) {
            $loans = collect(DB::select("exec procLoanScheduleStatus '$from', '$to'"));
        } else {
            $loans = collect(DB::select("exec procLoanScheduleStatus '$start', '$end'"));
        }

        return view('reports.loan_schedule_status', compact('loans', 'from', 'to'));
    }

    public function loan_pretermination()
    {
        $types = AccountType::whereIn('AccountTypeRef', ['2', '106', '107', '108'])->get();

        if (!empty($_GET['type'])) {
            $get_type = $_GET['type'];
        }

        if (empty($_GET['type'])) {
            $accounts = GL::whereIn('AccountTypeID', ['2', '106', '107', '108'])->whereDate('LoanMaturityDate', '>', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
        } elseif ($_GET['type'] == '2') {
            $accounts = GL::where('AccountTypeID', '2')->whereDate('LoanMaturityDate', '>', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
        } elseif ($_GET['type'] == '106') {
            $accounts = GL::where('AccountTypeID', '106')->whereDate('LoanMaturityDate', '>', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
        } elseif ($_GET['type'] == '107') {
            $accounts = GL::where('AccountTypeID', '107')->whereDate('LoanMaturityDate', '>', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
        } elseif ($_GET['type'] == '108') {
            $accounts = GL::where('AccountTypeID', '108')->whereDate('LoanMaturityDate', '>', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
        }

        foreach ($accounts as $account) {
            // $account->LoanDateDays
            $account->LoanMaturityDays = Carbon::parse($account->LoanMaturityDate)->diffInDays(Carbon::now());
            $account->Outstanding      = number_format($account->LoanAmount + ($account->ClearedBalance));
        }
        return view('reports.loan_pretermination', compact('accounts', 'types', 'get_type'));
    }

    public function preterminate(Request $request, $id)
    {
        $user = Auth::user();
        // Fetch loan GL account
        $loan = GL::where('GLRef', $id)->first();

        $trans                  = new TransactionEntry;
        $trans->PostingTypeID   = '1';
        $trans->GLIDDebit       = $loan->BeneficiaryGLID;
        $trans->GLIDCredit      = $id;
        $trans->PostDate        = date('Y-m-d');
        $trans->ValueDate       = date('Y-m-d');
        $trans->CurrencyID      = '1';
        $trans->Amount          = $request->amount;
        $trans->Narration       = 'Loan Pre-termination';
        $trans->InputterID      = $user->id;
        $trans->TransactionCode = 'Loan' . rand(00000, 99999);
        $trans->save();

        return redirect()->back()->with('success', 'The loan was terminated successfully');

    }

    public function cash_flow(Request $request)
    {
        if (empty($_GET['from']) && empty($_GET['to'])) {
            $from = date('Y-m-d', strtotime("3 months ago"));
            $to   = date('Y-m-d');
        } else {
            $from = $_GET['from'];
            $to   = $_GET['to'];
        }
        $cash_flows = collect(DB::select("exec procCashFlow '$from', '$to'"));
        return view('reports.cash_flow', compact('cash_flows', 'from', 'to'));
    }

    public function outstanding_bills(Request $request)
    {
        $outstanding_bills = collect(DB::select("exec procFinalBillAmountAll "));
        return view('reports.outstanding_bills', compact('outstanding_bills'));
    }

    public function outstanding_vendor_bills(Request $request)
    {
        $outstanding_bills = collect(DB::select("exec procFinalBillAmount_Vendor_All"));
        return view('reports.outstanding_vendor_bills', compact('outstanding_bills'));
    }

    public function fetchOutstandingBillsForCode(Request $request)
    {
        $bill_code         = $request->bill_code;
        $outstanding_bills = collect(DB::select("exec procFinalBillAmount '$bill_code'"));
        return response()->json(['sucess' => true, 'data' => ($outstanding_bills)], 200);
    }

    public function fetchOutstandingVendorBillsForCode(Request $request)
    {
        $bill_code         = $request->bill_code;
        $outstanding_bills = collect(DB::select("exec procFinalBillAmount_Vendor '$bill_code'"));
        return response()->json(['sucess' => true, 'data' => ($outstanding_bills)], 200);
    }

    public function fetchTransactionDetailsForCode(Request $request)
    {
        $transaction_ref     = $request->ref;
        $transaction_details = collect(DB::select("exec procTransactionDetails '$transaction_ref'"));
        return response()->json(['success' => true, 'data' => $transaction_details], 200);
    }

    // MD's Dashboard
    public function plant_report()
    {

        $config = Config::where('ConfigRef', '1')->first();
        if (!empty($_GET['from'])) {
            $from = $_GET['from'];
        } else {
            $from = $config->YearStart;
        }

        if (!empty($_GET['to'])) {
            $to = $_GET['to'];
        } else {
            $to = date('Y-m-d');
        }

        $user = auth()->user();
        $docs = Document::where('ApprovedFlag', '1')->where('NotifyFlag', '1')
            ->join('tblDocType', 'tblDocMgt.DocTypeID', '=', 'tblDocType.DocTypeRef')
            ->where('tblDocType.DocCategoryID', 1)
            ->where('DocTypeRef', 17) // plant
            ->whereBetween('ReportDate', [$from, $to])
            ->orderBy('DocRef', 'desc')
            ->get();
        return view('reports.md.mgmt.plant_report', compact('docs'));
    }
    public function account_finance_scorecard()
    {
        $config = Config::where('ConfigRef', '1')->first();
        if (!empty($_GET['from'])) {
            $from = $_GET['from'];
        } else {
            $from = $config->YearStart;
        }

        if (!empty($_GET['to'])) {
            $to = $_GET['to'];
        } else {
            $to = date('Y-m-d');
        }

        $user = auth()->user();
        $docs = Document::where('ApprovedFlag', '1')->where('NotifyFlag', '1')
            ->join('tblDocType', 'tblDocMgt.DocTypeID', '=', 'tblDocType.DocTypeRef')
            ->where('tblDocType.DocCategoryID', 1)
            ->where('DocTypeRef', 18) // plant
            ->whereBetween('ReportDate', [$from, $to])
            ->orderBy('DocRef', 'desc')
            ->get();
        return view('reports.md.mgmt.account_finance_scorecard', compact('docs'));
    }
    public function admin_report()
    {
        $config = Config::where('ConfigRef', '1')->first();
        if (!empty($_GET['from'])) {
            $from = $_GET['from'];
        } else {
            $from = $config->YearStart;
        }

        if (!empty($_GET['to'])) {
            $to = $_GET['to'];
        } else {
            $to = date('Y-m-d');
        }

        $user = auth()->user();
        $docs = Document::where('ApprovedFlag', '1')->where('NotifyFlag', '1')
            ->join('tblDocType', 'tblDocMgt.DocTypeID', '=', 'tblDocType.DocTypeRef')
            ->where('tblDocType.DocCategoryID', 1)
            ->where('DocTypeRef', 19) // plant
            ->whereBetween('ReportDate', [$from, $to])
            ->orderBy('DocRef', 'desc')
            ->get();
        return view('reports.md.mgmt.admin_report', compact('docs'));
    }
    public function procurement_report()
    {
        $config = Config::where('ConfigRef', '1')->first();
        if (!empty($_GET['from'])) {
            $from = $_GET['from'];
        } else {
            $from = $config->YearStart;
        }

        if (!empty($_GET['to'])) {
            $to = $_GET['to'];
        } else {
            $to = date('Y-m-d');
        }

        $user = auth()->user();
        $docs = Document::where('ApprovedFlag', '1')->where('NotifyFlag', '1')
            ->join('tblDocType', 'tblDocMgt.DocTypeID', '=', 'tblDocType.DocTypeRef')
            ->where('tblDocType.DocCategoryID', 1)
            ->where('DocTypeRef', 20) // plant
            ->whereBetween('ReportDate', [$from, $to])
            ->orderBy('DocRef', 'desc')
            ->get();
        return view('reports.md.mgmt.procurement_report', compact('docs'));
    }
    public function ict_report()
    {
        $config = Config::where('ConfigRef', '1')->first();
        if (!empty($_GET['from'])) {
            $from = $_GET['from'];
        } else {
            $from = $config->YearStart;
        }

        if (!empty($_GET['to'])) {
            $to = $_GET['to'];
        } else {
            $to = date('Y-m-d');
        }

        $user = auth()->user();
        $docs = Document::where('ApprovedFlag', '1')->where('NotifyFlag', '1')
            ->join('tblDocType', 'tblDocMgt.DocTypeID', '=', 'tblDocType.DocTypeRef')
            ->where('tblDocType.DocCategoryID', 1)
            ->where('DocTypeRef', 21) // plant
            ->whereBetween('ReportDate', [$from, $to])
            ->orderBy('DocRef', 'desc')
            ->get();
        return view('reports.md.mgmt.ict_report', compact('docs'));
    }
    public function business_risk_control_report()
    {
        $config = Config::where('ConfigRef', '1')->first();
        if (!empty($_GET['from'])) {
            $from = $_GET['from'];
        } else {
            $from = $config->YearStart;
        }

        if (!empty($_GET['to'])) {
            $to = $_GET['to'];
        } else {
            $to = date('Y-m-d');
        }

        $user = auth()->user();
        $docs = Document::where('ApprovedFlag', '1')->where('NotifyFlag', '1')
            ->join('tblDocType', 'tblDocMgt.DocTypeID', '=', 'tblDocType.DocTypeRef')
            ->where('tblDocType.DocCategoryID', 1)
            ->where('DocTypeRef', 22) // plant
            ->whereBetween('ReportDate', [$from, $to])
            ->orderBy('DocRef', 'desc')
            ->get();
        return view('reports.md.mgmt.business_risk_control_report', compact('docs'));
    }

}
