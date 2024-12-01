<?php

namespace Daugt\Injectable;

use Aws\History;
use Daugt\Misc\TiptapExtensions\Color;
use Daugt\Misc\TiptapExtensions\FontFamily;
use Daugt\Misc\TiptapExtensions\TiptapBlock;
use Tiptap\Extensions\StarterKit;
use Tiptap\Extensions\TextAlign;
use Tiptap\Marks\Bold;
use Tiptap\Marks\Italic;
use Tiptap\Marks\Link;
use Tiptap\Marks\Strike;
use Tiptap\Marks\TextStyle;
use Tiptap\Nodes\Blockquote;
use Tiptap\Nodes\BulletList;
use Tiptap\Nodes\Document;
use Tiptap\Nodes\ListItem;
use Tiptap\Nodes\OrderedList;
use Tiptap\Nodes\Paragraph;
use Tiptap\Nodes\Text;

class TiptapEditor
{
    public static function init(bool $comment = false)
    {
        $extensions = [];
        if(!$comment) {
            $extensions = [
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
            ];
        } else {
            $extensions = [
                new Blockquote,
                new BulletList,
                new Document,
                new ListItem,
                new OrderedList,
                new Paragraph,
                new Text,
                new Bold,
                new Italic,
                new Strike
            ];
        }
        return new \Tiptap\Editor([
            'extensions' => $extensions
        ]);
    }
}
