<?php

namespace Daugt\Controllers\MemberArea;

use Daugt\Helpers\MemberArea\AccessHelper;
use Daugt\Injectable\TiptapEditor;
use Daugt\Models\Listing\ListingItem;
use Daugt\Models\User\Comment;
use Illuminate\Http\Request;

class CreateCourseCommentController
{
    public function __invoke(Request $request, $course, $section)
    {
        $validated = $request->validate([
            'text' => 'required|string|json',
        ]);

        $section = ListingItem::where('slug', $section)->with('listing')->firstOrFail();

        if(!AccessHelper::canAccessCourse($section->listing)) {
            abort(404);
        }

        $text = TiptapEditor::init(comment: true)->setContent($validated['text'])->getJSON();

        Comment::create([
            'text' => $text,
            'user_id' => auth()->id(),
            'commentable_type' => $section->getMorphClass(),
            'commentable_id' => $section->id
        ]);

        return redirect()->back();
    }
}
