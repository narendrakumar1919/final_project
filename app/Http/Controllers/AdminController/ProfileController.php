<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function profileShow()
    {
        $data = Auth::guard('admin')->user();
        return view('admin.profile.profile',['data'=>$data]);
    }


    public function updatePasswordShow()
    {
        $data = Auth::guard('admin')->user();
        return view('admin.profile.setting',['data'=>$data]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function updateProfile(ProfileUpdateRequest $request, string $id)
    {
        if($request){
        $product=admin::where('id',$id)->update([
            'name' => $request->name,
            'email'=>$request->email,
            'mobile' => $request->mobile,
        ]);
        return redirect()->back()->with('success', "Updated");
        }else{
        return back()->withErrors([
            'email' => 'Email is already registered',
        ])->withInput();
        }

    }


    public function updatePassword(PasswordUpdateRequest $request, string $id)
    {
        $product=admin::where('id',$id)->update([
            'password'=>Hash::make($request->password),
            'confirm_password'=>Hash::make($request->confirm_password),
        ]);
        return redirect()->back()->with('success', "Updated");
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
