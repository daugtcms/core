<?php

namespace Daugt\Controllers\Content;

use Daugt\Helpers\Content\ContentResolver;
use Daugt\Misc\ContentTypeRegistry;
use Daugt\Models\User\Comment;
use Illuminate\Http\Request;

class DeleteCommentController
{
    public function __invoke(Request $request, Comment $comment)
    {
        if($comment->user_id != auth()->id()) {
            abort(403);
        }

        $children = $comment->comments()->count();
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
