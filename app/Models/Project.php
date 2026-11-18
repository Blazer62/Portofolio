<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'category', 'description', 'problem', 'goal', 'role',
        'features', 'image', 'image_url', 'live_link', 'github_link', 'tech_stack',
        'documentation', 'feedback', 'is_featured', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
        ];
    }

    public static function booted(): void
    {
        static::saving(function (Project $project) {
            if (blank($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function techList(): array
    {
        return collect(explode(',', (string) $this->tech_stack))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->all();
    }

    public function featureList(): array
    {
        return collect(preg_split('/[\r\n]+/', (string) $this->features))
            ->map(fn ($item) => trim(ltrim($item, "-•* \t")))
            ->filter()
            ->values()
            ->all();
    }
}
