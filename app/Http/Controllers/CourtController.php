<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Validator, DB;
use Cavidel\Court;
class CourtController extends Controller
{
    public function index()
    {

    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $court     = new Court($request->all());
        $validator = Validator::make($request->all(), [
            'Court'    => 'required',
            'Location' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->messages()->all()], 500);
        } else {
            if ($court->save()) {
                return response()->json(['success' => true, 'data' => $court, 'message' => 'Court was added'], 200);
            }

        }
    }
}
