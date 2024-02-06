<?php

namespace App\Http\Controllers\AdminAuthController;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(LoginRequest $request)
    {
        $request=$request->validated();

        if (Auth::guard('admin')->attempt(['email' => $request['email'], 'password' => $request['password']])) {
            $adminName = Auth::guard('admin')->user();
            session(['adminName' => $adminName->name]);
            return redirect()->route('admin.dashboard');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email')->with('error', 'incorrect password');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
