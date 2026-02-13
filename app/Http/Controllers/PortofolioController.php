<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portofolio;
use Illuminate\Support\Facades\Auth;

class PortofolioController extends Controller
{
    public function view(){
        $user = Auth::user();
        $portofolios = Portofolio::all();
        
        return view('portofolio.index', [
            "portofolios" => $portofolios,
            "username" => $user['name']
        ]);
    }

    public function create(){
        return view('portofolio.create', [
            "username" => Auth::user()['name']
        ]);
    }

    public function store(Request $request){
        $validator = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
        ]);

        if(request()->hasFile('image')){
            $imagePath = request()->file('image')->store('portofolio-images', 'public');
            $validator['image'] = $imagePath;
        }

        $portofolio = Portofolio::create($validator);

        return redirect()->route('portofolio.index')->with('success', 'Berhasil menambahkan data');

    }
}
