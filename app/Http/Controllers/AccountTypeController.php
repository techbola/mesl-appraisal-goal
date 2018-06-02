<?php

namespace Cavidel\Http\Controllers;

use Cavidel\AccountType;
use Cavidel\AccountCategory;
use Cavidel\AccountGroup;
use Illuminate\Http\Request;

class AccountTypeController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        $account_types = AccountType::all();
        $categories = AccountCategory::orderBy('AccountCategory')->get();
        $account_groups = AccountGroup::orderBy('AccountGroup')->get();
        return view('account_types.create', compact('account_types', 'categories', 'account_groups'));
    }


    public function store(Request $request)
    {
        $account_type = new AccountType($request->all());
        $this->validate($request, [
            'AccountType' => 'required',
        ]);
        if ($account_type->save()) {
            return redirect()->route('account-types.create')->with('success', 'AccountType was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'AccountType failed to save');
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $account_types      = AccountType::all();
        $account_type       = AccountType::where('AccountTypeRef', $id)->first();
        $account_groups = AccountGroup::orderBy('AccountGroup')->get();
        $categories = AccountCategory::orderBy('AccountCategory')->get();
        // return dd($TradeRef);
        return view('account_types.edit', compact('account_type', 'account_types', 'account_groups', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $account_type = \DB::table('tblAccountType')->where('AccountTypeRef', $id);
        if ($account_type->update($request->except(['_token', '_method']))) {
            return redirect()->route('account-types.create')->with('success', 'AccountType was updated successfully');
        } else {
            return back()->withInput()->with('error', 'AccountType failed to update');
        }
    }


    public function destroy($id)
    {
        //
    }
}
