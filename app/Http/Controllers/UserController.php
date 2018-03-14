<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

  public function edit_profile()
  {
    $user = auth()->user();

    $staff = Staff::where('UserID', $user->id)->first();

    // return view('staff.edit_profile');
  }

}
