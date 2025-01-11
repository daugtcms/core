<?php

namespace Daugt\Controllers\Content;

use Daugt\Enums\User\MarkType;
use Daugt\Helpers\Content\ContentResolver;
use Daugt\Helpers\MemberArea\AccessHelper;
use Daugt\Misc\ContentTypeRegistry;
use Daugt\Models\Content\Content;
use Daugt\Models\Listing\ListingItem;
use Daugt\Models\User\Comment;
use Illuminate\Http\Request;

class AddCommentReactionController
{
    public function __invoke(Request $request, Comment $comment, $reaction)
    {
        if(!in_array($reaction, config('daugt.user.allowed_reactions'))) {
            abort(404);
        }

        $commentable = $comment->commentable()->first();

        if($commentable instanceof Content) {
            $type = $commentable->type;
            $slug = $commentable->slug;

            $content = ContentResolver::getContent($type, $slug);

            if (!ContentTypeRegistry::getContentType($content->type)->isReactable($content)) {
                abort(404);
            }
        } else if ($commentable instanceof ListingItem) {
            $course = $commentable->listing()->first();

            $canAccess = AccessHelper::canAccessCourse($course);

            if($canAccess !== true) {
                abort(404);
            }
        }

        // remove any reaction made by the user for the content
        $currentReaction = $comment->reactions()->where('user_id', auth()->id())->first();

        if(isset($currentReaction)) {
            $value = $currentReaction->value;
            $currentReaction->delete();
            if($value === $reaction) {
                return redirect()->back();
            }
        }

        // create a new reaction for the content
        $comment->reactions()->create([
            'user_id' => auth()->id(),
            'type' => MarkType::REACTION,
            'value' => $reaction,
        ]);

        return redirect()->back();
    }
}
