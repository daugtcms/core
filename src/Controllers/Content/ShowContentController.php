<?php

namespace Daugt\Controllers\Content;

use Daugt\Controllers\Controller;
use Daugt\Misc\ContentTypeRegistry;
use Daugt\Models\Content\Content;

class ShowContentController extends Controller
{
    public function __invoke($first = null, $second = null)
    {
        $types = ContentTypeRegistry::getContentTypes();

        // if the first parameter is also empty, show the first content type without a path
        $contentTypeWithoutPath = $types->search(function ($type) use ($first) {
            return empty($type->path);
        });

        if(!$first && $contentTypeWithoutPath) {
            return $this->showContent($contentTypeWithoutPath);
        }

        // whether the first parameter is a content type (could also be a content slug)
        $firstIsContentType = $types->contains(function ($type) use ($first) {
            return $type->path === $first;
        });

        if(!$firstIsContentType) {
            $second = $first;
            $first = $types->search(function ($type) use ($first) {
                return empty($type->path);
            });
        }

        return $this->showContent($first, $second);
    }

    private function showContent($type, $slug = null)
    {
        $contentType = ContentTypeRegistry::getContentType($type);

        $query = Content::where('type', $type)->where('enabled', true);

        if(empty($slug) && $contentType->listable) {
            $contents = $query->orderBy('published_at', 'DESC')->paginate(24);
            return view('daugt::content.index', compact('contents','type'));
        }

        if ($slug) {
            $query->where('slug', $slug);
        } else {
            $query->whereNull('slug')->orWhere('slug', '');
        }

        $content = $query->firstOrFail();

        if(!$contentType->isAccessible($content)) abort(404);

        return view('daugt::content.show', compact('content'));

    }
}
