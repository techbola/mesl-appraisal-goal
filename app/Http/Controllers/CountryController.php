<?php

namespace Cavi\Http\Controllers;

use Cavi\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
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
        $countries = Country::all();
        return view('countries.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country = new Country($request->all());
        $this->validate($request, [
            'Country' => 'required',
        ]);
        if ($country->save()) {
            return redirect()->route('countries.create')->with('success', 'Country was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Country failed to save');
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
        $countries = Country::all();
        $country   = Country::where('CountryRef', $id)->first();
        // return dd($TradeRef);
        return view('countries.edit', compact('country', 'countries'));
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
        $country = \DB::table('tblCountry')->where('CountryRef', $id);
        if ($country->update($request->except(['_token', '_method']))) {
            return redirect()->route('countries.create')->with('success', 'Country was updated successfully');
        } else {
            return back()->withInput()->with('error', 'Country failed to update');
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
