<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'excerpt', 'content', 'image', 'tag', 'published_at'];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public static function booted(): void
    {
        static::saving(function (Post $post) {
            if (blank($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
