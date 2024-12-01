<?php

namespace Daugt\Models\Content;

use Daugt\Enums\User\MarkType;
use Daugt\Misc\ContentTypeRegistry;
use Daugt\Models\User\Comment;
use Daugt\Models\User\Mark;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Daugt\Models\User;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Content extends Model
{
    use HasSlug, SoftDeletes, Prunable;

    protected $casts = [
        'blocks' => 'array',
        'attributes' => 'array',
        'enabled' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->allowDuplicateSlugs();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prunable()
    {
        return static::where('created_at', '<=', now()->subYear());
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->orderBy('created_at', 'DESC');
    }

    public function reactions() {
        return $this->morphMany(Mark::class, 'markable')->where('type', MarkType::REACTION);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getUrl() {
        $type = ContentTypeRegistry::getContentType($this->type);
        if(!empty($type->path)) {
            return route('daugt.content.show', ['first' => $type->path, 'second' => $this->slug]);
        } else {
            return route('daugt.content.show', ['first' => $this->slug]);
        }
    }

    // All fields that get exposed to the template renderer
    public static array $fieldsForTemplateUsage = [
        'id', 'title', 'user', 'slug', 'published_at', 'created_at', 'updated_at'
    ];
}
