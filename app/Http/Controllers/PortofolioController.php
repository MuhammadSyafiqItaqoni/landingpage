<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portofolio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function edit(Portofolio $portofolio){
        $user = Auth::user();
        return view('portofolio.edit', [
            "username" => $user['name'],
            "portofolio" => $portofolio
        ]);
    }

    public function update(Request $request, Portofolio $portofolio){
        $validator = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        if(request()->hasFile('image')){
            if($portofolio->image && Storage::disk('public')->exists($portofolio->image)){
                Storage::disk('public')->delete($portofolio->image);
            }
            $imagePath = request()->file('image')->store('portofolio-images', 'public');
            $validator['image'] = $imagePath;
        }

        $portofolio->update($validator);
 
        return redirect()->route('portofolio.index')->with('success', 'Berhasil mengubah data');
    }

    public function destroy(Portofolio $portofolio){
        if($portofolio->image && Storage::disk('public')->exists($portofolio->image)){
            Storage::disk('public')->delete($portofolio->image);
        }
        $portofolio->delete();

        return redirect()->route('portofolio.index')->with('success', 'Berhasil menghapus data');
    }
}