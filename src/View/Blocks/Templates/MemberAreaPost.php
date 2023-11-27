<?php

namespace Sitebrew\View\Blocks\Templates;

use Sitebrew\Data\Media\MediaPickerData;
use Sitebrew\View\Blocks\Block as SitebrewBlock;
use Sitebrew\Enums\Blocks\AttributeType;

class MemberAreaPost extends SitebrewBlock
{
    public static array $metadata = [
        'viewName' => 'sitebrew::blocks.templates.member-area-post',
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
