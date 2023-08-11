<?php

namespace App\Http\Controllers;

use App\Helpers\StringHelper;
use App\Http\Requests\RegisterPromoterRequest;
use App\Models\Promoter;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PromoterAuthController extends Controller
{
    public function register(){
        return view('promoter.auth.register');
    }

    public function registerAction(RegisterPromoterRequest $request): RedirectResponse
    {
        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->is_promoter = 1;
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $promoter = new Promoter();
        $promoter->user_id = $user->id;
        $promoter->company_name = $request->input('company_name');
        $promoter->slug = StringHelper::generateSlug($request->input('company_name'));
        $promoter->save();

        return redirect('/login')->with('status', 'Thank you for joining us, lets grow together');
    }
}
