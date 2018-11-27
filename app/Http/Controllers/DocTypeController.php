<?php

namespace MESL\Http\Controllers;

use MESL\DocType;
use Illuminate\Http\Request;

class DocTypeController extends Controller
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
        $DocTypes = DocType::all();
        return view('doctypes.create', compact('DocTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $DocType = new DocType($request->all());
        $this->validate($request, [
            'DocType' => 'required',
        ]);
        if ($DocType->save()) {
            return redirect()->route('doctypes.create')->with('success', 'DocType was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'DocType failed to save');
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
        $DocTypes = DocType::all();
        $DocType   = DocType::where('DocTypeRef', $id)->first();
        // return dd($TradeRef);
        return view('doctypes.edit', compact('DocType', 'DocTypes'));
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
        $DocType = \DB::table('tblDocType')->where('DocTypeRef', $id);
        if ($DocType->update($request->except(['_token', '_method']))) {
            return redirect()->route('doctypes.create')->with('success', 'DocType was updated successfully');
        } else {
            return back()->withInput()->with('error', 'DocType failed to update');
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
