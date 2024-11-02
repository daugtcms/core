<?php

namespace Daugt\Controllers\MemberArea;

use Illuminate\Support\Collection;
use Daugt\Controllers\Controller;
use Daugt\Helpers\MemberArea\AccessHelper;
use Daugt\Models\Content\Content;
use Daugt\Models\Listing\Listing;
use Daugt\Models\Listing\ListingItem;

class ShowCourseController extends Controller
{
    public function __invoke($course = null, $section = null)
    {
        $course = Listing::where('slug', $course)->with('items')->first();
        $timeslots = AccessHelper::canAccessCourse($course);
        if(!$timeslots) {
            return redirect()->route('daugt.member-area.index');
        }
        $section = ListingItem::where('slug', $section)->first();
        return view('daugt::member-area.course.index', [
            'course' => $course,
            'section' => $section ?? null
        ]);
    }
}