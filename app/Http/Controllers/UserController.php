<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\User;

class UserController extends Controller
{

  public function edit_profile()
  {
    $user = auth()->user();

    $staff = Staff::where('UserID', $user->id)->first();

    // return view('staff.edit_profile');
  }

public function disengage($id)
{
  $this->authorize('company-admin');
  $user = User::find($id);
  if ($user->hasRole('admin')) {
    return redirect()->back()->with('error', 'Cannot disengage an admin.');
  }
  $user->delete();
  $user->staff->delete();

  return redirect()->back()->with('success', $user->FullName.' was disengaged successfully');
}

public function restore($id)
{
  $this->authorize('company-admin');
  $user = User::withTrashed()->where('id', $id)->first();
  $user->restore_user();
  $user->staff->restore_user();

  return redirect()->back()->with('success', $user->FullName.' was re-engaged successfully');
}

}
