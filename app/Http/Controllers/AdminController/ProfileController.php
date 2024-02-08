<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Services\ProfileService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $profileService;
    function __construct() {
        $this->profileService = new ProfileService;
    }
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
        $validateData=$request->validated();
        if($validateData){
          $data=$this->profileService->update($validateData,$id);
          if($data){
          return redirect()->back()->with('success', "Updated");
          }else{
            return redirect()->back()->with('error', "Not-Updated");
          }
        }else{
        return back()->withErrors([
            'email' => 'Email is already registered',
        ])->withInput();
        }

    }


    public function updatePassword(PasswordUpdateRequest $request, string $id)
    {
        $validateData=$request->validated();
        $validateData['password']=Hash::make($validateData['password']);
        $data=$this->profileService->updatePassword($validateData,$id);
        if($data){
        return redirect()->back()->with('success', "Updated");
        }else{
            return redirect()->back()->with('error', "Not-Updated");
        }
    }

}
