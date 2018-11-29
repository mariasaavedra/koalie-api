<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Socialite;
use Exception;


class FacebookController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
   /* public function redirect()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }*/


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function callback(Request $request)
    {
            //$user = Socialite::driver('facebook')->user();

            //$facebook_user = Socialite::driver('facebook')->stateless()->user();
            $access_token = $request->input('token');
            $facebook_user = Socialite::driver('facebook')->stateless()->userFromToken($access_token);
            

            $user = User::query()->firstOrNew(['email' => $facebook_user->getEmail()]);

            if (!$user->exists) {
                $user = User::create([
                    'name' => $facebook_user->getName(),
                    'email' => $facebook_user->getEmail(),
                    'facebook_id' => $facebook_user->getId(),
                    'avatar_url' => $facebook_user->getAvatar()
                ]);
            }

            $token =  $user->createToken('MyApp')->accessToken; 
            return response()->json(['token' => $token], 200); 
    }
}