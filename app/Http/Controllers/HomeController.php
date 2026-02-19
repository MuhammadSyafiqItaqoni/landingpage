<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portofolio;
use App\Models\Hero;

class HomeController extends Controller
{
    public function index(){
        $portofolios = Portofolio::all();
        $hero = Hero::first();
        return view('index', [
            "portofolios" => $portofolios,
            "hero" => $hero
        ]);
    }
}