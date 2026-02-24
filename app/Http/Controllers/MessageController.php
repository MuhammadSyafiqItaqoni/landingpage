<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Service;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // Fungsi view (menampilkan halaman admin)
    public function index()
    {
        $messages = Message::all();

        return view('message.index', compact('messages'));
    }

    // Fungsi destroy (menghapus pesan)
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->back()->with('success', 'Pesan berhasil dihapus!');
    }

    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        // 2. Simpan ke database
        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);

        // 3. Balik lagi ke halaman depan dengan pesan sukses
        return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim!');
    }

    // public function edit($id)
    // {
    //     $service = Service::findOrFail($id);

    //     return view('services.edit', compact('service'));
    // }

    public function edit($id)
    {
        $message = Message::findOrFail($id);

        return view('message.edit', compact('message')); // Sesuaikan folder view lo
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        $message = Message::findOrFail($id);
        $message->update($request->all());

        return redirect()->route('messages.index')->with('success', 'Pesan berhasil diperbarui!');
    }
}
