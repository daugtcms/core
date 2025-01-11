<?php

namespace Daugt\View\Components\Content;

use Daugt\Injectable\TiptapEditor;
use Daugt\Misc\ContentTypeRegistry;
use Daugt\Models\Content\Content;
use Illuminate\View\Component;

class Comments extends Component
{
    public Content $content;

    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    public function render()
    {
        $comments = $this->content->comments;
        $comments->each(function ($comment) {
            $comment->text = !empty($comment->text) ? TiptapEditor::init(comment: true)->setContent($comment->text)->getHTML() : null;
            $comment->comments->each(function ($subcomment) {
                $subcomment->text = !empty($subcomment->text) ? TiptapEditor::init(comment: true)->setContent($subcomment->text)->getHTML() : null;
            });
        });
        return view('daugt::components.content.comments', ['comments' => $this->content->comments, 'type' => $this->content->type, 'slug' => $this->content->slug]);
    }
}