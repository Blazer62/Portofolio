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
            'contact_message' => 'required|string',
        ]);

        Message::create([
            'name' => $data['contact_name'],
            'email' => $data['contact_email'],
            'message' => $data['contact_message'],
        ]);

        return redirect()->route('home')->with('success', 'Pesan berhasil dikirim! Terima kasih');
    }
}
