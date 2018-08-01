<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\Customer;

class CustomerController extends Controller
{

  public function get_customer($id)
  {
    $customer = Customer::find($id);
    return $customer;
  }

}
