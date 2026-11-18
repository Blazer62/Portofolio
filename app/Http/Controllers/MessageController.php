<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_message' => 'required|string|max:5000',
        ]);

        Message::create([
            'name' => $data['contact_name'],
            'email' => $data['contact_email'],
            'message' => $data['contact_message'],
            'type' => 'contact',
        ]);

        return back()->with('success', 'Pesan berhasil dikirim! Terima kasih sudah menghubungi saya.');
    }

    public function guestbook(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        Message::create([
            'name' => $data['name'],
            'role' => $data['role'] ?? null,
            'message' => $data['message'],
            'type' => 'guestbook',
        ]);

        return back()->with('success', 'Kesan dan pesan berhasil dikirim. Terima kasih!')->withFragment('guestbook');
    }
}
