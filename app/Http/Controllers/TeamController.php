<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class TeamController extends Controller
{
    public function index() {
        $user = Auth::user();
        $Teams = Team::all();
        
        return view('team.index', [
            "teams" => $Teams,
            "username" => $user->name // Lebih simpel panggil properti object
        ]);
    }

    public function create() {
        return view('team.create', [
            "username" => Auth::user()->name
        ]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'twitter' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
        ]);

        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('teams-images', 'public');
            $data['image'] = $imagePath;
        }

        Team::create($data);

        return redirect()->route('team.index')->with('success', 'Berhasil menambahkan data service');
    }

    public function edit($id) {
        $team = Team::findOrFail($id);
        return view('team.edit', [
            "username" => Auth::user()->name,
            "team" => $team,
        ]);
    }

    public function update(Request $request, $id) {
        $team = Team::findOrFail($id);
        
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'twitter' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
        ]);

        if($request->hasFile('image')){
            // 1. Hapus gambar lama dari storage jika ada file baru
            if($team->image && Storage::disk('public')->exists($team->image)){
                Storage::disk('public')->delete($team->image);
            }
            
            // 2. Upload gambar baru
            $imagePath = $request->file('image')->store('teams-images', 'public');
            $data['image'] = $imagePath;
        } else {
            // 3. Jika tidak ada file baru, tetap gunakan path gambar lama
            $data['image'] = $team->image;
        }

        // Gunakan update dengan data yang sudah tervalidasi
        $team->update($data);

        return redirect()->route('team.index')->with('success', 'Berhasil mengubah data team');
    }

    public function destroy($id) {
        $team = Team::findOrFail($id);
        
        // Hapus file fisik gambar dari storage
        if($team->image && Storage::disk('public')->exists($team->image)){
            Storage::disk('public')->delete($team->image);
        }
        
        $team->delete();

        return redirect()->route('team.index')->with('success', 'Berhasil menghapus data team');
    }
}
