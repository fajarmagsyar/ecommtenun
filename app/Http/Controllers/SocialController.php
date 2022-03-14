<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    //
    function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function Callback($provider)
    {
        $userSocial = Socialite::driver($provider)->user();
        // dd($userSocial);
        $users = Customer::where(['email' => $userSocial->getEmail()])->first();
        if ($users) {
            Auth::login($users);
            return redirect('/');
        } else {
            $user = Customer::create([
                'nama_customer' => $userSocial->getName(),
                'email' => $userSocial->getEmail(),
                'username' => $userSocial->getEmail(),
                'status' => 1,
                'role' => 0,
            ])->getAttributes();
            $users = Customer::where(['email' => $user['email']])->first();

            Auth::login($users);

            return redirect('/');
        }
    }
}
