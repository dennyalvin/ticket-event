<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallBack()
    {
        try {
            $user = Socialite::driver('google')->user();

            $find_user = User::where('google_id', $user->id)->first();
            if ($find_user) {
                Auth::login($find_user);
                Session::put([
                    'user_id' => $find_user->id,
                    "first_name" => $find_user->first_name,
                    "promoter" => $find_user->is_promoter,
                ]);

                return redirect()->route('event.list');
            } else {
                $find_by_email = User::where('email', $user->email)->first();

                if(!$find_by_email) {
                    $find_by_email = new User();
                    $find_by_email->google_id = $user->id;

                    $find_by_email->first_name = $user->user['given_name'];
                    $find_by_email->last_name = $user->user['family_name'];
                    $find_by_email->email = $user->email;
                }

                $find_by_email->google_id = $user->id;
                $find_by_email->save();

                Auth::login($find_by_email);

                Session::put([
                    'user_id' => $find_by_email->id,
                    "first_name" => $find_by_email->first_name,
                    "promoter" => $find_by_email->is_promoter,
                ]);

                return redirect()->intended('/');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
