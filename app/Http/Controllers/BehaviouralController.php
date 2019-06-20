<?php

namespace MESL\Http\Controllers;

use MESL\Behavioural;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BehaviouralController extends Controller
{

    public function store(Request $request)
    {

        $this->validate($request, [
           'name' => 'required|string'
        ]);

        $behavioural = new Behavioural();

        $behavioural->behaviouralCat = $request->name;
        $behavioural->save();

        Session::flash('success', 'Behavioural Created.');

        return back();

    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required|string'
        ]);

        $behavioural = Behavioural::find($id);

        $behavioural->behaviouralCat = $request->name;
        $behavioural->save();

        Session::flash('success', 'Behavioural Updated.');

        return back();

    }

    public function destroy($id)
    {

        $behavioural = Behavioural::find($id);
        $behavioural->delete();

        Session::flash('success', 'Behavioural Deleted.');

        return back();

    }

}
