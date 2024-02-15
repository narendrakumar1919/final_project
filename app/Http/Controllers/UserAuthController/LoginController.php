<?php

namespace App\Http\Controllers\UserAuthController;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function loginShow()
    {
        if(Auth::guard('web')->check()){

            return redirect()->route('users.dashboardShow');
        }
        else{
        return view('user.auth.login');
        }
    }


    public function login(LoginRequest $request)
    {

        $validateData=$request->validated();
        if(Auth::guard('web')->attempt($validateData))

        {
            return redirect()->route('users.dashboardShow');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email')->with('error','incorrect password');

     }

}
