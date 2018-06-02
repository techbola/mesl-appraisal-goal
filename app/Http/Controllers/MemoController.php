<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;

class MemoController extends Controller
{

    public function index()
    {
        $memos = Memo::all();
        return view('memos.index', compact('memos'));
    }

    public function create()
    {
        $employees = Staff::get('UserID');
        return view('memos.create', compact('employees'))
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'subject'         => 'required',
            'purpose'         => 'required',
            'request_type_id' => 'required',
            'body'            => 'required',
            '',
        ], [
            'request_type_id.required' => 'Choosing a request type is compulsory',
        ]);
        $new_memo = new Memo($request->all());
        if ($new_memo->save()) {
            return reirect()->route()->with('success', 'Memo was created successfully. <a href="' . route('memos.index') . '">Go to queue</a>');
        }
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
