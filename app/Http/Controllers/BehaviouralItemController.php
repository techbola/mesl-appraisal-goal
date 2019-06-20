<?php

namespace MESL\Http\Controllers;

use MESL\BehaviouralItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BehaviouralItemController extends Controller
{

    public function store(Request $request)
    {

        $this->validate($request, [
            'behaviouralItem' => 'required|string',
            'behaviouralCat_id' => 'required',
            'weight' => 'required|numeric',
            'level_id' => 'required|string',
        ]);

        $behavioural_item = new BehaviouralItem();

        $behavioural_item->behaviouralItem = $request->behaviouralItem;
        $behavioural_item->behaviouralCat_id = $request->behaviouralCat_id;
        $behavioural_item->weight = $request->weight;
        $behavioural_item->level_id = $request->level_id;
        $behavioural_item->save();

        Session::flash('success', 'Behavioural Item Created.');

        return back();

    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {

        $behavioural_item = BehaviouralItem::find($id);
        $behavioural_item->delete();

        Session::flash('success', 'Behavioural Item Deleted.');

        return back();

    }
}
