<?php

namespace App\Http\Controllers\UserAuthController;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::guard('web')->check()){

            return redirect()->route('users.dashboardShow');
        }
        else{
        return view('user.auth.register');
        }
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(RegisterRequest $request)
    {
        $input=$request->validated();
        $input['password']= Hash::make($input['password']);
        $user=User::create($input);
        return redirect()->route('users.loginShow');
    }

}
