<?php

namespace Sitebrew\Controllers\MemberArea;

use Illuminate\Support\Collection;
use Sitebrew\Controllers\Controller;
use Sitebrew\Helpers\MemberArea\AccessHelper;
use Sitebrew\Models\Content\Content;
use Sitebrew\Models\Listing\Listing;
use Sitebrew\Models\Listing\ListingItem;

class ShowCourseController extends Controller
{
    public function __invoke($course = null, $section = null)
    {
        $course = Listing::where('slug', $course)->first();
        $timeslots = AccessHelper::canAccessCourse($course);

        if(!$timeslots) {
            return redirect()->route('member-area.index');
        }
        $section = ListingItem::where('slug', $section)->first();
        return view('sitebrew::member-area.course.index', [
            'course' => $course,
            'section' => $section ?? null
        ]);
    }
}