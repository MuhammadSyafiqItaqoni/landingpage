<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portofolio;

class HomeController extends Controller
{
    public function view(){
        $portofolio = Portofolio::all();
        return view('index', [
            "portofolios" => $portofolio
        ]);
    }
}
