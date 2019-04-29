<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use MESL\User;
use MESL\Company;
use MESL\Role;
use MESL\UserType;
use MESL\Staff;
use DB, Hash, Auth, Event;
use Notification;
use MESL\Http\Requests\ValidateSecretRequest;
use MESL\Notifications\EmailActivation;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Spatie\Activitylog\Models\Activity;
use MESL\Events\LogoutEvent;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function login()
    {
        // return view('auth.login');
        return view('auth.new-login');
    }
    public function post_login(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->where('is_activated', '0')->first();

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_activated' => '1', 'is_disengaged' => '0'])) {

            $user_logged = User::where('email', $request->email)->first();
            // Activity
            activity()->performedOn($user_logged)->causedBy($user_logged)->log('Logged In');

            if ($user_logged->google2fa_secret) {
                Auth::logout();

                $request->session()->put('2fa:user:id', $user_logged->id);

                return redirect('2fa/validate');
            } else {
                return redirect()->intended('/');
            }

        } elseif ($user) {
            return redirect()->back()->withErrors('Your account has not been activated.');
        } else {
            return redirect()->back()->withErrors('The credentials do not match our records.');
        }
    }

    public function register_company(Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required|string|max:255',
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'email'        => 'required|string|email|max:255|unique:users',
            'password'     => 'required|string|min:4|confirmed',
            'phone'        => 'required|unique:tblStaff,MobilePhone',
            // 'gender' => 'required|integer',
        ]);

        try {
            DB::beginTransaction();
            $company          = new Company;
            $company->Company = $request->company_name;
            $company->Slug    = str_slug($request->company_name);
            $company->save();

            $user             = new User;
            $user->first_name = $request->first_name;
            $user->last_name  = $request->last_name;
            $user->email      = $request->email;
            $user->password   = bcrypt($request->password);
            $user->code       = uniqid();
            $user->save();

            $staff              = new Staff;
            $staff->UserID      = $user->id;
            $staff->CompanyID   = $company->CompanyRef;
            $staff->MobilePhone = $request->phone;
            $staff->save();

            // $role = new Role;
            // $role->name = 'admin';
            // $role->display_name = 'Admin';
            // $role->description = 'Company Admin';
            // $role->CompanyID = $company->CompanyRef;
            // $role->save();

            $role = Role::where('name', 'admin')->first();
            $user->roles()->attach($role->id);
            // $type = UserType::where('name', 'admin')->first();
            // $user->types()->attach($type->id);

            // Auth::login($user, true);
            DB::commit();
            Notification::send($user, new EmailActivation());

            return redirect()->back()->with('success2', 'An activation email has been sent to ' . $user->email . '. Click the button in the email to activate your account.');
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
                return redirect()->route('activate_pass', ['id' => $id, 'code' => $code])->with('notice', 'Please change your password to activate your account.');
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
            $user->password         = bcrypt($request->new_password);
            $user->is_activated     = '1';
            $user->changed_password = '1';
            $user->save();
            return redirect()->route('login')->with('success2', 'Password changed successfully. Your account has been activated, please login to continue.');
        } else {
            return redirect()->back()->with('error', 'Current password is wrong.');
        }
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->google2fa_secret) {
            Auth::logout();

            $request->session()->put('2fa:user:id', $user->id);

            return redirect('2fa/validate');
        }

        return redirect()->intended($this->redirectTo);
    }

    public function getValidateToken()
    {
        if (session('2fa:user:id')) {
            return view('2fa/index');
        }

        return redirect('login');
    }

    public function postValidateToken(ValidateSecretRequest $request)
    {
        //get user id and create cache key
        $userId = $request->session()->pull('2fa:user:id');
        $key    = $userId . ':' . $request->totp;

        //use cache to store token to blacklist
        \Cache::add($key, true, 4);

        //login and redirect user
        Auth::loginUsingId($userId);

        return redirect()->intended($this->redirectTo);
    }

    public function logout()
    {
        // Activity
        // activity()->performedOn(auth()->user())->causedBy(auth()->user())->log('Logged Out');
        $user = auth()->user();
        Auth::logout();
        Event::fire(new LogoutEvent($user));
        return redirect('/login');
    }

    public function timeout()
    {
        // Activity
        // activity()->performedOn()->log('Timed Out');

        Auth::logout();
        return redirect('/login?timedout=true')->withErrors('You were timedout due to inactivity');
    }

}
