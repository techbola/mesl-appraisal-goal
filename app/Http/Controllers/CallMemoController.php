<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\CallMemo;
use Cavidel\Customer;

class CallMemoController extends Controller
{
  public function view($id)
  {
    $contact = Customer::find($id);
    return view('call_memo.view', compact('contact'));
  }

  public function create($id)
  {
    $contact = Customer::find($id);
    return view('call_memo.create', compact('contact'));
  }

}
