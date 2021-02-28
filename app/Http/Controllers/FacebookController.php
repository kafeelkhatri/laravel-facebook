<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
        return Socialite::driver('facebook')->redirect();
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
            $user = Socialite::driver('facebook')->user();
            $create['name'] = $user->getName();
            $create['email'] = $user->getEmail();
            $create['facebook_id'] = $user->getId();
            $create['password']=bcrypt('123456');

            $userModel = new User;
            $createdUser = $userModel->addNew($create);
            Auth::loginUsingId($createdUser->id);


            return redirect()->route('home');

    }
}