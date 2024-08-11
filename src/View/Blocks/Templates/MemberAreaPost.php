<?php

namespace Daugt\View\Blocks\Templates;

use Daugt\Data\Media\MediaPickerData;
use Daugt\View\Blocks\Block as DaugtBlock;
use Daugt\Enums\Blocks\AttributeType;

class MemberAreaPost extends DaugtBlock
{
    public static array $metadata = [
        'viewName' => 'daugt::blocks.templates.member-area-post',
        'attributes' => [
            'title' => [
                'type' => AttributeType::TEXT,
                'title' => 'Title',
            ],
            'courseSection' => [
                'type' => AttributeType::COURSE_SECTION,
                'title' => 'Course Section',
            ],
            'featuredImage' => [
                'type' => AttributeType::MEDIA,
                'title' => 'Featured Image',
            ],
            'author' => [
                'type' => AttributeType::USER,
                'title' => 'Author',
            ]
        ],
    ];

    public function __construct(
        public string $title = '',
        public int $courseSection = 0,
        public array $featuredImage = [],
        public int $author = 0,
    ) {
        parent::__construct();
    }
}
