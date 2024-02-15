<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function dashboard()
    {
        // dd("dghasf");
        return view('admin.dashboard');
    }


}
