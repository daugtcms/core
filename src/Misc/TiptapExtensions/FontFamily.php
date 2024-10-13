<?php

namespace Daugt\Misc\TiptapExtensions;

use Tiptap\Core\Mark;
use Tiptap\Utils\HTML;

class FontFamily extends Mark
{
    public static $name = 'fontFamily';

    public function addAttributes()
    {
        return [
            'font' => [
                'default' => null,
                'parseHTML' => function ($DOMNode) {
                    $classList = $DOMNode->getAttribute('class') ?? '';

                    // Check for class starting with 'font-'
                    if (preg_match('/(^|\s)font-(\w+)(\s|$)/', $classList, $classMatch)) {
                        return $classMatch[2]; // Return the font name
                    }

                    return null;
                },
                'renderHTML' => function ($attributes) {
                    if (empty($attributes->font)) {
                        return [];
                    }

                    // Use class 'font-(font)'
                    return [
                        'class' => 'font-' . $attributes->font,
                    ];
                },
            ],
        ];
    }

    public function parseHTML()
    {
        return [
            [
                'tag' => 'span[class]',
                'getAttrs' => function ($DOMNode) {
                    $classList = $DOMNode->getAttribute('class') ?? '';
                    if (preg_match('/(^|\s)font-\w+(\s|$)/', $classList)) {
                        return [];
                    }
                    return false;
                },
            ],
        ];
    }

    public function renderHTML($mark, $HTMLAttributes = [])
    {
        // Access attributes correctly
        $attributes = $mark->attrs ?? new \stdClass();

        if (empty($attributes->font)) {
            return ['span', HTML::mergeAttributes($HTMLAttributes)];
        }

        // Call the renderHTML closure from addAttributes
        $renderedAttributes = $this->addAttributes()['font']['renderHTML']($attributes);

        // Merge the passed HTMLAttributes with the rendered attributes
        $finalAttributes = array_merge(
            (array) $HTMLAttributes,
            (array) $renderedAttributes
        );

        return ['span', HTML::mergeAttributes($finalAttributes)];
    }
}
