<?php

namespace App\Http\Controllers\UserAuthController;

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
        if(Auth::guard('web')->check()){

            return redirect()->route('users.dashboardShow');
        }
        else{
        return view('user.auth.login');
        }
    }


    public function login(LoginRequest $request)
    {

        $request=$request->validated();
        if(Auth::guard('web')->attempt(['email'=>$request['email'],'password'=>$request['password']]))

        {
            return redirect()->route('users.dashboardShow');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email')->with('error','incorrect password');

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
    public function store(Request $request)
    {

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
    public function destroy(string $id)
    {
        //
    }
}
