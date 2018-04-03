<?php

namespace App\Http\Controllers;

use App\AccountGroup;
use App\AccountCategory;
use App\AccountType;
use App\TransactionEntry;
use App\GL;
use DB;
use Carbon\Carbon;
use Auth;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function balance_sheet()
    {
      $categories = AccountCategory::whereIn('AccountCategoryRef', ['1', '2', '6'])->orderBy('AccountCategory')->get();
      return view('reports.balance_sheet', compact('categories'));
    }

    public function balance_sheet2()
    {
      if (!empty($_GET['from']))
        $from = $_GET['from'];
      if (!empty($_GET['to']))
        $to = $_GET['to'];

      $categories = AccountCategory::whereIn('AccountCategoryRef', ['1', '2', '6'])->orderBy('AccountCategory')->get();
      return view('reports.balance_sheet2', compact('categories', 'from', 'to'));
    }

    public function trial_balance()
    {

      $categories = AccountCategory::whereIn('AccountCategoryRef', ['1', '2', '3', '4', '5'])->orderBy('AccountCategory')->get();
      return view('reports.trial_balance', compact('categories'));
    }

    public function trial_balance2()
    {
      if (!empty($_GET['from']))
        $from = $_GET['from'];
      if (!empty($_GET['to']))
        $to = $_GET['to'];
      $categories = AccountCategory::whereIn('AccountCategoryRef', ['1', '2', '3', '4', '5'])->orderBy('AccountCategory')->get();
      return view('reports.trial_balance2', compact('categories', 'from', 'to'));
    }

    public function trial_balance3()
    {
      if (empty($_GET['date'])) {
        $today = date('Y-m-d');
        $tbs = collect(DB::select("exec procTrialBalance '$today'"));
      } else {
        $date = $_GET['date'];
        $tbs = collect(DB::select("exec procTrialBalance '$date'"));
      }
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
      $categories = AccountCategory::whereIn('AccountCategoryRef', ['4', '3'])->orderBy('AccountCategory', 'desc')->get();
      // $income_groups = AccountGroup::where('AccountCategoryID', '4')->get();
      // $expense_groups = AccountGroup::where('AccountCategoryID', '3')->get();
        return view('reports.profit_loss', compact('categories', 'from', 'to'));
    }

    public function profit_loss2()
    {
      if (!empty($_GET['from']))
        $from = $_GET['from'];

      if (!empty($_GET['to']))
        $to = $_GET['to'];

        $today = date('Y-m-d');


      $categories = AccountCategory::whereIn('AccountCategoryRef', ['4', '3'])->orderBy('AccountCategory', 'desc')->get();

      if (empty($_GET['from']) && empty($_GET['to']))
        $totalPL = collect(DB::select("exec procPLTotal '2015-01-01', '$today'"))->first()->RetainedPL;
      else
        $totalPL = collect(DB::select("exec procPLTotal '$from', '$to'"))->first()->RetainedPL;

      return view('reports.profit_loss2', compact('categories', 'from', 'to', 'totalPL'));
    }

    public function profit_loss3()
    {
      if (!empty($_GET['from']) && !empty($_GET['to'])) {
        $from = $_GET['from'];
        $to = $_GET['to'];
        $pls = collect(DB::select("exec procPL '$from', '$to'"));
      } else {
        $today = date('Y-m-d');
        $pls = collect(DB::select("exec procPL '2005-01-01', '$today'"));
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

    public function matured_loans(){
      $types = AccountType::whereIn('AccountTypeRef', ['2', '106', '107', '108'])->get();

      if (!empty($_GET['type']))
      $get_type = $_GET['type'];


      if (empty($_GET['type'])){
        $accounts = GL::whereIn('AccountTypeID', ['2', '106', '107','108'])->whereDate('LoanMaturityDate', '<=', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
      } elseif($_GET['type'] == '2') {
        $accounts = GL::where('AccountTypeID', '2')->whereDate('LoanMaturityDate', '<=', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
      } elseif($_GET['type'] == '106') {
        $accounts = GL::where('AccountTypeID', '106')->whereDate('LoanMaturityDate', '<=', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
      } elseif($_GET['type'] == '107') {
        $accounts = GL::where('AccountTypeID', '107')->whereDate('LoanMaturityDate', '<=', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
      } elseif($_GET['type'] == '108') {
        $accounts = GL::where('AccountTypeID', '108')->whereDate('LoanMaturityDate', '<=', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
      }
      foreach ($accounts as $account) {
        // $MatY = date('Y', strtotime($account->LoanMaturityDate));
        // $MatM = date('m', strtotime($account->LoanMaturityDate));
        // $MatD = date('d', strtotime($account->LoanMaturityDate));
        $account->LoanMaturityDays = Carbon::parse( $account->LoanMaturityDate )->diffInDays(Carbon::now());
        $account->Outstanding = number_format( $account->LoanAmount + ($account->ClearedBalance) );

        // $account->LoanDate = date('jS M, Y', strtotime($account->LoanDate));
        // $account->LoanMaturityDate = date('jS M, Y', strtotime($account->LoanMaturityDate));
      }
      return view('reports.matured_loans', compact('accounts', 'types', 'get_type'));
    }

    public function outstanding_loans(){
      $types = AccountType::whereIn('AccountTypeRef', ['2', '106', '107', '108'])->get();

      if (!empty($_GET['type']))
      $get_type = $_GET['type'];


      if (empty($_GET['type'])){
        $accounts = GL::whereIn('AccountTypeID', ['2','106','107', '108'])->whereDate('LoanMaturityDate', '>', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
      } elseif($_GET['type'] == '2') {
        $accounts = GL::where('AccountTypeID', '2')->whereDate('LoanMaturityDate', '>', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
      } elseif($_GET['type'] == '106') {
        $accounts = GL::where('AccountTypeID', '106')->whereDate('LoanMaturityDate', '>', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
      } elseif($_GET['type'] == '107') {
        $accounts = GL::where('AccountTypeID', '107')->whereDate('LoanMaturityDate', '>', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
      } elseif($_GET['type'] == '108') {
        $accounts = GL::where('AccountTypeID', '108')->whereDate('LoanMaturityDate', '>', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
      }

      foreach ($accounts as $account) {
        // $account->LoanDateDays
        $account->LoanMaturityDays = Carbon::parse( $account->LoanMaturityDate )->diffInDays(Carbon::now());
        $account->Outstanding = number_format( $account->LoanAmount + ($account->ClearedBalance) );
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
      $end = date('Y-m-d');

      if (!empty($_GET['from']))
        $from = $_GET['from'];
      if (!empty($_GET['to']))
        $to = $_GET['to'];

      if (!empty($from) && !empty($to)) {
        $loans = collect(DB::select("exec procLoanScheduleStatus '$from', '$to'"));
      } else {
        $loans = collect(DB::select("exec procLoanScheduleStatus '$start', '$end'"));
      }

      return view('reports.loan_schedule_status', compact('loans', 'from', 'to'));
    }

    public function loan_pretermination()
    {
      $types = AccountType::whereIn('AccountTypeRef', ['2', '106', '107','108'])->get();

      if (!empty($_GET['type']))
      $get_type = $_GET['type'];


      if (empty($_GET['type'])){
        $accounts = GL::whereIn('AccountTypeID', ['2','106','107','108'])->whereDate('LoanMaturityDate', '>', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
      } elseif($_GET['type'] == '2') {
        $accounts = GL::where('AccountTypeID', '2')->whereDate('LoanMaturityDate', '>', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
      } elseif($_GET['type'] == '106') {
        $accounts = GL::where('AccountTypeID', '106')->whereDate('LoanMaturityDate', '>', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
      } elseif($_GET['type'] == '107') {
        $accounts = GL::where('AccountTypeID', '107')->whereDate('LoanMaturityDate', '>', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
      } elseif($_GET['type'] == '108') {
        $accounts = GL::where('AccountTypeID', '108')->whereDate('LoanMaturityDate', '>', date("Y-m-d"))->where('ClearedBalance', '!=', '0')->get();
      }

      foreach ($accounts as $account) {
        // $account->LoanDateDays
        $account->LoanMaturityDays = Carbon::parse( $account->LoanMaturityDate )->diffInDays(Carbon::now());
        $account->Outstanding = number_format( $account->LoanAmount + ($account->ClearedBalance) );
      }
      return view('reports.loan_pretermination', compact('accounts', 'types', 'get_type'));
    }

    public function preterminate(Request $request, $id)
    {
      $user = Auth::user();
      // Fetch loan GL account
      $loan = GL::where('GLRef', $id)->first();

      $trans = new TransactionEntry;
      $trans->PostingTypeID = '1';
      $trans->GLIDDebit = $loan->BeneficiaryGLID;
      $trans->GLIDCredit = $id;
      $trans->PostDate = date('Y-m-d');
      $trans->ValueDate = date('Y-m-d');
      $trans->CurrencyID = '1';
      $trans->Amount = $request->amount;
      $trans->Narration = 'Loan Pre-termination';
      $trans->InputterID = $user->id;
      $trans->TransactionCode = 'Loan'.rand(00000, 99999);
      $trans->save();

      return redirect()->back()->with('success', 'The loan was terminated successfully');

    }

}
