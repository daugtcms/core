<?php

namespace Daugt\Misc\TiptapExtensions;

use Daugt\View\Blocks\Block;
use Tiptap\Core\Node;

class TiptapBlock extends Node
{
    public static $name = 'Block';

    public function addAttributes()
    {
        return [
            'uuid',
        ];
    }

    public function renderHTML($node)
    {
        $block = new Block($node->attrs->block);
        $block->uuid = $node->attrs->uuid;
        $block->attributes = json_decode(json_encode($node->attrs->data), true);
        // return ['content' => '<div class="not-prose">'.Blade::render($block->getView(), $block->attributes).'</div>'];
        return ['content' => '<div class="not-prose">'.$block->render().'</div>'];
    }
}
