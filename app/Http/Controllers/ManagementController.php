<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function attendance()
    {
        return view('layouts.attendance');
    }
}
