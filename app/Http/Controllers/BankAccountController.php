<?php

namespace MESL\Http\Controllers;

use MESL\BankAccount;
use MESL\Currency;
use MESL\Staff;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    public function search_account()
    {
        $currencies = Currency::all();
        $acct_mgrs  = \DB::table('tblAccountMgr')->get();
        return view('bank_account.search_account', compact('currencies', 'acct_mgrs'));
    }

    public function search_bank_account(Request $request)
    {
        $currencies  = Currency::all();
        $acct_mgrs   = \DB::table('tblAccountMgr')->get();
        $search_data = $request->BankAccount;
        $results     = \DB::table('tblBankAccount')
            ->leftJoin('tblCurrency', 'tblBankAccount.CurrencyID', '=', 'tblCurrency.CurrencyRef')
            ->leftJoin('tblAccountmgr', 'tblBankAccount.AccountOfficerName', '=', 'tblAccountmgr.AccountMgrRef')
            ->where('BankName', 'like', '%' . $search_data . '%')
            ->get();
        return view('bank_account.search_result', compact('results', 'currencies', 'acct_mgrs'));
    }

    public function submit_bank_account(Request $request)
    {
        $user_id               = \Auth::id();
        $staff_details         = Staff::where('UserID', $user_id)->first();
        $post_data             = new BankAccount($request->all());
        $post_data->CompanyID  = $staff_details->CompanyID;
        $post_data->InputterID = $user_id;
        $post_data->save();
        return response($content = 'Bank Account Saved Successfully', $status = 200);
    }

    public function get_bank_account_details($id)
    {
        $ref             = $id;
        $account_details = BankAccount::where('BankAccountRef', $ref)->first();
        return response()->json($account_details)->setStatusCode(200);
    }

    public function submit_bank_account_edit(Request $request)
    {
        $ref  = $request->BankAccountRef;
        $data = BankAccount::where('BankAccountRef', $ref)->first();
        $data->update($request->except(['_token', '_method']));
        return response($content = 'Bank Account updated Successfully', $status = 200);
    }

    public function get_searched_bank_account($id)
    {
        $search_data = $id;
        $results     = \DB::table('tblBankAccount')
            ->leftJoin('tblCurrency', 'tblBankAccount.CurrencyID', '=', 'tblCurrency.CurrencyRef')
            ->leftJoin('tblAccountmgr', 'tblBankAccount.AccountOfficerName', '=', 'tblAccountmgr.AccountMgrRef')
            ->where('BankName', 'like', '%' . $search_data . '%')
            ->get();
        return response()->json($results)->setStatusCode(200);
    }
}
