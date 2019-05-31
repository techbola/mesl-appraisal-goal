<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use MESL\Country;
use MESL\Holiday;

class HolidayController extends Controller
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
        $holidays  = Holiday::all();
        return view('holidays.create', compact('holidays', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $holiday = new Holiday($request->all());
        $this->validate($request, [
            'Holiday' => 'required',
        ]);
        if ($holiday->save()) {
            return redirect()->route('holidays.create')->with('success', 'Holiday was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Holiday failed to save');
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
        $holidays = Holiday::all();
        $holiday  = Holiday::where('HolidayRef', $id)->first();
        // return dd($TradeRef);
        return view('holidays.edit', compact('holiday', 'holidays'));
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
        $holiday = Holiday::find($id);
        if ($holiday->update($request->all())) {
            return redirect()->route('holidays.create')->with('success', 'Holiday was updated successfully');
        } else {
            return back()->withInput()->with('error', 'Holiday failed to update');
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
