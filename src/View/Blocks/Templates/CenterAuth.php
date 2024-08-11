<?php

namespace Daugt\View\Blocks\Templates;

use Daugt\Data\Media\MediaPickerData;
use Daugt\View\Blocks\Block as DaugtBlock;
use Daugt\Enums\Blocks\AttributeType;

class CenterAuth extends DaugtBlock
{
    public static array $metadata = [
        'viewName' => 'daugt::blocks.templates.center-auth',
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
