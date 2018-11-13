<?php

namespace Cavi\Http\Controllers;

use Illuminate\Http\Request;
use Cavi\Customer;

class CustomerController extends Controller
{

  public function get_customer($id)
  {
    $customer = Customer::find($id);
    return $customer;
  }

}
