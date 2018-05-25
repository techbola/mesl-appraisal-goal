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
        $configs          = Config::first();
        $customers        = Customer::all();
        $customer_details = collect(\DB::select("SELECT GLRef, tblCustomer.Customer + ' - ' + tblAccountType.AccountType + ' / ' + CASE WHEN CustomerID = 195 THEN tblGL.Description ELSE '/' END + ' - ' + tblCurrency.Currency + CONVERT(varchar, format(tblGL.BookBalance,'#,##0.00'))
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef"));

        $cashentries = \DB::table('tblCashEntry')
            ->leftJoin('tblGL', 'tblCashEntry.GLIDCredit', '=', 'tblGL.GLRef')
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            // ->where('PostingTypeID', '=', 11)
            ->where('tblCashEntry.CurrencyID', 1)
            ->where('tblCashEntry.Posted', 0)
            ->get();
        return view('cash_entries.create_customer_transfer', compact('cashentries', 'customers', 'configs', 'customer_details'));
    }

    public function customer_transfer_edit($id)
    {
        $cash_entry = CashEntry::find($id);
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
        $cash_entry        = \DB::table('tblCashEntry')->where('CashEntryRef', $id);
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
        $configs          = Config::first();
        $customers        = Customer::all();
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
        $configs          = Config::first();
        $customers        = Customer::all();
        $debit_acct_details = collect(\DB::select("SELECT GLRef, tblGL.Description  + ' - ' +  tblCurrency.Currency + CONVERT(varchar, format(tblGL.BookBalance,'#,##0.00'))
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where tblGL.AccountTypeID = ?
                         Order By tblGL.AccountTypeID,tblGL.Description", [2]));

         $credit_acct_details = collect(\DB::select("SELECT GLRef,  CASE WHEN CustomerID = 1 THEN tblGL.Description ELSE 'Empty' END + ' - ' + tblCurrency.Currency + CONVERT(varchar, format(tblGL.BookBalance,'#,##0.00'))
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where tblGL.AccountTypeID = ? OR tblGL.AccountTypeID = ?
                         Order By tblGL.Description", [3, 4]));

        $cashentries = \DB::table('tblCashEntry')
            ->leftJoin('tblGL', 'tblCashEntry.GLIDCredit', '=', 'tblGL.GLRef')
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            // ->where('PostingTypeID', '=', 1)
            ->where('tblCashEntry.CurrencyID', 1)
            ->where('tblCashEntry.Posted', 0)
            ->get();
        return view('cash_entries.receipts', compact('cashentries', 'customers', 'configs', 'debit_acct_details', 'credit_acct_details'));
    }

    public function purchase_on_credits()
    {
        $configs          = Config::first();
        $customers        = Customer::all();
        $debit_acct_details = collect(\DB::select("SELECT GLRef, tblGL.Description  + ' - ' +  tblCurrency.Currency + CONVERT(varchar, format(tblGL.BookBalance,'#,##0.00'))
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where tblGL.AccountTypeID = ? OR tblGL.AccountTypeID= ? OR tblGL.AccountTypeID= ? OR tblGL.AccountTypeID= ? OR tblGL.AccountTypeID= ?
                         Order By tblGL.Description", [15, 7, 16, 8,13]));

         $credit_acct_details = collect(\DB::select("SELECT GLRef,  CASE WHEN CustomerID = 1 THEN tblGL.Description ELSE '/' END + ' - ' + tblCurrency.Currency + CONVERT(varchar, format(tblGL.BookBalance,'#,##0.00'))
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where tblGL.AccountTypeID = ? OR tblGL.AccountTypeID =? OR tblGL.AccountTypeID =?
                         Order By tblGL.Description", [5, 6,2]));

        $cashentries = \DB::table('tblCashEntry')
            ->leftJoin('tblGL', 'tblCashEntry.GLIDCredit', '=', 'tblGL.GLRef')
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            // ->where('PostingTypeID', '=', 1)
            ->where('tblCashEntry.CurrencyID', 1)
            ->where('tblCashEntry.Posted', 0)
            ->get();
        return view('cash_entries.purchase_on_credits', compact('cashentries', 'customers', 'configs', 'debit_acct_details', 'credit_acct_details'));
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

     public function bill_posting(Request $request)
     {
        $user_id = \Auth::user()->staffId;
        $details = Staff::where('StaffRef', $user_id)->first();
        $location = $details->LocationID;
        $postedbills = \DB::select("EXEC procViewBillGroup $location");
        return view('cash_entries.bill_posting', compact('postedbills'));
     }

     public function post_bill(Request $request)
     {
        $billcodes = $request->BillPost;
        $userid = \Auth::user()->staffId;
        $details = Staff::where('StaffRef', $userid)->first();
        $location = $details->LocationID;

        foreach($billcodes as $billcode)
        {
            $trans = \DB::statement("EXEC procPostBilling '$billcode', $userid ");
        }
        $postedbills = \DB::select("EXEC procViewBillGroup $location");
        return view('cash_entries.bill_posting', compact('postedbills'));
     }

     public function bill_payment_list()
     {
         $user_id = \Auth::user()->staffId;
        $details = Staff::where('StaffRef', $user_id)->first();
        $location = $details->LocationID;
        $paymentlists = \DB::select("EXEC procBillPaymentList $location");

        $debit_acct_details = collect(\DB::select("SELECT GLRef, tblGL.Description  + ' - ' +  tblCurrency.Currency + CONVERT(varchar, format(tblGL.BookBalance,'#,##0.00'))
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where tblGL.AccountTypeID = ? OR tblGL.AccountTypeID = ?
                         Order By tblGL.AccountTypeID,tblGL.Description", [2, 3]));
        $configs          = Config::first();
        return view('cash_entries.bill_payment_list', compact('paymentlists', 'debit_acct_details', 'configs'));
     }

     public function store_bill_payment_list(Request $request)
     {
        $cashentries = new CashEntry($request->all());
        $this->validate($request, [
            'Amount' => 'required',
        ]);
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
        $configs          = Config::first();
        $customers        = Customer::all();
        $debit_acct_details = collect(\DB::select("SELECT GLRef, tblGL.Description 
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where tblGL.AccountTypeID = ? OR tblGL.AccountTypeID = ?", [5, 14]));

         $credit_acct_details = collect(\DB::select("SELECT GLRef, tblGL.Description 
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where (tblGL.AccountTypeID = ? OR tblGL.AccountTypeID = ?) and (tblGL.Description like '%Petty Cash%' OR tblGL.Description like '%Card%')
                         Order By tblGL.AccountTypeID,tblGL.Description", [2,3]));

        $cashentries = \DB::table('tblCashEntry')
            ->leftJoin('tblGL', 'tblCashEntry.GLIDCredit', '=', 'tblGL.GLRef')
            ->leftJoin('tblCustomer', 'tblGL.CustomerID', '=', 'tblCustomer.CustomerRef')
            // ->where('PostingTypeID', '=', 1)
            ->where('tblCashEntry.CurrencyID', 1)
            ->where('tblCashEntry.Posted', 0)
            ->get();
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
}
