<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hero;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    public function edit()
    {
        // Ambil data pertama di tabel heroes
        $hero = Hero::first();

        // Jika database kosong, buat objek baru agar tidak error di view
        if (!$hero) {
            $hero = new Hero();
        }

        $username = auth()->user()->name ?? 'Guest';

        return view('hero.edit', compact('hero', 'username'));
    }

    public function update(Request $request) 
    {
        $hero = Hero::first();

        // Validasi input sesuai nama field database
        $validator = $request->validate([
            'title' => 'required|string|max:255',
            'tagline' => 'required|string|max:255',
            'button' => 'nullable|string|max:255', // nama field di DB
            'image' => 'nullable|image|max:2048',
        ]);

        // Default button jika kosong
        if (empty($validator['button'])) {
            $validator['button'] = 'Klik di sini';
        }

        // Upload gambar
        if ($request->hasFile('image')) {
            if ($hero && $hero->image && Storage::disk('public')->exists($hero->image)) {
                Storage::disk('public')->delete($hero->image);
            }
            $imagePath = $request->file('image')->store('hero', 'public');
            $validator['image'] = $imagePath;
        }

        // Simpan perubahan
        if ($hero) {
            $hero->update($validator);
        } else {
            Hero::create($validator);
        }

        return redirect()->route('hero.edit')->with('success', 'Berhasil memperbarui data hero.');
    }
}
