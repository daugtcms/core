<?php

namespace Daugt\Controllers\Content;

use Daugt\Helpers\Content\ContentResolver;
use Daugt\Injectable\TiptapEditor;
use Daugt\Misc\ContentTypeRegistry;
use Illuminate\Http\Request;

class CreateContentCommentController
{
    public function __invoke(Request $request, $type, $slug)
    {
        $validated = $request->validate([
            'text' => 'required|string|json',
        ]);

        $content = ContentResolver::getContent($type, $slug);

        if (!ContentTypeRegistry::getContentType($content->type)->isCommentable($content)) {
            abort(404);
        }

        $text = TiptapEditor::init(comment: true)->setContent($validated['text'])->getJSON();

        $content->comments()->create([
            'text' => $text,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back();
    }
}
