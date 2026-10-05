<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserbookingController extends Controller
{
 
    public function index()
    {
        return view('ui.userbooking');
    }
}
