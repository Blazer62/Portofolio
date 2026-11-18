<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'all');

        $messages = Message::query()
            ->when(in_array($type, ['contact', 'guestbook'], true), fn ($query) => $query->where('type', $type))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.messages.index', [
            'messages' => $messages,
            'type' => $type,
            'unread' => Message::where('is_read', false)->count(),
        ]);
    }

    public function markRead(Message $message)
    {
        $message->update(['is_read' => ! $message->is_read]);

        return back()->with('success', 'Status pesan diperbarui.');
    }

    public function markAllRead()
    {
        Message::where('is_read', false)->update(['is_read' => true]);

        return back()->with('success', 'Semua pesan ditandai sudah dibaca.');
    }

    public function destroy(Message $message)
    {
        $message->delete();

        return back()->with('success', 'Pesan berhasil dihapus.');
    }
}
