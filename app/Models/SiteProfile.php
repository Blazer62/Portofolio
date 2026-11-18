<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteProfile extends Model
{
    protected $fillable = [
        'name', 'headline', 'tagline', 'bio', 'photo', 'class', 'major', 'school',
        'location', 'email', 'github', 'instagram', 'linkedin', 'whatsapp', 'tiktok',
        'cv_file', 'interests', 'career_goal', 'cv_summary', 'languages',
    ];

    public function interestList(): array
    {
        return collect(preg_split('/[\r\n,]+/', (string) $this->interests))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->all();
    }
}
