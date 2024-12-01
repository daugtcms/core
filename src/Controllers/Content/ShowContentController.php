<?php

namespace Daugt\Controllers\Content;

use Daugt\Controllers\Controller;
use Daugt\Helpers\Content\ContentResolver;
use Daugt\Misc\ContentTypeRegistry;
use Daugt\Models\AnalyticsEvent;
use Daugt\Models\Content\Content;

class ShowContentController extends Controller
{
    public function __invoke($first = null, $second = null)
    {
        $resolved = ContentResolver::resolve($first, $second);

        return $this->showContent($resolved['type'], $resolved['slug']);
    }

    private function showContent($type, $slug = null)
    {
        $contentType = ContentTypeRegistry::getContentType($type);

        $query = Content::where('type', $type)->where('enabled', true);

        if (empty($slug) && $contentType->listable) {
            $contents = $query->orderBy('published_at', 'DESC')->paginate(24);
            return view('daugt::content.index', compact('contents', 'type'));
        }

        $content = ContentResolver::getContent($type, $slug);

        if (!$contentType->isAccessible($content)) {
            abort(404);
        }

        defer(fn () => AnalyticsEvent::logModelEvent($content));

        return view('daugt::content.show', compact('content'));
    }
}
