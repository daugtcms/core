<?php

namespace Daugt\Controllers\MemberArea;

use Daugt\Models\User\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteCourseCommentController
{
    public function __invoke(Request $request, $listing, $section, Comment $comment)
    {
        if($comment->user_id != Auth::id()) {
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
