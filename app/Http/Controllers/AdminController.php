<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function view(){
        $user = auth::user();

        return view('admin', ["username" => $user['name']]);
    }
}
