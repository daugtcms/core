<?php

namespace Daugt\View\Blocks;

use Daugt\Enums\Blocks\AttributeType;

class VideoEmbed extends Block
{
    public static array $metadata = [
        'name' => 'Video Embed',
        'description' => 'Embed a YouTube or Vimeo video',
        'viewName' => 'daugt::blocks.video-embed',
        'attributes' => [
            'url' => [
                'type' => AttributeType::TEXT,
                'title' => 'URL',
                'description' => 'The URL of the video to embed (e.g. https://www.youtube.com/embed/dQw4w9WgXcQ?si=UWSB6FRNrrKMflBJ)',
            ],
        ],
    ];

    public function __construct(
        public string $url = '',
    ) {
        parent::__construct();
    }
}
