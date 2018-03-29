<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;


class OAuthController extends Controller
{

    protected $redirectTo = '/home';

    public function providerRedirect($provider)
    {
        return \Socialite::driver($provider)->redirect();
    }

    public function providerCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);
        auth()->login($authUser, true);
        return redirect($this->redirectTo);
    }

    private function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_uid', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id,
            'verification_token' => sha1(microtime()),
            'verified_at' => Carbon::now()
        ]);
    }
}
