<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Portofolio;
use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {
        $portofolios = Portofolio::all();
        $hero = Hero::first();
        $services = Service::all();

        return view('index', [
            'portofolios' => $portofolios,
            'hero' => $hero,
            'services' => $services,
        ]);
    }

    // public function index()
    // {
    //     return view('index', [
    //         'portofolios' => \App\Models\Portofolio::all(),
    //         'hero' => \App\Models\Hero::first(),
    //         'services' => \App\Models\Service::all(), // Mengambil data service untuk ditampilkan di depan
    //     ]);
    // }
}
