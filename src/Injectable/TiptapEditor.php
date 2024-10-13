<?php

namespace Daugt\Injectable;

use Daugt\Misc\TiptapExtensions\Color;
use Daugt\Misc\TiptapExtensions\FontFamily;
use Daugt\Misc\TiptapExtensions\TiptapBlock;
use Tiptap\Extensions\StarterKit;
use Tiptap\Extensions\TextAlign;
use Tiptap\Marks\Link;
use Tiptap\Marks\TextStyle;

class TiptapEditor
{
    public static function init()
    {
        return new \Tiptap\Editor([
            'extensions' => [
                new TiptapBlock,
                new StarterKit,
                new TextAlign([
                    'types' => ['heading', 'paragraph'],
                    'defaultAlignment' => 'justify'
                ]),
                new TextStyle,
                new Link,
                new Color,
                new FontFamily
            ],
        ]);
    }
}
