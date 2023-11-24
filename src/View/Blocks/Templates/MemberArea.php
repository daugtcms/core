<?php

namespace Sitebrew\View\Blocks\Templates;

use Sitebrew\Data\Media\MediaPickerData;
use Sitebrew\View\Blocks\Block as SitebrewBlock;
use Sitebrew\Enums\Blocks\AttributeType;

class MemberArea extends SitebrewBlock
{
    public static array $metadata = [
        'viewName' => 'sitebrew::blocks.templates.member-area',
        'attributes' => [
            'logo' => [
                'type' => AttributeType::MEDIA,
                'title' => 'Logo',
            ],
            'background' => [
                'type' => AttributeType::MEDIA,
                'title' => 'Background',
            ]
        ],
    ];

    public function __construct(
        public array $logo = [],
        public array $background = [],
    ) {
        parent::__construct();
    }
}
