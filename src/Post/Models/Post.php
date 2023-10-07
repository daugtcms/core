<?php

namespace Felixbeer\SiteCore\Post\Models;

use Felixbeer\SiteCore\Core\Models\User;
use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasSlug, Mediable;

    protected $casts = [
        'last_email' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Post::class, 'parent_id');
    }

    /*public function likes()
    {
        return $this->hasMany(Like::class);
    }*/

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getTypeName(): string
    {
        return match ($this->type) {
            'academy_posting', 'trainer_posting', 'community_posting' => 'Posting',
            'academy_frage', 'trainer_frage', 'community_frage' => 'Frage',
            'blog' => 'Blog',
            'academy_meditation', 'community_meditation' => 'Meditation',
            'community_seelenkonferenz' => 'Seelenkonferenz',
            'community_inspiration' => 'Inspiration',
            'academy_antwort', 'trainer_antwort', 'community_antwort' => 'Antwort',
            'academy_audiovideo', 'trainer_audiovideo' => 'Audio & Video',
            'academy_dokument', 'trainer_dokument' => 'Dokument',
            'shop' => 'Shop-Post',
            'workshop' => 'Workshop',
            default => '',
        };
    }

    public function getTypeIdentifier(): string
    {
        return match ($this->type) {
            'academy_posting', 'trainer_posting', 'community_posting' => 'posting',
            'blog' => 'blog',
            'academy_meditation', 'community_meditation' => 'meditation',
            'community_seelenkonferenz' => 'seelenkonferenz',
            'community_inspiration' => 'inspiration',
            'academy_antwort', 'trainer_antwort', 'community_antwort' => 'antwort',
            'academy_audiovideo', 'trainer_audiovideo' => 'audiovideo',
            'academy_dokument', 'trainer_dokument' => 'dokument',
            'shop' => 'Shop',
            default => '',
        };
    }

    public function isPosting(): bool
    {
        if ($this->type === 'academy_posting' || $this->type === 'community_posting' || $this->type === 'trainer_posting' || $this->type === 'academy_frage' || $this->type === 'community_frage' || $this->type === 'trainer_frage') {
            return true;
        } else {
            return false;
        }
    }

    public function isFrage(): bool
    {
        if ($this->type === 'academy_frage' || $this->type === 'community_frage' || $this->type === 'trainer_frage') {
            return true;
        } else {
            return false;
        }
    }
}
