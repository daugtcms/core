<?php

namespace Daugt\Injectable;

use Daugt\Misc\TiptapBlock;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\Link;

class TiptapEditor
{
    public static function init()
    {
        return new \Tiptap\Editor([
            'extensions' => [
                new TiptapBlock,
                new StarterKit,
                new Link,
            ],
        ]);
    }
}
