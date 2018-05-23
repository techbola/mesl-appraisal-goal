<?php

namespace Cavidel\Http\Controllers;

use Cavidel\AccountType;
use Cavidel\Branch;
use Cavidel\Currency;
use Cavidel\Customer;
// use Cavidel\Frequency;
use Cavidel\GL;
// use Cavidel\LoanRePaymentType;
// use Cavidel\LoanStatus;
use Cavidel\Staff;
// use Cavidel\LoanType;
use Illuminate\Http\Request;

use DB;

class GLController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        return $this->middleware('auth');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers     = Customer::all();
        $branches      = Branch::all();
        $currencies    = Currency::all();
        $staff         = Staff::all();
        // $status        = LoanStatus::all();
        // $frequencies   = Frequency::all();
        $account_types = AccountType::all()->where('AccountTypeRef', '<>', 2);
        $gls           = \DB::table('tblGL')
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->leftJoin('tblAccountType', 'tblGL.AccountTypeID', '=', 'tblAccountType.AccountTypeRef')
            ->leftJoin('tblCurrency', 'tblGL.CurrencyID', '=', 'tblCurrency.CurrencyRef')
            ->leftJoin('tblBranch', 'tblGL.BranchID', '=', 'tblBranch.BranchRef')
            ->select('*', 'tblGL.Description as Desc')
            ->get();
        $customer_details = \DB::table('tblGL')
            ->select('GLRef', \DB::raw('CONCAT("Customer", \' - \' ,"AccountType", \' - \',"AccountNo") AS CUST_ACCT'))
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->leftJoin('tblAccountType', 'tblGL.AccountTypeID', '=', 'tblAccountType.AccountTypeRef')
            ->leftJoin('tblCurrency', 'tblGL.CurrencyID', '=', 'tblCurrency.CurrencyRef')
            ->leftJoin('tblBranch', 'tblGL.BranchID', '=', 'tblBranch.BranchRef')
            ->get();
        // return dd($currencies);
        return view('gls.create', compact('gls', 'branches', 'account_types', 'staff', 'status', 'frequencies', 'currencies', 'customers', 'customer_details'));
    }

    public function create2()
    {
        $loanrepaymenttype = LoanRePaymentType::all();

        $customers     = Customer::all();
        $branches      = Branch::all();
        $currencies    = Currency::all()->where('CurrencyRef', 1);
        $staff         = Staff::all();
        $status        = LoanStatus::all();
        $frequencies   = Frequency::all();
        $account_types = AccountType::all()->where('AccountTypeRef', 2);

        $gls = GL::where('AccountTypeID', '2')->orderBy('GLRef', 'DESC')->get();

        // $gls = \DB::table('tblGL')->where('tblGL.AccountTypeID', 2)
        //     ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
        //     ->leftJoin('tblAccountType', 'tblGL.AccountTypeID', '=', 'tblAccountType.AccountTypeRef')
        //     ->leftJoin('tblCurrency', 'tblGL.CurrencyID', '=', 'tblCurrency.CurrencyRef')
        //     ->leftJoin('tblBranch', 'tblGL.BranchID', '=', 'tblBranch.BranchRef')
        //     ->orderBy('GLRef', 'DESC')
        //     ->get();

        $customer_details = \DB::table('tblGL')

        ->select('GLRef', 'CustomerID','CustomerRef', \DB::raw('CONCAT("Customer", \' - \' ,"AccountType", \' - \',"AccountNo") AS CUST_ACCT'))
        ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
        ->leftJoin('tblAccountType', 'tblGL.AccountTypeID', '=', 'tblAccountType.AccountTypeRef')
        ->leftJoin('tblCurrency', 'tblGL.CurrencyID', '=', 'tblCurrency.CurrencyRef')
        ->leftJoin('tblBranch', 'tblGL.BranchID', '=', 'tblBranch.BranchRef')
        ->where ('AccountTypeRef',1)
        ->get();

        $loan_types = LoanType::all();


        // return dd($currencies);
        return view('gls.create2', compact('gls', 'loanrepaymenttype', 'branches', 'account_types', 'staff', 'status', 'frequencies', 'currencies', 'customers', 'customer_details', 'loan_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gl = new GL($request->all());
        $this->validate($request, [
            'CustomerID' => 'required',
        ]);
        if ($gl->save()) {
            return redirect()->route('gls.create')->with('success', 'GL was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'GL failed to save');
        }
    }

    public function storeLoan(Request $request)
    {
        $gl = new GL($request->all());
        $this->validate($request, [
            'CustomerID' => 'required',
            'LoanManagementFee' => 'required',
            'LoanProcessingFee' => 'required',
            'LoanApplicationFee' => 'required'
        ]);
        if ($gl->save()) {

            $LoanRef = $gl->GLRef;
            //dd($LoanRef);
            DB::statement("exec procUpdateLoanAccountTypeID $LoanRef ");
            return redirect()->route('gls.create2')->with('success', 'Loan was created successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Loan failed to save');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $gls = GL::all();
        $gl            = GL::where('GLRef', $id)->first();
        $customers     = Customer::all();
        $branches      = Branch::all();
        $currencies    = Currency::all();
        $account_types = AccountType::all();
        $gls           = \DB::table('tblGL')
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->leftJoin('tblAccountType', 'tblGL.AccountTypeID', '=', 'tblAccountType.AccountTypeRef')
            ->leftJoin('tblCurrency', 'tblGL.CurrencyID', '=', 'tblCurrency.CurrencyRef')
            ->leftJoin('tblBranch', 'tblGL.BranchID', '=', 'tblBranch.BranchRef')
            ->get();
        return view('gls.edit', compact('gl', 'gls', 'customers', 'account_types', 'currencies', 'branches'));
    }

    public function edit2($id)
    {
        // $gls = GL::all();
        $gl = GL::where('GLRef', $id)->first();

        $customers     = Customer::all();
        $branches      = Branch::all();
        $currencies    = Currency::all();
        $staff         = Staff::all();
        $status        = LoanStatus::all();
        $frequencies   = Frequency::all();
        $account_types = AccountType::all();
        $loan_types = LoanType::all();

        $gls = \DB::table('tblGL')
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->leftJoin('tblAccountType', 'tblGL.AccountTypeID', '=', 'tblAccountType.AccountTypeRef')
            ->leftJoin('tblCurrency', 'tblGL.CurrencyID', '=', 'tblCurrency.CurrencyRef')
            ->leftJoin('tblBranch', 'tblGL.BranchID', '=', 'tblBranch.BranchRef')
            ->get();

        $loanrepaymenttype = LoanRePaymentType::all();

        $customer_details = \DB::table('tblGL')
            ->select('GLRef', 'CustomerID', 'CustomerRef', \DB::raw('CONCAT("Customer", \' - \' ,"AccountType", \' - \',"AccountNo") AS CUST_ACCT'))
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->leftJoin('tblAccountType', 'tblGL.AccountTypeID', '=', 'tblAccountType.AccountTypeRef')
            ->leftJoin('tblCurrency', 'tblGL.CurrencyID', '=', 'tblCurrency.CurrencyRef')
            ->leftJoin('tblBranch', 'tblGL.BranchID', '=', 'tblBranch.BranchRef')
            ->get();
        // return dd($TradeRef);
        return view('gls.edit2', compact('gl', 'customer_details', 'gls', 'customers', 'loanrepaymenttype', 'account_types', 'currencies', 'branches', 'staff', 'frequencies', 'loan_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $gl = \DB::table('tblGL')->where('GLRef', $id);
        if ($gl->update($request->except(['_token', '_method']))) {
            return redirect()->route('gls.create')->with('success', 'GL was updated successfully');
        } else {
            return back()->withInput()->with('error', 'GL failed to update');
        }
    }

    public function update2(Request $request, $id)
    {
        $gl = \DB::table('tblGL')->where('GLRef', $id);
        if ($gl->update($request->except(['_token', '_method']))) {

            DB::statement("exec procUpdateLoanAccountTypeID '$id' ");
            return redirect()->route('gls.create2')->with('success', 'Loan was updated successfully');
        } else {
            return back()->withInput()->with('error', 'Loan failed to update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
