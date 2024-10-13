<?php

namespace Daugt\Misc\TiptapExtensions;

use Tiptap\Core\Mark;
use Tiptap\Utils\HTML;

class Color extends Mark
{
    public static $name = 'color';

    public function addAttributes()
    {
        return [
            'color' => [
                'default' => null,
                'parseHTML' => function ($DOMNode) {
                    $style = $DOMNode->getAttribute('style') ?? '';
                    $classList = $DOMNode->getAttribute('class') ?? '';

                    // Check for inline color style (hex code)
                    if (preg_match('/color:\s*(#[0-9a-fA-F]{3,6});?/', $style, $colorMatch)) {
                        return $colorMatch[1]; // Return the hex color code
                    }

                    // Check for class starting with 'text-'
                    if (preg_match('/(^|\s)text-([^\s]+)/', $classList, $classMatch)) {
                        return $classMatch[2]; // Return the color value
                    }

                    return null;
                },
                'renderHTML' => function ($attributes) {
                    if (empty($attributes->color)) {
                        return [];
                    }

                    if (preg_match('/^#[0-9a-fA-F]{3,6}$/', $attributes->color)) {
                        // Custom hex color, use inline style
                        return [
                            'style' => 'color: ' . $attributes->color,
                        ];
                    } else {
                        // Use class 'text-(color)'
                        return [
                            'class' => 'text-' . $attributes->color,
                        ];
                    }
                },
            ],
        ];
    }

    public function parseHTML()
    {
        return [
            [
                'tag' => 'span',
                'getAttrs' => function ($DOMNode) {
                    $style = $DOMNode->getAttribute('style') ?? '';
                    $classList = $DOMNode->getAttribute('class') ?? '';

                    $hasStyle = preg_match('/color:\s*#[0-9a-fA-F]{3,6};?/', $style);
                    $hasClass = preg_match('/(^|\s)text-[^\s]+(\s|$)/', $classList);

                    if ($hasStyle || $hasClass) {
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

        if (empty($attributes->color)) {
            return ['span', HTML::mergeAttributes($HTMLAttributes)];
        }

        // Merge attributes
        $finalAttributes = array_merge(
            (array) $HTMLAttributes,
            (array) $this->addAttributes()['color']['renderHTML']($attributes)
        );

        return ['span', HTML::mergeAttributes($finalAttributes)];
    }
}
