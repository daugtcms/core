<?php

namespace Daugt\Models\User;

use Daugt\Enums\User\MarkType;
use Daugt\Models\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->orderBy('created_at', 'DESC');
    }

    public function reactions() {
        return $this->morphMany(Mark::class, 'markable')->where('type', MarkType::REACTION);
    }
}