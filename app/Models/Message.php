<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public const TYPES = [
        'contact' => 'Pesan Kontak',
        'guestbook' => 'Kesan & Pesan',
    ];

    protected $fillable = [
        'name', 'role', 'email', 'message', 'type', 'is_read',
    ];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
        ];
    }

    public function scopeGuestbook($query)
    {
        return $query->where('type', 'guestbook');
    }

    public function scopeContact($query)
    {
        return $query->where('type', 'contact');
    }
}
