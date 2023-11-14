<?php

namespace Sitebrew\View\Blocks\Templates;

use Sitebrew\Data\Media\MediaPickerData;
use Sitebrew\View\Blocks\Block as SitebrewBlock;
use Sitebrew\Enums\Blocks\AttributeType;

class CenterAuth extends SitebrewBlock
{
    public static array $metadata = [
        'viewName' => 'sitebrew::blocks.templates.center-auth',
        'attributes' => [
            'logo' => [
                'type' => AttributeType::IMAGE,
                'title' => 'Logo',
            ],
            'background' => [
                'type' => AttributeType::IMAGE,
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
