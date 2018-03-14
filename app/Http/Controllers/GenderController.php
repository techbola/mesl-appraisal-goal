<?php

namespace App\Http\Controllers;

use App\Gender;
use Illuminate\Http\Request;

class GenderController extends Controller
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
        $genders = Gender::all();
        return view('genders.create', compact('genders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gender = new Gender($request->all());
        $this->validate($request, [
            'Gender' => 'required',
        ]);
        if ($gender->save()) {
            return redirect()->route('genders.create')->with('success', 'Gender was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gender failed to save');
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
        $genders = Gender::all();
        $gender   = Gender::where('GenderRef', $id)->first();
        // return dd($TradeRef);
        return view('genders.edit', compact('gender', 'genders'));
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
        $gender = \DB::table('tblGender')->where('GenderRef', $id);
        if ($gender->update($request->except(['_token', '_method']))) {
            return redirect()->route('genders.create')->with('success', 'Gender was updated successfully');
        } else {
            return back()->withInput()->with('error', 'Gender failed to update');
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
