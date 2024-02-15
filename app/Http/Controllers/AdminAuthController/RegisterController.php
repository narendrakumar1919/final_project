<?php

namespace App\Http\Controllers\AdminAuthController;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::guard('admin')->check()){

            return redirect()->route('admin.dashboard');
        }
        else{
        return view('admin.auth.register');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        $input=$request->validated();
        $input['password']= Hash::make($input['password']);

        $admin=Admin::create($input);
        return redirect()->route('admins.loginShow');
    }


}
