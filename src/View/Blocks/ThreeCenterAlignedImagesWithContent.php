<?php

namespace Sitebrew\View\Blocks;

use Sitebrew\Enums\Blocks\AttributeType;

class ThreeCenterAlignedImagesWithContent extends Block
{
    public static array $metadata = [
        'name' => 'Three Center Aligned Images With Content',
        'description' => 'Images on the left growing from small to large with text on the right',
        'viewName' => 'sitebrew::blocks.three-center-aligned-images-with-content',
        'attributes' => [
            'title' => [
                'type' => AttributeType::TEXT,
                'title' => 'Title',
            ],
            'text' => [
                'type' => AttributeType::TEXT,
                'title' => 'Text',
            ],
            'firstImage' => [
                'type' => AttributeType::MEDIA,
                'title' => 'First Image',
            ],
            'secondImage' => [
                'type' => AttributeType::MEDIA,
                'title' => 'Second Image',
            ],
            'thirdImage' => [
                'type' => AttributeType::MEDIA,
                'title' => 'Third Image',
            ],
        ],
    ];

    public function __construct(
        public string $title = '',
        public string $text = '',
        public array $firstImage = [],
        public array $secondImage = [],
        public array $thirdImage = [],
    ) {
        parent::__construct();
    }
}
