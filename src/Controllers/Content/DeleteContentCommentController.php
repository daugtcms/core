<?php

namespace Daugt\Controllers\Content;

use Daugt\Helpers\Content\ContentResolver;
use Daugt\Misc\ContentTypeRegistry;
use Daugt\Models\User\Comment;
use Illuminate\Http\Request;

class DeleteContentCommentController
{
    public function __invoke(Request $request, $type, $slug, Comment $comment)
    {
        if($comment->user_id != auth()->id()) {
            abort(403);
        }

        $children = Comment::where('parent_id', $comment->id)->count();
        if($children > 0) {
            $comment->user_id = null;
            $comment->text = null;
            $comment->save();
        } else {
            $comment->delete();
        }

        return redirect()->back();
    }
}
