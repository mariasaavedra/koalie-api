<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Socialite;
use Exception;
use Auth;


class FacebookController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
        try {
            
            //$user = Socialite::driver('facebook')->user();
            $facebook_user = Socialite::driver('facebook')->stateless()->user();

            $user = User::query()->firstOrNew(['email' => $facebook_user->getEmail()]);

            if (!$user->exists) {
                return User::create([
                    'name' => $facebook_user['name'],
                    'email' => $facebook_user['email']
                ]);
            }

        } catch (Exception $e) {
            return redirect('auth/facebook');
        }
    }
}