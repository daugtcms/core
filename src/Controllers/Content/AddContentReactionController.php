<?php

namespace Daugt\Controllers\Content;

use Daugt\Enums\User\MarkType;
use Daugt\Helpers\Content\ContentResolver;
use Daugt\Misc\ContentTypeRegistry;
use Daugt\Models\User\Comment;
use Illuminate\Http\Request;

class AddContentReactionController
{
    public function __invoke(Request $request, $type, $slug, $reaction)
    {
        if(!in_array($reaction, config('daugt.user.allowed_reactions'))) {
            abort(404);
        }

        $content = ContentResolver::getContent($type, $slug);

        if (!ContentTypeRegistry::getContentType($content->type)->isReactable($content)) {
            abort(404);
        }

        // remove any reaction made by the user for the content
        $currentReaction = $content->reactions()->where('user_id', auth()->id())->first();

        if(isset($currentReaction)) {
            $value = $currentReaction->value;
            $currentReaction->delete();
            if($value === $reaction) {
                return redirect()->back();
            }
        }

        // create a new reaction for the content
        $content->reactions()->create([
            'user_id' => auth()->id(),
            'type' => MarkType::REACTION,
            'value' => $reaction,
        ]);

        return redirect()->back();
    }
}
