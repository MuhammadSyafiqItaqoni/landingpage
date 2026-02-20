<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index() {
        $user = Auth::user();
        $services = Service::all();
        
        return view('services.index', [
            "services" => $services,
            "username" => $user->name // Lebih simpel panggil properti object
        ]);
    }

    public function create() {
        return view('services.create', [
            "username" => Auth::user()->name
        ]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('service-images', 'public');
            $data['image'] = $imagePath;
        }

        Service::create($data);

        return redirect()->route('service.index')->with('success', 'Berhasil menambahkan data service');
    }

    public function edit($id) {
        $service = Service::findOrFail($id);
        return view('services.edit', [
            "username" => Auth::user()->name,
            "service" => $service
        ]);
    }

    public function update(Request $request, $id) {
        $service = Service::findOrFail($id);
        
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if($request->hasFile('image')){
            // 1. Hapus gambar lama dari storage jika ada file baru
            if($service->image && Storage::disk('public')->exists($service->image)){
                Storage::disk('public')->delete($service->image);
            }
            
            // 2. Upload gambar baru
            $imagePath = $request->file('image')->store('service-images', 'public');
            $data['image'] = $imagePath;
        } else {
            // 3. Jika tidak ada file baru, tetap gunakan path gambar lama
            $data['image'] = $service->image;
        }

        // Gunakan update dengan data yang sudah tervalidasi
        $service->update($data);

        return redirect()->route('service.index')->with('success', 'Berhasil mengubah data service');
    }

    public function destroy($id) {
        $service = Service::findOrFail($id);
        
        // Hapus file fisik gambar dari storage
        if($service->image && Storage::disk('public')->exists($service->image)){
            Storage::disk('public')->delete($service->image);
        }
        
        $service->delete();

        return redirect()->route('service.index')->with('success', 'Berhasil menghapus data service');
    }
}