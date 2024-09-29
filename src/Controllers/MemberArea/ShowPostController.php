<?php

namespace Daugt\Controllers\MemberArea;

use Daugt\Controllers\Controller;
use Daugt\Helpers\MemberArea\AccessHelper;
use Daugt\Models\Content\Content;

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
            return view('daugt::member-area.post.show', [
                'post' => $post,
            ]);
        } else {
            return redirect()->route('daugt.member-area.index');
        }
    }
}