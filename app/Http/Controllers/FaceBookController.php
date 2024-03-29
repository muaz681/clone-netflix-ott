<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Member;


class FaceBookController extends Controller
{
   /**
 * Login Using Facebook
 */
 public function loginUsingFacebook()
 {
    
    return Socialite::driver('facebook')->redirect();
 }

 public function callbackFromFacebook()
 {
    try {
        $user = Socialite::driver('facebook')->user();

        $saveUser = Member::updateOrCreate([
            'facebook_id' => $user->getId(),
        ],[
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => Hash::make($user->getName().'@'.$user->getId())
                ]);

        Auth::loginUsingId($saveUser->id);

        return redirect()->intended(route('member.auth.profile',app()->getLocale()));

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
