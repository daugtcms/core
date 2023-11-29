<?php

namespace Sitebrew\Controllers\MemberArea;

use Sitebrew\Controllers\Controller;
use Sitebrew\Helpers\MemberArea\AccessHelper;
use Sitebrew\Models\Content\Content;

class ShowPostController extends Controller
{
    public function __invoke($slug = null)
    {
        $query = Content::where('type', 'post')->where('enabled', true);

        if ($slug) {
            $query->where('slug', $slug);
        }

        $post = $query->firstOrFail();
        if(AccessHelper::canViewPost($post)) {
            return view('sitebrew::member-area.post.show', [
                'post' => $post,
            ]);
        } else {
            return redirect()->route('member-area.index');
        }
    }
}