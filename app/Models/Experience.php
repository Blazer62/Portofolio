<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    public const TYPES = [
        'plk' => 'Pengalaman PLK',
        'organisasi' => 'Organisasi / Kepanitiaan',
        'lomba' => 'Pengalaman Lomba',
    ];

    protected $fillable = ['type', 'title', 'organization', 'period', 'description', 'sort_order'];
}
