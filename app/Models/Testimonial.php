<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    public const TYPES = [
        'guru' => 'Guru Pembimbing',
        'teman' => 'Teman',
        'pengguna' => 'Pengguna',
        'plk' => 'Tempat PLK',
    ];

    protected $fillable = ['name', 'role', 'type', 'message', 'photo', 'sort_order'];
}
