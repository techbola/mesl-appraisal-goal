<?php

namespace Cavidel\Http\Controllers;

use Cavidel\CashEntry;
use Cavidel\Config;
use Cavidel\Customer;
use Cavidel\Staff;
use Illuminate\Http\Request;

class CashEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $configs          = Config::first();
        $customers        = Customer::all();
        $customer_details = \DB::table('tblGL')
            ->select('GLRef', \DB::raw('CONCAT("Customer", \' - \' ,"AccountType", \' - \',"AccountNo", \' - \',"BookBalance") AS CUST_ACCT'))
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->leftJoin('tblAccountType', 'tblGL.AccountTypeID', '=', 'tblAccountType.AccountTypeRef')
            ->leftJoin('tblCurrency', 'tblGL.CurrencyID', '=', 'tblCurrency.CurrencyRef')
            ->leftJoin('tblBranch', 'tblGL.BranchID', '=', 'tblBranch.BranchRef')
            ->get();
        $cashentries = \DB::table('tblCashEntry')
            ->leftJoin('tblGL', 'tblCashEntry.GLIDCredit', '=', 'tblGL.GLRef')
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->where('PostingTypeID', '=', 1)
            ->where('Posted', '=', 0)
            ->get();
        return view('cash_entries.create', compact('cashentries', 'customers', 'configs', 'customer_details'));
    }

    public function create2()
    {
        $staff            = Staff::all();
        $configs          = Config::first();
        $customers        = Customer::all();
        $customer_details = \DB::table('tblGL')
            ->select('GLRef', \DB::raw('CONCAT("Customer", \' - \' ,"AccountType", \' - \',"AccountNo", \' - \',"BookBalance") AS CUST_ACCT'))
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->leftJoin('tblAccountType', 'tblGL.AccountTypeID', '=', 'tblAccountType.AccountTypeRef')
            ->leftJoin('tblCurrency', 'tblGL.CurrencyID', '=', 'tblCurrency.CurrencyRef')
            ->leftJoin('tblBranch', 'tblGL.BranchID', '=', 'tblBranch.BranchRef')
            ->where('tblGL.AccountTypeID', '=', 5)
            ->get();
        $cashentries = \DB::table('tblCashEntry')
            ->leftJoin('tblGL', 'tblCashEntry.GLIDCredit', '=', 'tblGL.GLRef')
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->get();
        return view('cash_entries.create_b', compact('cashentries', 'staff', 'customers', 'configs', 'customer_details'));
    }

    public function create_withdrawal()
    {
        $configs          = Config::first();
        $customers        = Customer::all();
        $customer_details = \DB::table('tblGL')
            ->select('GLRef', 'tblGL.Description as des', \DB::raw('CONCAT("Customer", \' - \' ,"AccountType", \' - \',"AccountNo", \' - \',"BookBalance") AS CUST_ACCT'))
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->leftJoin('tblAccountType', 'tblGL.AccountTypeID', '=', 'tblAccountType.AccountTypeRef')
            ->leftJoin('tblCurrency', 'tblGL.CurrencyID', '=', 'tblCurrency.CurrencyRef')
            ->leftJoin('tblBranch', 'tblGL.BranchID', '=', 'tblBranch.BranchRef')
            ->get();
        $cashentries = CashEntry::all();
        return view('withdrawals.create', compact('cashentries', 'customers', 'configs', 'customer_details'));
    }

    public function create_usd()
    {
        $staff            = Staff::all();
        $configs          = Config::first();
        $customers        = Customer::all();
        $customer_details = \DB::select("select [GLRef], [tblGL].[Description] as [des],
            tblGL.Description + ' - ' + AccountType
            AS CUST_ACCT from [tblGL] left join [tblAccountType]
            on [tblGL].[AccountTypeID] = [tblAccountType].[AccountTypeRef]
            where [CurrencyID] = 2");

        // dd($customer_details);
        $cashentries = \DB::table('tblCashEntry')
            ->leftJoin('tblGL', 'tblCashEntry.GLIDCredit', '=', 'tblGL.GLRef')
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->where('tblCashEntry.CurrencyID', 2)
            ->get();
        return view('cash_entries.create_usd', compact('cashentries', 'staff', 'customers', 'configs', 'customer_details'));
    }

    public function create_gbp()
    {
        $staff            = Staff::all();
        $configs          = Config::first();
        $customers        = Customer::all();
        $customer_details = \DB::select("select [GLRef], [tblGL].[Description] as [des],
            tblGL.Description + ' - ' + AccountType
            AS CUST_ACCT from [tblGL] left join [tblAccountType]
            on [tblGL].[AccountTypeID] = [tblAccountType].[AccountTypeRef]
            where [CurrencyID] = 3");
        $cashentries = \DB::table('tblCashEntry')
            ->leftJoin('tblGL', 'tblCashEntry.GLIDCredit', '=', 'tblGL.GLRef')
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->where('tblCashEntry.CurrencyID', 3)
            ->get();
        return view('cash_entries.create_gbp', compact('cashentries', 'staff', 'customers', 'configs', 'customer_details'));
    }

    public function create_eur()
    {
        $staff            = Staff::all();
        $configs          = Config::first();
        $customers        = Customer::all();
        $customer_details = \DB::select("select [GLRef], [tblGL].[Description] as [des],
            tblGL.Description + ' - ' + AccountType
            AS CUST_ACCT from [tblGL] left join [tblAccountType]
            on [tblGL].[AccountTypeID] = [tblAccountType].[AccountTypeRef]
            where [CurrencyID] = 4");
        $cashentries = \DB::table('tblCashEntry')
            ->leftJoin('tblGL', 'tblCashEntry.GLIDCredit', '=', 'tblGL.GLRef')
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->where('tblCashEntry.CurrencyID', 4)
            ->get();
        return view('cash_entries.create_eur', compact('cashentries', 'staff', 'customers', 'configs', 'customer_details'));
    }

    public function create_usd_withdrawal()
    {
        $staff            = Staff::all();
        $configs          = Config::first();
        $customers        = Customer::all();
        $customer_details = \DB::table('tblGL')
            ->select('GLRef', 'tblGL.Description as des', \DB::raw('CONCAT("Customer", \' - \' ,"AccountType", \' - \',"AccountNo", \' - \',"BookBalance") AS CUST_ACCT'))
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->leftJoin('tblAccountType', 'tblGL.AccountTypeID', '=', 'tblAccountType.AccountTypeRef')
            ->leftJoin('tblCurrency', 'tblGL.CurrencyID', '=', 'tblCurrency.CurrencyRef')
            ->leftJoin('tblBranch', 'tblGL.BranchID', '=', 'tblBranch.BranchRef')
            ->where('AccountType', 'like', 'Cash at%')
            ->where('CurrencyID', 2)
            ->get();
        $cashentries = \DB::table('tblCashEntry')
            ->leftJoin('tblGL', 'tblCashEntry.GLIDCredit', '=', 'tblGL.GLRef')
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->where('tblCashEntry.CurrencyID', 2)
            ->get();
        return view('withdrawals.create_usd', compact('cashentries', 'staff', 'customers', 'configs', 'customer_details'));
    }

    public function create_gbp_withdrawal()
    {
        $staff            = Staff::all();
        $configs          = Config::first();
        $customers        = Customer::all();
        $customer_details = \DB::table('tblGL')
            ->select('GLRef', 'tblGL.Description as des', \DB::raw('CONCAT("Customer", \' - \' ,"AccountType", \' - \',"AccountNo", \' - \',"BookBalance") AS CUST_ACCT'))
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->leftJoin('tblAccountType', 'tblGL.AccountTypeID', '=', 'tblAccountType.AccountTypeRef')
            ->leftJoin('tblCurrency', 'tblGL.CurrencyID', '=', 'tblCurrency.CurrencyRef')
            ->leftJoin('tblBranch', 'tblGL.BranchID', '=', 'tblBranch.BranchRef')
            ->where('AccountType', 'like', 'Cash at%')
            ->where('CurrencyID', 3)
            ->get();
        $cashentries = \DB::table('tblCashEntry')
            ->leftJoin('tblGL', 'tblCashEntry.GLIDCredit', '=', 'tblGL.GLRef')
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->where('tblCashEntry.CurrencyID', 3)
            ->get();
        return view('withdrawals.create_gbp', compact('cashentries', 'staff', 'customers', 'configs', 'customer_details'));
    }

    public function create_eur_withdrawal()
    {
        $staff            = Staff::all();
        $configs          = Config::first();
        $customers        = Customer::all();
        $customer_details = \DB::table('tblGL')
            ->select('GLRef', 'tblGL.Description as des', \DB::raw('CONCAT("Customer", \' - \' ,"AccountType", \' - \',"AccountNo", \' - \',"BookBalance") AS CUST_ACCT'))
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->leftJoin('tblAccountType', 'tblGL.AccountTypeID', '=', 'tblAccountType.AccountTypeRef')
            ->leftJoin('tblCurrency', 'tblGL.CurrencyID', '=', 'tblCurrency.CurrencyRef')
            ->leftJoin('tblBranch', 'tblGL.BranchID', '=', 'tblBranch.BranchRef')
            ->where('AccountType', 'like', 'Cash at%')
            ->where('CurrencyID', 4)
            ->get();
        $cashentries = \DB::table('tblCashEntry')
            ->leftJoin('tblGL', 'tblCashEntry.GLIDCredit', '=', 'tblGL.GLRef')
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->where('tblCashEntry.CurrencyID', 4)
            ->get();
        return view('withdrawals.create_eur', compact('cashentries', 'staff', 'customers', 'configs', 'customer_details'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cashentries = new CashEntry($request->all());
        $this->validate($request, [
            'Amount' => 'required',
        ]);
        if ($cashentries->save()) {
            return redirect()->route('cash_entries.create')->with('success', 'Cash Entry was successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Cash Entry failed to save');
        }
    }

    public function store2(Request $request)
    {
        $cashentries = new CashEntry($request->all());
        $this->validate($request, [
            'Amount' => 'required',
        ]);
        if ($cashentries->save()) {
            return redirect()->route('cash_entries.create2')->with('success', 'Cash Entry was successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Cash Entry failed to save');
        }
    }

    public function store_withdrawal()
    {
        $cashentries        = new CashEntry($request->all());
        $CustomerGl         = \DB::table('tblGL')->where('GLRef', $request->GLIDDebit)->first();
        $DebitLimit         = $CustomerGl->DebitLimitTotal;
        $absoluteDebitLimit = abs($DebitLimit);
        $this->validate($request,
            [
                'Amount'    => "required|numeric|max:$absoluteDebitLimit",
                'ValueDate' => 'required',
                'GLIDDebit' => 'required',
            ],
            [
                'Amount.max' => "Insufficient Funds. You may not transfer more than " . number_format($absoluteDebitLimit, 2),
            ]);
        if ($cashentries->save()) {
            return redirect()->route('withdrawals.create')->with('success', 'Cash withdrawal was successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Transaction Failed');
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
        $entry            = CashEntry::where('CashEntryRef', $id)->first();
        $configs          = Config::first();
        $customers        = Customer::all();
        $customer_details = \DB::table('tblGL')
            ->select('GLRef', \DB::raw('CONCAT("Customer", \' - \' ,"AccountType", \' - \',"AccountNo", \' - \',"BookBalance") AS CUST_ACCT'))
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->leftJoin('tblAccountType', 'tblGL.AccountTypeID', '=', 'tblAccountType.AccountTypeRef')
            ->leftJoin('tblCurrency', 'tblGL.CurrencyID', '=', 'tblCurrency.CurrencyRef')
            ->leftJoin('tblBranch', 'tblGL.BranchID', '=', 'tblBranch.BranchRef')
            ->get();
        $cashentries = CashEntry::all();
        // return dd($TradeRef);
        return view('cash_entries.edit', compact('cashentries', 'entry', 'customers', 'configs', 'customer_details'));
    }

    public function edit2($id)
    {
        $entry            = CashEntry::where('CashEntryRef', $id)->first();
        $configs          = Config::first();
        $customers        = Customer::all();
        $customer_details = \DB::table('tblGL')
            ->select('GLRef', \DB::raw('CONCAT("Customer", \' - \' ,"AccountType", \' - \',"AccountNo", \' - \',"BookBalance") AS CUST_ACCT'))
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->leftJoin('tblAccountType', 'tblGL.AccountTypeID', '=', 'tblAccountType.AccountTypeRef')
            ->leftJoin('tblCurrency', 'tblGL.CurrencyID', '=', 'tblCurrency.CurrencyRef')
            ->leftJoin('tblBranch', 'tblGL.BranchID', '=', 'tblBranch.BranchRef')
            ->get();
        $cashentries = CashEntry::all();
        // return dd($TradeRef);
        return view('cash_entries.edit_b', compact('cashentries', 'entry', 'customers', 'configs', 'customer_details'));
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
        $cashentries = \DB::table('tblCashEntry')->where('CashEntryRef', $id);
        if ($cashentries->update($request->except(['_token', '_method']))) {
            return redirect()->route('cash_entries.create')->with('success', 'Cash Entry was updated successfully');
        } else {
            return back()->withInput()->with('error', 'Cash Entry failed to update');
        }
    }

    public function update2(Request $request, $id)
    {
        $cashentries = \DB::table('tblCashEntry')->where('CashEntryRef', $id);
        if ($cashentries->update($request->except(['_token', '_method']))) {
            return redirect()->route('cash')->with('success', 'Cash Entry was updated successfully');
        } else {
            return back()->withInput()->with('error', 'Cash Entry failed to update');
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

    // Internal Postings
    // NGN
    public function internal_postings_ngn()
    {

        $staff            = Staff::all();
        $configs          = Config::first();
        $customers        = Customer::all();
        $customer_details = collect(\DB::select("select [GLRef], [tblGL].[Description] as [des],
            tblGL.Description + ' - ' + AccountType
            AS CUST_ACCT from [tblGL] left join [tblAccountType]
            on [tblGL].[AccountTypeID] = [tblAccountType].[AccountTypeRef]
            where [CurrencyID] = 1"));

        $cashentries = \DB::table('tblCashEntry')
            ->leftJoin('tblGL', 'tblCashEntry.GLIDCredit', '=', 'tblGL.GLRef')
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->where('tblCashEntry.CurrencyID', 1)
            ->get();
        return view('cash_entries.create_internal_posting', compact('cashentries', 'staff', 'customers', 'configs', 'customer_details'));
    }

    // storage for the above method(internal_postings_ngn)

    public function internal_postings_store(Request $request)
    {
        $cashentries = new CashEntry($request->all());
        $this->validate($request, [
            'Amount' => 'required',
        ]);
        if ($cashentries->save()) {
            return redirect()->route('create_internal_posting_ngn')->with('success', 'Cash Entry was successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Cash Entry failed to save');
        }
    }

    // Internal Postings
    // USD
    public function internal_postings_usd()
    {

        $staff            = Staff::all();
        $configs          = Config::first();
        $customers        = Customer::all();
        $customer_details = collect(\DB::select("select [GLRef], [tblGL].[Description] as [des],
            tblGL.Description + ' - ' + AccountType
            AS CUST_ACCT from [tblGL] left join [tblAccountType]
            on [tblGL].[AccountTypeID] = [tblAccountType].[AccountTypeRef]
            where [CurrencyID] = 2"));

        $cashentries = \DB::table('tblCashEntry')
            ->leftJoin('tblGL', 'tblCashEntry.GLIDCredit', '=', 'tblGL.GLRef')
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->where('tblCashEntry.CurrencyID', 2)
            ->get();
        return view('cash_entries.create_internal_posting_usd', compact('cashentries', 'staff', 'customers', 'configs', 'customer_details'));
    }

    // storage for the above method(internal_postings_usd)

    public function internal_postings_usd_store(Request $request)
    {
        $cashentries = new CashEntry($request->all());
        $this->validate($request, [
            'Amount' => 'required',
        ]);
        if ($cashentries->save()) {
            return redirect()->route('create_internal_posting_usd')->with('success', 'Cash Entry was successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Cash Entry failed to save');
        }
    }

    // Internal Postings
    // GBP
    public function internal_postings_gbp()
    {

        $staff            = Staff::all();
        $configs          = Config::first();
        $customers        = Customer::all();
        $customer_details = collect(\DB::select("select [GLRef], [tblGL].[Description] as [des],
            tblGL.Description + ' - ' + AccountType
            AS CUST_ACCT from [tblGL] left join [tblAccountType]
            on [tblGL].[AccountTypeID] = [tblAccountType].[AccountTypeRef]
            where [CurrencyID] = 3"));

        $cashentries = \DB::table('tblCashEntry')
            ->leftJoin('tblGL', 'tblCashEntry.GLIDCredit', '=', 'tblGL.GLRef')
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->where('tblCashEntry.CurrencyID', 3)
            ->get();
        return view('cash_entries.create_internal_posting_gbp', compact('cashentries', 'staff', 'customers', 'configs', 'customer_details'));
    }

    // Customer Transfer methods

    public function customer_transfer()
    {
        $auth_user        = auth()->user()->id;
        $configs          = Config::first();
        $customers        = Customer::all();
        $customer_details = collect(\DB::select("SELECT GLRef, concat(tblCustomer.Customer, ' - ' , tblAccountType.AccountType , ' / ' , CASE WHEN CustomerID = 1 THEN tblGL.Description ELSE '/' END , ' - ' , tblCurrency.Currency , CONVERT(varchar, format(tblGL.BookBalance,'#,##0.00')))
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef"));

        $cashentries = collect(\DB::select("SELECT        tblCashEntry.CashEntryRef, tblCashEntry.PostingTypeID, tblCashEntry.CurrencyID, tblGL.Description AS gl_debit, tblGL_1.Description AS gl_credit, tblCashEntry.PostDate, tblCashEntry.ValueDate, tblCashEntry.Amount,
                         tblCashEntry.Narration
FROM            tblCashEntry INNER JOIN
                         tblGL ON tblCashEntry.GLIDDebit = tblGL.GLRef INNER JOIN
                         tblGL AS tblGL_1 ON tblCashEntry.GLIDCredit = tblGL_1.GLRef
WHERE        (tblCashEntry.Posted = 0) AND (tblCashEntry.PostFlag = 0) AND (tblCashEntry.ApprovedFlag = 0) AND (tblCashEntry.InputterID = $auth_user) order by tblCashEntry.CashEntryRef desc

            "));

        // dd($cashentries);
        return view('cash_entries.create_customer_transfer', compact('cashentries', 'customers', 'configs', 'customer_details'));
    }

    public function submit_bill_for_posting(Request $request)
    {
        // dd($request->all());
        foreach ($request->CashEntryRef as $ref) {
            $cash_entry           = CashEntry::find($ref);
            $cash_entry->PostFlag = 1;
            $cash_entry->save();
        }

        return 'done';
    }

    public function reject_posting_approvals(Request $request)
    {
        // dd($request->all());
        foreach ($request->CashEntryRef as $ref) {
            $cash_entry               = CashEntry::find($ref);
            $cash_entry->PostFlag     = 0;
            $cash_entry->ApprovedFlag = 0;
            $cash_entry->save();
        }

        return 'done';
    }

    public function show_approve_posting()
    {
        $cashentries = collect(\DB::select("SELECT        tblCashEntry.CashEntryRef, tblCashEntry.PostingTypeID, tblCashEntry.CurrencyID, tblGL.Description AS gl_debit, tblGL_1.Description AS gl_credit, tblCashEntry.PostDate, tblCashEntry.ValueDate, tblCashEntry.Amount, tblCashEntry.InputterID,
                         tblCashEntry.Narration
FROM            tblCashEntry INNER JOIN
                         tblGL ON tblCashEntry.GLIDDebit = tblGL.GLRef INNER JOIN
                         tblGL AS tblGL_1 ON tblCashEntry.GLIDCredit = tblGL_1.GLRef
WHERE        (tblCashEntry.Posted = 0) AND (tblCashEntry.PostFlag = 1) AND (tblCashEntry.ApprovedFlag = 0)

            "));
        return view('cash_entries.approve_posted_bill', compact('cashentries'));
    }

    public function submit_bill_for_approval(Request $request)
    {
        foreach ($request->CashEntryRef as $ref) {
            $cash_entry               = CashEntry::find($ref);
            $cash_entry->ApprovedFlag = 1;
            $cash_entry->save();
        }
        return 'done';
    }

    public function customer_transfer_edit($id)
    {
        $cash_entry       = CashEntry::find($id);
        $configs          = Config::first();
        $customers        = Customer::all();
        $customer_details = \DB::table('tblGL')
            ->select('GLRef', \DB::raw('CONCAT("Customer", \' - \' ,"AccountType", \' - \',"AccountNo", \' - \',"BookBalance") AS CUST_ACCT'))
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->leftJoin('tblAccountType', 'tblGL.AccountTypeID', '=', 'tblAccountType.AccountTypeRef')
            ->leftJoin('tblCurrency', 'tblGL.CurrencyID', '=', 'tblCurrency.CurrencyRef')
            ->leftJoin('tblBranch', 'tblGL.BranchID', '=', 'tblBranch.BranchRef')

            ->get();
        $cashentries = \DB::table('tblCashEntry')
            ->leftJoin('tblGL', 'tblCashEntry.GLIDCredit', '=', 'tblGL.GLRef')
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
        // ->where('PostingTypeID', '=', 11)
            ->where('tblCashEntry.CurrencyID', 1)
            ->get();
        return view('cash_entries.edit_customer_transfer', compact('cashentries', 'cash_entry', 'customers', 'configs', 'customer_details'));
    }

    public function customer_transfer_store(Request $request)
    {
        $cashentries        = new CashEntry($request->all());
        $CustomerGl         = \DB::table('tblGL')->where('GLRef', $request->GLIDDebit)->first();
        $DebitLimit         = $CustomerGl->DebitLimitTotal;
        $absoluteDebitLimit = abs($DebitLimit);
        $this->validate($request,
            [
                //'Amount'    => "required|numeric|max:$absoluteDebitLimit",
                'ValueDate' => 'required',
                'GLIDDebit' => 'required',
            ],
            [
                'Amount.max' => "Insufficient Funds. You may not transfer more than " . number_format($absoluteDebitLimit, 2),
            ]);
        if ($cashentries->save()) {
            return redirect()->route('customer_transfer')->with('success', 'Cash Entry was successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Cash Entry failed to save');
        }
    }

    public function customer_transfer_update(Request $request, $id)
    {
        $cash_entry         = \DB::table('tblCashEntry')->where('CashEntryRef', $id);
        $CustomerGl         = \DB::table('tblGL')->where('GLRef', $request->GLIDDebit)->first();
        $DebitLimit         = $CustomerGl->DebitLimitTotal;
        $absoluteDebitLimit = abs($DebitLimit);
        $this->validate($request,
            [
                //'Amount'    => "required|numeric|max:$absoluteDebitLimit",
                'ValueDate' => 'required',
                'GLIDDebit' => 'required',
            ],
            [
                'Amount.max' => "Insufficient Funds. You may not transfer more than " . number_format($absoluteDebitLimit, 2),
            ]);
        if ($cash_entry->update($request->except(['_token', '_method']))) {
            return redirect()->route('customer_transfer')->with('success', 'Cash Entry was successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Cash Entry failed to save');
        }
    }

    // End of Customer Transfer ethods

    // storage for the above method(internal_postings_gbp)

    public function internal_postings_gbp_store(Request $request)
    {
        $cashentries = new CashEntry($request->all());
        $this->validate($request, [
            'Amount' => 'required',
        ]);
        if ($cashentries->save()) {
            return redirect()->route('create_internal_posting_gbp')->with('success', 'Cash Entry was successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Cash Entry failed to save');
        }
    }

    // Internal Postings
    // EUR
    public function internal_postings_eur()
    {

        $staff            = Staff::all();
        $configs          = Config::first();
        $customers        = Customer::all();
        $customer_details = collect(\DB::select("select [GLRef], [tblGL].[Description] as [des],
            tblGL.Description + ' - ' + AccountType
            AS CUST_ACCT from [tblGL] left join [tblAccountType]
            on [tblGL].[AccountTypeID] = [tblAccountType].[AccountTypeRef]
            where [CurrencyID] = 4"));

        $cashentries = \DB::table('tblCashEntry')
            ->leftJoin('tblGL', 'tblCashEntry.GLIDCredit', '=', 'tblGL.GLRef')
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            ->where('tblCashEntry.CurrencyID', 4)
            ->get();
        return view('cash_entries.create_internal_posting_eur', compact('cashentries', 'staff', 'customers', 'configs', 'customer_details'));
    }

    // storage for the above method(internal_postings_eur)

    public function internal_postings_eur_store(Request $request)
    {
        $cashentries = new CashEntry($request->all());
        $this->validate($request, [
            'Amount' => 'required',
        ]);
        if ($cashentries->save()) {
            return redirect()->route('create_internal_posting_eur')->with('success', 'Cash Entry was successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Cash Entry failed to save');
        }
    }

    public function Payments()
    {
        $configs            = Config::first();
        $customers          = Customer::all();
        $debit_acct_details = collect(\DB::select("SELECT GLRef, tblCustomer.Customer + ' - ' + tblAccountType.AccountType + '-' + tblGL.Description  + ' - ' + tblCurrency.Currency + CONVERT(varchar, format(tblGL.BookBalance,'#,##0.00'))
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where tblGL.AccountTypeID = ? OR tblGL.AccountTypeID = ?", [5, 6]));

        $credit_acct_details = collect(\DB::select("SELECT GLRef, tblGL.Description  + ' - ' +  tblCurrency.Currency + CONVERT(varchar, format(tblGL.BookBalance,'#,##0.00'))
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where tblGL.AccountTypeID = ?
                         Order By tblGL.AccountTypeID,tblGL.Description", [2]));

        $cashentries = \DB::table('tblCashEntry')
            ->leftJoin('tblGL', 'tblCashEntry.GLIDCredit', '=', 'tblGL.GLRef')
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
        // ->where('PostingTypeID', '=', 1)
            ->where('tblCashEntry.CurrencyID', 1)
            ->where('tblCashEntry.Posted', 0)
            ->get();
        return view('cash_entries.payments', compact('cashentries', 'customers', 'configs', 'debit_acct_details', 'credit_acct_details'));
    }

    public function Receipts()
    {
        $configs            = Config::first();
        $customers          = Customer::all();
        $auth_user          = auth()->user()->id;
        $debit_acct_details = collect(\DB::select("SELECT GLRef, tblGL.Description  + ' - ' +  tblCurrency.Currency + CONVERT(varchar, format(tblGL.BookBalance,'#,##0.00'))
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where tblGL.AccountTypeID = ?
                         Order By tblGL.Description", [54]));

        $credit_acct_details = collect(\DB::select("SELECT GLRef,  tblGL.Description  + ' - ' +  tblCurrency.Currency + CONVERT(varchar, format(tblGL.BookBalance,'#,##0.00'))
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where tblGL.AccountTypeID = ? and tblGL.CustomerID > ?
                         Order By tblGL.Description", [19, 1]));

        $cashentries = collect(\DB::select("SELECT        tblCashEntry.CashEntryRef, tblCashEntry.PostingTypeID, tblCashEntry.CurrencyID, tblGL.Description AS gl_debit, tblGL_1.Description AS gl_credit, tblCashEntry.PostDate, tblCashEntry.ValueDate, tblCashEntry.Amount,
                         tblCashEntry.Narration
FROM            tblCashEntry INNER JOIN
                         tblGL ON tblCashEntry.GLIDDebit = tblGL.GLRef INNER JOIN
                         tblGL AS tblGL_1 ON tblCashEntry.GLIDCredit = tblGL_1.GLRef
WHERE        (tblCashEntry.Posted = 0) AND (tblCashEntry.PostFlag = 0) AND (tblCashEntry.ApprovedFlag = 0) AND (tblCashEntry.PostingTypeID = 14) AND (tblCashEntry.InputterID = $auth_user) order by tblCashEntry.CashEntryRef desc

            "));
        return view('cash_entries.receipts', compact('cashentries', 'customers', 'configs', 'debit_acct_details', 'credit_acct_details'));
    }

    public function purchase_on_credits()
    {
        $auth_user          = auth()->user()->id;
        $configs            = Config::first();
        $customers          = Customer::all();
        $debit_acct_details = collect(\DB::select("SELECT GLRef, tblGL.Description  + ' - ' +  tblCurrency.Currency + CONVERT(varchar, format(tblGL.BookBalance,'#,##0.00'))
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where tblGL.AccountTypeID between ? and ? OR tblGL.AccountTypeID between ? and ?
                         Order By tblGL.Description", [11, 12, 27, 39]));

        $credit_acct_details = collect(\DB::select("SELECT GLRef,  concat(tblGL.Description  , ' - ', tblCurrency.Currency , CONVERT(varchar, format(tblGL.BookBalance,'#,##0.00')))
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where tblGL.AccountTypeID = ? OR tblGL.AccountTypeID =? OR tblGL.AccountTypeID =? OR tblGL.AccountTypeID =?
                         Order By tblGL.Description", [20, 60, 61, 59]));

        $cashentries = collect(\DB::select("SELECT        tblCashEntry.CashEntryRef, tblCashEntry.PostingTypeID, tblCashEntry.CurrencyID, tblGL.Description AS gl_debit, tblGL_1.Description AS gl_credit, tblCashEntry.PostDate, tblCashEntry.ValueDate, tblCashEntry.Amount, tblCashEntry.InputterID,
                         tblCashEntry.Narration
FROM            tblCashEntry INNER JOIN
                         tblGL ON tblCashEntry.GLIDDebit = tblGL.GLRef INNER JOIN
                         tblGL AS tblGL_1 ON tblCashEntry.GLIDCredit = tblGL_1.GLRef
WHERE        (tblCashEntry.Posted = 0) AND (tblCashEntry.PostFlag = 0) AND (tblCashEntry.ApprovedFlag = 0) AND (tblCashEntry.InputterID = $auth_user) order by tblCashEntry.CashEntryRef desc
"));

        return view('cash_entries.purchase_on_credits', compact('cashentries', 'customers', 'configs', 'debit_acct_details', 'credit_acct_details'));
    }

    public function purchase_on_credits_edit($id)
    {
        $cash_entry         = CashEntry::find($id);
        $configs            = Config::first();
        $customers          = Customer::all();
        $debit_acct_details = collect(\DB::select("SELECT GLRef, tblGL.Description  + ' - ' +  tblCurrency.Currency + CONVERT(varchar, format(tblGL.BookBalance,'#,##0.00'))
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where tblGL.AccountTypeID between ? and ? OR tblGL.AccountTypeID between ? and ?
                         Order By tblGL.Description", [11, 12, 27, 39]));

        $credit_acct_details = collect(\DB::select("SELECT GLRef,  concat(tblGL.Description  , ' - ', tblCurrency.Currency , CONVERT(varchar, format(tblGL.BookBalance,'#,##0.00')))
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where tblGL.AccountTypeID = ? OR tblGL.AccountTypeID =? OR tblGL.AccountTypeID =?
                         Order By tblGL.Description", [20, 60, 61]));

        $cashentries = \DB::table('tblCashEntry')
            ->leftJoin('tblGL', 'tblCashEntry.GLIDCredit', '=', 'tblGL.GLRef')
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
        // ->where('PostingTypeID', '=', 11)
            ->where('tblCashEntry.CurrencyID', 1)
            ->get();
        return view('cash_entries.edit_purchase_on_credits', compact('cashentries', 'cash_entry', 'customers', 'configs', 'credit_acct_details', 'debit_acct_details'));
    }

    public function purchase_on_credits_update(Request $request, $id)
    {
        $cash_entry         = \DB::table('tblCashEntry')->where('CashEntryRef', $id);
        $CustomerGl         = \DB::table('tblGL')->where('GLRef', $request->GLIDDebit)->first();
        $DebitLimit         = $CustomerGl->DebitLimitTotal;
        $absoluteDebitLimit = abs($DebitLimit);
        $this->validate($request,
            [
                //'Amount'    => "required|numeric|max:$absoluteDebitLimit",
                'ValueDate' => 'required',
                'GLIDDebit' => 'required',
            ],
            [
                'Amount.max' => "Insufficient Funds. You may not transfer more than " . number_format($absoluteDebitLimit, 2),
            ]);
        if ($cash_entry->update($request->except(['_token', '_method']))) {
            return redirect()->route('PurchaseOnCredits')->with('success', 'Cash Entry was successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Cash Entry failed to save');
        }
    }

    public function storePayments(Request $request)
    {
        $cashentries = new CashEntry($request->all());
        $this->validate($request, [
            'Amount' => 'required',
        ]);
        if ($cashentries->save()) {
            return redirect()->route('cash_entries.payments')->with('success', 'Cash Entry was successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Cash Entry failed to save');
        }
    }

    public function storeReceipts(Request $request)
    {
        $cashentries = new CashEntry($request->all());
        $this->validate($request, [
            'Amount' => 'required',
        ]);
        if ($cashentries->save()) {
            return redirect()->route('Receipts')->with('success', 'Cash Entry was successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Cash Entry failed to save');
        }
    }

    public function storepurchase_on_credits(Request $request)
    {
        $cashentries = new CashEntry($request->all());
        $this->validate($request, [
            'Amount' => 'required',
        ]);
        if ($cashentries->save()) {
            return redirect()->route('PurchaseOnCredits')->with('success', 'Cash Entry was successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Cash Entry failed to save');
        }
    }

    public function storepurchase_payments(Request $request)
    {
        $cashentries = new CashEntry($request->all());
        $this->validate($request, [
            'Amount' => 'required',
        ]);
        if ($cashentries->save()) {
            return redirect()->route('PurchasePayments')->with('success', 'Cash Entry was successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Cash Entry failed to save');
        }
    }

    public function bill_posting(Request $request)
    {
        $user_id     = \Auth::user()->staffId;
        $auth_user   = auth()->user()->id;
        $details     = Staff::where('StaffRef', $user_id)->first();
        $postedbills = \DB::select("EXEC procViewBillGroup $auth_user");
        return view('cash_entries.bill_posting', compact('postedbills'));
    }

    public function post_bill(Request $request)
    {
        $billcodes = $request->BillPost;
        $userid    = \Auth::user()->id;
        $details   = Staff::where('StaffRef', $userid)->first();
        //$location  = $details->LocationID;

        foreach ($billcodes as $billcode) {
            $trans = \DB::statement("EXEC procPostBilling '$billcode', $userid ");
        }
        $postedbills = \DB::select("EXEC procViewBillGroup");
        return view('cash_entries.bill_posting', compact('postedbills'));
    }

    public function bill_payment_list()
    {
        $user_id      = \Auth::user()->staffId;
        $auth_user    = auth()->user()->id;
        $details      = Staff::where('StaffRef', $user_id)->first();
        $paymentlists = \DB::select("EXEC procBillPaymentList $auth_user");

        $debit_acct_details = collect(\DB::select("SELECT GLRef, tblGL.Description  + ' - ' +  tblCurrency.Currency + CONVERT(varchar, format(tblGL.BookBalance,'#,##0.00'))
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where tblGL.AccountTypeID = ?
                         Order By tblGL.Description", [54]));
        $configs = Config::first();
        return view('cash_entries.bill_payment_list', compact('paymentlists', 'debit_acct_details', 'configs'));
    }

    public function store_bill_payment_list(Request $request)
    {
        $cashentries           = new CashEntry($request->all());
        $cashentries->PostFlag = 1;
        $cashentries->Posted   = 0;
        // $cashentries->Posted   = 0;
        if ($cashentries->save()) {
            return redirect()->route('BillPaymentList')->with('success', 'Bill Posted was successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Cash Entry failed to save');
        }
    }

    public function approve_posting()
    {
        $cashentries = \DB::table('tblCashEntry')
            ->leftJoin('tblGL', 'tblCashEntry.GLIDCredit', '=', 'tblGL.GLRef')
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
        // ->where('PostingTypeID', '=', 1)
            ->where('tblCashEntry.CurrencyID', 1)
            ->where('tblCashEntry.Posted', 0)
            ->get();

        return view('cash_entries.approve_posting', compact('cashentries'));
    }

    public function Imprest()
    {
        $user_id            = \Auth::user()->staffId;
        $auth_user          = auth()->user()->id;
        $configs            = Config::first();
        $customers          = Customer::all();
        $debit_acct_details = collect(\DB::select("SELECT GLRef, tblGL.Description
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where (tblGL.CustomerID = ? )", [1]));

        $credit_acct_details = collect(\DB::select("SELECT GLRef, tblGL.Description
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where tblGL.AccountTypeID = ?
                         Order By tblGL.Description", [59]));

        $cashentries = collect(\DB::select("SELECT        tblCashEntry.CashEntryRef, tblCashEntry.PostingTypeID, tblCashEntry.CurrencyID, tblGL.Description AS gl_debit, tblGL_1.Description AS gl_credit, tblCashEntry.PostDate, tblCashEntry.ValueDate, tblCashEntry.Amount,
                         tblCashEntry.Narration
FROM            tblCashEntry INNER JOIN
                         tblGL ON tblCashEntry.GLIDDebit = tblGL.GLRef INNER JOIN
                         tblGL AS tblGL_1 ON tblCashEntry.GLIDCredit = tblGL_1.GLRef
WHERE        (tblCashEntry.Posted = 0) AND (tblCashEntry.PostFlag = 0) AND (tblCashEntry.ApprovedFlag = 0) AND (tblCashEntry.PostingTypeID = 15) order by tblCashEntry.CashEntryRef desc

            "));

        return view('cash_entries.Imprest', compact('cashentries', 'customers', 'configs', 'debit_acct_details', 'credit_acct_details'));
    }

    public function storeImprest(Request $request)
    {
        $cashentries = new CashEntry($request->all());
        $this->validate($request, [
            'Amount' => 'required',
        ]);
        if ($cashentries->save()) {
            return redirect()->route('Imprest')->with('success', 'Posting was successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Posting failed to save');
        }
    }

    public function delete_posting(Request $request)
    {
        $ref      = $request->CashEntryRef;
        $deletion = \DB::table('tblCashEntry')->where('CashEntryRef', $ref)->delete();
        return redirect()->back()->with('successs', 'Posting Deleted Successfully');
    }

    public function postReceipts(Request $request)
    {
        foreach ($request->cash_entry_ref as $ref) {
            $cash_entry           = CashEntry::find($ref);
            $cash_entry->PostFlag = 1;
            $cash_entry->save();
        }
        return redirect()->back()->with('successs', 'Reciept(s) Sent for approval');
    }

    public function show_receipt_posting()
    {
        $cashentries = collect(\DB::select("SELECT        tblCashEntry.CashEntryRef, tblCashEntry.PostingTypeID, tblCashEntry.CurrencyID, tblGL.Description AS gl_debit, tblGL_1.Description AS gl_credit, tblCashEntry.PostDate, tblCashEntry.ValueDate, tblCashEntry.Amount,
                         tblCashEntry.Narration
FROM            tblCashEntry INNER JOIN
                         tblGL ON tblCashEntry.GLIDDebit = tblGL.GLRef INNER JOIN
                         tblGL AS tblGL_1 ON tblCashEntry.GLIDCredit = tblGL_1.GLRef
WHERE        (tblCashEntry.Posted = 0) AND (tblCashEntry.PostFlag = 1) AND (tblCashEntry.ApprovedFlag = 0)

            "));
        return view('cash_entries.approve_receipt', compact('cashentries'));
    }

    public function reject_receipt_posting_approvals(Request $request)
    {
        // dd($request->all());
        foreach ($request->CashEntryRef as $ref) {
            $cash_entry               = CashEntry::find($ref);
            $cash_entry->PostFlag     = 0;
            $cash_entry->ApprovedFlag = 0;
            $cash_entry->save();
        }

        return 'done';
    }

    public function submit_Receipt_for_approval(Request $request)
    {
        foreach ($request->CashEntryRef as $ref) {
            $cash_entry               = CashEntry::find($ref);
            $cash_entry->ApprovedFlag = 1;
            $cash_entry->save();
        }
        return 'done';
    }

    public function submit_imprest_for_posting(Request $request)
    {
        // dd($request->all());
        foreach ($request->CashEntryRef as $ref) {
            $cash_entry           = CashEntry::find($ref);
            $cash_entry->PostFlag = 1;
            $cash_entry->save();
        }

        return 'done';
    }

    public function reject_imprest_posting_approvals(Request $request)
    {
        // dd($request->all());
        foreach ($request->CashEntryRef as $ref) {
            $cash_entry               = CashEntry::find($ref);
            $cash_entry->PostFlag     = 0;
            $cash_entry->ApprovedFlag = 0;
            $cash_entry->save();
        }

        return 'done';
    }

    public function submit_imprest_for_approval(Request $request)
    {
        foreach ($request->CashEntryRef as $ref) {
            $cash_entry               = CashEntry::find($ref);
            $cash_entry->ApprovedFlag = 1;
            $cash_entry->save();
        }
        return 'done';
    }

    public function show_approve_receipt()
    {
        $cashentries = collect(\DB::select("SELECT        tblCashEntry.CashEntryRef, tblCashEntry.PostingTypeID, tblCashEntry.CurrencyID, tblGL.Description AS gl_debit, tblGL_1.Description AS gl_credit, tblCashEntry.PostDate, tblCashEntry.ValueDate, tblCashEntry.Amount,
                         tblCashEntry.Narration
FROM            tblCashEntry INNER JOIN
                         tblGL ON tblCashEntry.GLIDDebit = tblGL.GLRef INNER JOIN
                         tblGL AS tblGL_1 ON tblCashEntry.GLIDCredit = tblGL_1.GLRef
WHERE        (tblCashEntry.Posted = 0) AND (tblCashEntry.PostFlag = 1) AND (tblCashEntry.ApprovedFlag = 0) AND (tblCashEntry.PostingTypeID = 14)

            "));
        return view('cash_entries.approve_receipt', compact('cashentries'));
    }

    public function show_approve_imprest()
    {
        $cashentries = collect(\DB::select("SELECT        tblCashEntry.CashEntryRef, tblCashEntry.PostingTypeID, tblCashEntry.CurrencyID, tblGL.Description AS gl_debit, tblGL_1.Description AS gl_credit, tblCashEntry.PostDate, tblCashEntry.ValueDate, tblCashEntry.Amount,
                         tblCashEntry.Narration
FROM            tblCashEntry INNER JOIN
                         tblGL ON tblCashEntry.GLIDDebit = tblGL.GLRef INNER JOIN
                         tblGL AS tblGL_1 ON tblCashEntry.GLIDCredit = tblGL_1.GLRef
WHERE        (tblCashEntry.Posted = 0) AND (tblCashEntry.PostFlag = 1) AND (tblCashEntry.ApprovedFlag = 0) AND (tblCashEntry.PostingTypeID = 15)

            "));
        return view('cash_entries.approve_imprest', compact('cashentries'));
    }

    public function receipt_edit($id)
    {
        $entry              = CashEntry::where('CashEntryRef', $id)->first();
        $configs            = Config::first();
        $debit_acct_details = collect(\DB::select("SELECT GLRef, tblGL.Description  + ' - ' +  tblCurrency.Currency + CONVERT(varchar, format(tblGL.BookBalance,'#,##0.00'))
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where tblGL.AccountTypeID = ?
                         Order By tblGL.Description", [54]));

        $credit_acct_details = collect(\DB::select("SELECT GLRef,  tblGL.Description  + ' - ' +  tblCurrency.Currency + CONVERT(varchar, format(tblGL.BookBalance,'#,##0.00'))
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where tblGL.AccountTypeID = ? and tblGL.CustomerID > ?
                         Order By tblGL.Description", [19, 1]));
        $cashentries = CashEntry::all();
        return view('cash_entries.receipt_edit', compact('cashentries', 'entry', 'debit_acct_details', 'credit_acct_details', 'configs', 'customer_details'));
    }

    public function update_receipt(Request $request, $id)
    {
        $cashentries = \DB::table('tblCashEntry')->where('CashEntryRef', $id);
        if ($cashentries->update($request->except(['_token', '_method']))) {
            return redirect()->route('Receipts')->with('success', 'Receipt was updated successfully');
        } else {
            return back()->withInput()->with('error', 'Receipt failed to update');
        }
    }

    public function delete_receipt(Request $request)
    {
        $ref      = $request->CashEntryRef;
        $deletion = \DB::table('tblCashEntry')->where('CashEntryRef', $ref)->delete();
        return redirect()->back()->with('successs', 'Posting Deleted Successfully');
    }

    public function delete_imprest(Request $request)
    {
        $ref      = $request->CashEntryRef;
        $deletion = \DB::table('tblCashEntry')->where('CashEntryRef', $ref)->delete();
        return redirect()->back()->with('successs', 'Posting Deleted Successfully');
    }

    public function imprest_edit($id)
    {
        $entry              = CashEntry::where('CashEntryRef', $id)->first();
        $configs            = Config::first();
        $debit_acct_details = collect(\DB::select("SELECT GLRef, tblGL.Description  + ' - ' +  tblCurrency.Currency + CONVERT(varchar, format(tblGL.BookBalance,'#,##0.00'))
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where tblGL.AccountTypeID = ?
                         Order By tblGL.Description", [54]));

        $credit_acct_details = collect(\DB::select("SELECT GLRef,  tblGL.Description  + ' - ' +  tblCurrency.Currency + CONVERT(varchar, format(tblGL.BookBalance,'#,##0.00'))
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where tblGL.AccountTypeID = ? and tblGL.CustomerID > ?
                         Order By tblGL.Description", [19, 1]));
        $cashentries = CashEntry::all();
        return view('cash_entries.imprest_edit', compact('cashentries', 'entry', 'debit_acct_details', 'credit_acct_details', 'configs', 'customer_details'));
    }

    public function update_imprest(Request $request, $id)
    {
        $cashentries = \DB::table('tblCashEntry')->where('CashEntryRef', $id);
        if ($cashentries->update($request->except(['_token', '_method']))) {
            return redirect()->route('Imprest')->with('success', 'Imprest was updated successfully');
        } else {
            return back()->withInput()->with('error', 'Imprest failed to update');
        }
    }

//  Purchase Payments Start

    public function purchase_payments()
    {
        $configs            = Config::first();
        $user_id            = \Auth::user()->staffId;
        $auth_user          = auth()->user()->id;
        $customers          = Customer::all();
        $debit_acct_details = collect(\DB::select("SELECT GLRef, tblGL.Description  + ' - ' +  tblCurrency.Currency + CONVERT(varchar, format(tblGL.BookBalance,'#,##0.00'))
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where tblGL.AccountTypeID = ? OR tblGL.AccountTypeID = ? OR tblGL.AccountTypeID = ?
                         Order By tblGL.Description", [20, 60, 61]));

        $credit_acct_details = collect(\DB::select("SELECT GLRef,  concat(tblGL.Description  , ' - ', tblCurrency.Currency , CONVERT(varchar, format(tblGL.BookBalance,'#,##0.00')))
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where tblGL.AccountTypeID = ? OR tblGL.AccountTypeID = ?
                         Order By tblGL.Description", [54, 59]));

        $cashentries = collect(\DB::select("SELECT        tblCashEntry.CashEntryRef, tblCashEntry.PostingTypeID, tblCashEntry.CurrencyID, tblGL.Description AS gl_debit, tblGL_1.Description AS gl_credit, tblCashEntry.PostDate, tblCashEntry.ValueDate, tblCashEntry.Amount,  tblCashEntry.InputterID,
                         tblCashEntry.Narration
FROM            tblCashEntry INNER JOIN
                         tblGL ON tblCashEntry.GLIDDebit = tblGL.GLRef INNER JOIN
                         tblGL AS tblGL_1 ON tblCashEntry.GLIDCredit = tblGL_1.GLRef
WHERE        (tblCashEntry.Posted = 0) AND (tblCashEntry.PostFlag = 0) AND (tblCashEntry.ApprovedFlag = 0) AND ( tblCashEntry.InputterID = $auth_user) order by tblCashEntry.CashEntryRef desc
"));

        return view('cash_entries.purchase_payments', compact('cashentries', 'customers', 'configs', 'debit_acct_details', 'credit_acct_details'));
    }

    public function post_bill_purchase_journal(Request $request)
    {
        foreach ($request->CashEntryRef as $ref) {
            $cash_entry           = CashEntry::find($ref);
            $cash_entry->PostFlag = 1;
            $cash_entry->save();
        }

        return 'done';
    }

    public function reject_purchase_journal_posting_approvals(Request $request)
    {
        // dd($request->all());
        foreach ($request->CashEntryRef as $ref) {
            $cash_entry               = CashEntry::find($ref);
            $cash_entry->PostFlag     = 0;
            $cash_entry->ApprovedFlag = 0;
            $cash_entry->save();
        }

        return 'done';
    }

    public function submit_purchase_journal_for_approval(Request $request)
    {
        foreach ($request->CashEntryRef as $ref) {
            $cash_entry               = CashEntry::find($ref);
            $cash_entry->ApprovedFlag = 1;
            $cash_entry->save();
        }
        return 'done';
    }

    public function show_approve_purchase_journal()
    {
        $cashentries = collect(\DB::select("SELECT        tblCashEntry.CashEntryRef, tblCashEntry.PostingTypeID, tblCashEntry.CurrencyID, tblGL.Description AS gl_debit, tblGL_1.Description AS gl_credit, tblCashEntry.PostDate, tblCashEntry.ValueDate, tblCashEntry.Amount,
                         tblCashEntry.Narration
FROM            tblCashEntry INNER JOIN
                         tblGL ON tblCashEntry.GLIDDebit = tblGL.GLRef INNER JOIN
                         tblGL AS tblGL_1 ON tblCashEntry.GLIDCredit = tblGL_1.GLRef
WHERE        (tblCashEntry.Posted = 0) AND (tblCashEntry.PostFlag = 1) AND (tblCashEntry.ApprovedFlag = 0) AND (tblCashEntry.PostingTypeID = 13)

            "));
        return view('cash_entries.approve_purchase_journal', compact('cashentries'));
    }

    public function purchase_payments_edit($id)
    {
        $cash_entry         = CashEntry::find($id);
        $configs            = Config::first();
        $customers          = Customer::all();
        $debit_acct_details = collect(\DB::select("SELECT GLRef, tblGL.Description  + ' - ' +  tblCurrency.Currency + CONVERT(varchar, format(tblGL.BookBalance,'#,##0.00'))
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where tblGL.AccountTypeID = ? OR tblGL.AccountTypeID =? OR tblGL.AccountTypeID = ?
                         Order By tblGL.Description", [20, 60, 61]));

        $credit_acct_details = collect(\DB::select("SELECT GLRef,  concat(tblGL.Description  , ' - ', tblCurrency.Currency , CONVERT(varchar, format(tblGL.BookBalance,'#,##0.00')))
                         AS CUST_ACCT
                            FROM    tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where tblGL.AccountTypeID = ? OR tblGL.AccountTypeID =?
                         Order By tblGL.Description", [54, 59]));

        $cashentries = \DB::table('tblCashEntry')
            ->leftJoin('tblGL', 'tblCashEntry.GLIDCredit', '=', 'tblGL.GLRef')
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
        // ->where('PostingTypeID', '=', 11)
            ->where('tblCashEntry.CurrencyID', 1)
            ->get();
        return view('cash_entries.edit_purchase_payments', compact('cashentries', 'cash_entry', 'customers', 'configs', 'credit_acct_details', 'debit_acct_details'));
    }

    public function purchase_payments_update(Request $request, $id)
    {
        $cash_entry         = \DB::table('tblCashEntry')->where('CashEntryRef', $id);
        $CustomerGl         = \DB::table('tblGL')->where('GLRef', $request->GLIDDebit)->first();
        $DebitLimit         = $CustomerGl->DebitLimitTotal;
        $absoluteDebitLimit = abs($DebitLimit);
        $this->validate($request,
            [
                //'Amount'    => "required|numeric|max:$absoluteDebitLimit",
                'ValueDate' => 'required',
                'GLIDDebit' => 'required',
            ],
            [
                'Amount.max' => "Insufficient Funds. You may not transfer more than " . number_format($absoluteDebitLimit, 2),
            ]);
        if ($cash_entry->update($request->except(['_token', '_method']))) {
            return redirect()->route('PurchasePayments')->with('success', 'Cash Entry was successful');
        } else {
            return redirect()->back()->withInput()->with('error', 'Cash Entry failed to save');
        }
    }

}

// comment from riliwan
