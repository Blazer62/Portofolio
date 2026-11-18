<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';

    protected $fillable = [
        'level', 'institution', 'major', 'start_year', 'end_year', 'description', 'sort_order',
    ];
}
