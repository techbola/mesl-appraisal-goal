<?php

namespace App\Http\Controllers;

use App\AccountCategory;
use Illuminate\Http\Request;

class AccountCategoryController extends Controller
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
        $account_categories = AccountCategory::all();
        return view('account_categories.create', compact('account_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $account_category = new AccountCategory($request->all());
        $this->validate($request, [
            'AccountCategory' => 'required',
        ]);
        if ($account_category->save()) {
            return redirect()->route('account-categories.create')->with('success', 'AccountCategory was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'AccountCategory failed to save');
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
        $account_categories = AccountCategory::all();
        $account_category   = AccountCategory::where('AccountCategoryRef', $id)->first();
        // return dd($TradeRef);
        return view('account_categories.edit', compact('account_category', 'account_categories'));
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
        $account_category = \DB::table('tblAccountCategory')->where('AccountCategoryRef', $id);
        if ($account_category->update($request->except(['_token', '_method']))) {
            return redirect()->route('account-categories.create')->with('success', 'AccountCategory was updated successfully');
        } else {
            return back()->withInput()->with('error', 'AccountCategory failed to update');
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
