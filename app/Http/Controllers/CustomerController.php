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

}
