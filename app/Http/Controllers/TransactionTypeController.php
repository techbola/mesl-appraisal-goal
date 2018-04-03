<?php

namespace App\Http\Controllers;

use App\TradeType;
use Illuminate\Http\Request;

class TransactionTypeController extends Controller
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
        return view('transaction_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $trade_type = new TradeType($request->all());
        $this->validate($request, [
            'Description' => 'required',
        ]);
        if ($trade_type->save()) {
            return redirect()->route('transaction_types.create')->with('success', 'Transaction Type was added successfully');
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
        $tradetype = \DB::table('tblTradeTypes')->where('TradeTypeRef', $id)->first();
        return view('tradetypes.edit', compact('tradetype'));
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
        $tradetype = \DB::table('tblTradeTypes')->where('TradeTypeRef', $id);
        if ($tradetype->update($request->except(['_token', '_method']))) {
            return redirect('/tradetypes/create')->with('success', 'Trade Type has been updated successfully.');
        } else {
            return redirect('/tradetypes/create')->withInput()->with('danger', 'Trade Type update failed');
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
