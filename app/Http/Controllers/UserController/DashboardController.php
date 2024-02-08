<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function dashboard()
    {
        return view('user.dashboard');
    }


}
