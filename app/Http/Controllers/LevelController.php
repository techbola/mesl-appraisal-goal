<?php

namespace MESL\Http\Controllers;

use MESL\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LevelController extends Controller
{

    public function index()
    {

        $levels = Level::all();

        return view('hr.levels')->with([
            'levels' => $levels,
        ]);

    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string'
        ]);

        $level = new Level();

        $level->name = $request->name;
        $level->save();

        Session::flash('success', 'Level Created.');

        return back();

    }

    public function update(Request $request, Level $level)
    {

        $this->validate($request, [
            'name' => 'required|string'
        ]);

        $level->name = $request->name;
        $level->save();

        Session::flash('success', 'Level Updated.');

        return back();

    }

    public function destroy(Level $level)
    {

        $level->delete();

        Session::flash('success', 'Level Deleted.');

        return back();

    }

}
