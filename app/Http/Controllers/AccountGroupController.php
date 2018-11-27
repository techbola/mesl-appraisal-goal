<?php

namespace MESL\Http\Controllers;

use MESL\AccountCategory;
use MESL\AccountGroup;
use Illuminate\Http\Request;

class AccountGroupController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        $account_categories = AccountCategory::all();
        $account_groups = AccountGroup::all();
        return view('account_groups.create', compact('account_groups', 'account_categories'));
    }


    public function store(Request $request)
    {
        $account_group = new AccountGroup($request->all());
        $this->validate($request, [
            'AccountGroup' => 'required',
        ]);
        if ($account_group->save()) {
            return redirect()->route('account-group.create')->with('success', 'Account Group was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Account Group failed to save');
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $account_categories = AccountCategory::all();
        $account_category   = AccountCategory::where('AccountCategoryRef', $id)->first();
        // return dd($TradeRef);
        return view('account_categories.edit', compact('account_category', 'account_categories'));
    }


    public function update(Request $request, $id)
    {
        $account_category = \DB::table('tblAccountCategory')->where('AccountCategoryRef', $id);
        if ($account_category->update($request->except(['_token', '_method']))) {
            return redirect()->route('account-categories.create')->with('success', 'AccountCategory was updated successfully');
        } else {
            return back()->withInput()->with('error', 'AccountCategory failed to update');
        }
    }


    public function destroy($id)
    {
        //
    }
}
