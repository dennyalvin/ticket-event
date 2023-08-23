<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerAction(RegisterUserRequest $request): RedirectResponse
    {
        $user = new User;
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect('login')->with('status', 'Congratulations, your account has successfully created');
    }

    public function login(): View
    {
        return view('auth.login');
    }

    public function loginAction(LoginUserRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = User::where(['email' => $email])->first();

            Session::put([
                'user_id' => $user->id,
                "first_name" => $user->first_name,
                "promoter" => $user->is_promoter,
            ]);

           if(!empty(session('link'))) {
               $sess = session('link');
               session()->forget(['link']);
               return redirect($sess);
           }

            return redirect()->intended('/');
        }

        return $this->login()->withErrors(['message' => 'Failed to login, please check your email or password']);
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['user_id', 'first_name', 'promoter', 'link']);

        return redirect('')->with('success_message', 'Successfully logout');
    }
}
