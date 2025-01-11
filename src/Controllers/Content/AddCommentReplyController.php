<?php

namespace Daugt\Controllers\Content;

use Daugt\Enums\User\MarkType;
use Daugt\Helpers\Content\ContentResolver;
use Daugt\Helpers\MemberArea\AccessHelper;
use Daugt\Injectable\TiptapEditor;
use Daugt\Misc\ContentTypeRegistry;
use Daugt\Models\Content\Content;
use Daugt\Models\Listing\ListingItem;
use Daugt\Models\User\Comment;
use Illuminate\Http\Request;

class AddCommentReplyController
{
    public function __invoke(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'text' => 'required|string|json',
        ]);

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

        $text = TiptapEditor::init(comment: true)->setContent($validated['text'])->getJSON();

        $comment->comments()->create([
            'text' => $text,
            'user_id' => auth()->id(),
            'parent_id' => $comment->id,
        ]);

        return redirect()->back();
    }
}
