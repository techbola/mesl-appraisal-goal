<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Company;
use App\Role;
use App\UserType;
use App\Staff;
use DB;
use Hash;
use Notification;
use App\Notifications\EmailActivation;
use Auth;

class LoginController extends Controller
{

  public function login()
  {
    return view('auth.login');
  }
  public function post_login(Request $request)
  {
    $this->validate($request, [
        'email'     => 'required',
        'password'     => 'required',
    ]);

    $user = User::where('email', $request->email)->where('is_activated', '0')->first();

    if (Auth::attempt(['email'=>$request->email, 'password'=>$request->password, 'is_activated'=>'1'])) {
      return redirect()->intended('/');
    } elseif($user) {
      return redirect()->back()->withErrors('Your account has not been activated.');
    }
    else {
      return redirect()->back()->withErrors('The credentials do not match our records.');
    }
  }

  public function register_company(Request $request)
  {
    $this->validate($request, [
        'company_name'     => 'required|string|max:255',
        'first_name'     => 'required|string|max:255',
        'last_name'     => 'required|string|max:255',
        'email'    => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:4|confirmed',
        'phone' => 'required|unique:tblStaff,MobilePhone',
        // 'gender' => 'required|integer',
    ]);

    try {
      DB::beginTransaction();
      $company = new Company;
      $company->Company = $request->company_name;
      $company->Slug = str_slug($request->company_name);
      $company->save();


      $user = new User;
      $user->first_name = $request->first_name;
      $user->last_name = $request->last_name;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->code = uniqid();
      $user->save();

      $staff = new Staff;
      $staff->UserID = $user->id;
      $staff->CompanyID = $company->CompanyRef;
      $staff->MobilePhone = $request->phone;
      $staff->save();


      $role = new Role;
      $role->name = 'admin';
      $role->display_name = 'Admin';
      $role->description = 'Company Admin';
      $role->CompanyID = $company->CompanyRef;
      $role->save();

      // $role = Role::where('name', 'admin')->first();
      $user->roles()->attach($role->id);
      // $type = UserType::where('name', 'admin')->first();
      // $user->types()->attach($type->id);

      // Auth::login($user, true);
      DB::commit();
      Notification::send($user, new EmailActivation());

      return redirect()->back()->with('success2', 'An activation email has been sent to '.$user->email.'. Click the button in the email to activate your account.');
    } catch (Exception $e) {
      DB::rollback();
      return redirect()->back()->with('error', 'Your account could not be created at this time.');
    }

  }

  public function activate($id, $code)
  {
    Auth::logout();
    $user = User::where('id', $id)->where('code', $code)->first();

    if (!empty($user)) {
      if (!$user->changed_password) {
        return redirect()->route('activate_pass', ['id'=>$id, 'code'=>$code])->with('notice', 'Please change your password to activate your account.');
      }
      $user->is_activated = '1';
      $user->save();
      return redirect('login')->with('success2', 'Account activated successfully. Please login to continue.');
    } else {
      return redirect('login')->with('danger2', 'Invalid activation link. Please try logging in.');
    }

  }

  public function activate_pass($id, $code)
  {
    $user = User::where('id', $id)->where('code', $code)->first();
    return view('users.activate_pass', compact('user', 'id', 'code'));
  }

  public function activate_pass2(Request $request, $id, $code)
  {
    $user = User::where('id', $id)->where('code', $code)->first();

    $this->validate($request, [
      'old_password' => 'required',
      'new_password' => 'required|confirmed',
    ]);
    if (Hash::check($request->old_password, $user->password)) {
      $user->password = bcrypt($request->new_password);
      $user->is_activated = '1';
      $user->changed_password = '1';
      $user->save();
      return redirect()->route('login')->with('success2', 'Password changed successfully. Your account has been activated, please login to continue.');
    } else {
      return redirect()->back()->with('error', 'Current password is wrong.');
    }
  }


}
