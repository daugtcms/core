<?php

namespace Daugt\Data\Content;

use Daugt\Models\Content\Content;
use Daugt\Models\User;
use Illuminate\Support\Collection;
use Daugt\Data\Theme\AttributeData;
use Daugt\Enums\Content\ContentGroup;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelData\Data;

class ContentTypeData extends Data
{
    public string $name;

    public string $path;

    public ContentGroup $group;

    public bool $categorized;

    public bool $listable;

    /**
     * @var Collection<string, AttributeData>
     */
    public Collection $attributes;

    /**
     * @var bool|Closure
     */
    public $accessible;

    /**
     * @var bool|Closure
     */
    public $commentable;

    /**
     * @var bool|Closure
     */
    public $reactable;

    /**
     * Check if the content type is accessible for a given user and content.
     *
     * @param Content $content
     * @return bool
     */
    public function isAccessible(Content $content, ?User $user = null): bool
    {
        // Check if 'accessible' is a callable function, if yes, call it with the $user and $content arguments
        if (is_callable($this->accessible)) {
            return call_user_func($this->accessible, $content, $user);
        }

        // Otherwise, it's a boolean, so just return its value
        return (bool) $this->accessible;
    }

    /**
     * Check if the content type is commentable for a given user and content.
     *
     * @param Content $content
     * @return bool
     */
    public function isCommentable(Content $content): bool
    {
        // Check if 'commentable' is a callable function, if yes, call it with the $user and $content arguments
        if (is_callable($this->commentable)) {
            return call_user_func($this->commentable, $content);
        }

        // Otherwise, it's a boolean, so just return its value
        return (bool) $this->commentable;
    }

    /**
     * Check if the content type is reactable for a given user and content.
     *
     * @param Content $content
     * @return bool
     */

    public function isReactable(Content $content): bool
    {
        // Check if 'reactable' is a callable function, if yes, call it with the $user and $content arguments
        if (is_callable($this->reactable)) {
            return call_user_func($this->reactable, $content);
        }

        // Otherwise, it's a boolean, so just return its value
        return (bool) $this->reactable;
    }
}
