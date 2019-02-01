<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use MESL\Customer;

class CustomerController extends Controller
{

    public function get_customer($id)
    {
        $customer = Customer::find($id);
        return $customer;
    }

    public function ajax_store(Request $request)
    {
        $customer = new Customer($request->all());
        $customer->save();
        return response()->json(['success' => true, 'data' => $customer], 200);
    }

}
