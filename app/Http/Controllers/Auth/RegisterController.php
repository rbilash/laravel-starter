<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Mail\VerifyMail;
use App\Mail\ResendVerifyMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'verification_token' => sha1(microtime()),
        ]);
        Mail::to($user->email)->send(new VerifyMail($user));
        return $user;
    }

    public function verifyUser($token)
    {
        $user = User::where('verification_token', $token)->first();
        if(isset($user) ){
            $status = __('auth.alreadyVerified');
            if (empty($user->verified_at)) {
                $user->verified_at = Carbon::now();
                $user->save();
                $status = __('auth.verified');
            }
        } else {
            return redirect('/login')->with('warning',
                __('auth.errorVerified', [
                    'link' => route('email.verifyForm')
                ])
            );
        }

        return redirect('/login')->with('status', $status);
    }

    public function showResendVerificationForm()
    {
        return view('admin.verification');
    }

    public function resendVerificationEmail(Request $request)
    {
        $email = $request->input('email');
        $status = __('auth.verificationSent');
        $user = User::where('email', $email)->first();
        if(isset($user) ){
            $user->verification_token = sha1(microtime());
            $user->save();
            Mail::to($user->email)->send(new ResendVerifyMail($user));
        }
        return redirect('/login')->with('status', $status);
    }

    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        return redirect('/login')->with('status', __('auth.verificationSent'));
    }
}
