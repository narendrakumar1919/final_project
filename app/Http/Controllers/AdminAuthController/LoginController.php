<?php

namespace App\Http\Controllers\AdminAuthController;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function loginShow()
    {
        if(Auth::guard('admin')->check()){

            return redirect()->route('admin.dashboard');
        }
        else{
        return view('admin.auth.login');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(LoginRequest $request)
    {
        $inputs=$request->validated();
        if (Auth::guard('admin')->attempt($inputs)) {
            $adminName = Auth::guard('admin')->user();
            session(['adminName' => $adminName->name]);
            return redirect()->route('admin.dashboard');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email')->with('error', 'incorrect password');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admins.loginShow');
    }
}
