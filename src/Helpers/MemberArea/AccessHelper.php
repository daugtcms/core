<?php

namespace Sitebrew\Helpers\MemberArea;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Sitebrew\Enums\Shop\PaymentStatus;
use Sitebrew\Models\Content\Content;
use Sitebrew\Models\Listing\Listing;
use Sitebrew\Models\Listing\ListingItem;
use Sitebrew\Models\Shop\OrderItem;
use Sitebrew\Models\Shop\Product;

class AccessHelper
{
    public static function canViewPost(Content $post)
    {
        if (Auth::user()->can('edit contents')) {
            return 'interact';
        } else {
            if(isset($post->blocks['template']['attributes']['courseSection'])) {
                $courseSection = $post->blocks['template']['attributes']['courseSection'];
                $courseSection = ListingItem::with('listing')->find($courseSection);
                $course = $courseSection->listing;
                $timeslots = self::canAccessCourse($course);
                if ($timeslots instanceof Collection) {
                    foreach ($timeslots as $slot) {
                        if ($post->created_at->between($slot['starts_at'], $slot['ends_at'])) {
                            return 'interact';
                        }
                    }
                } elseif ($timeslots === true) {
                    return 'interact';
                }
            }
            $products = Product::where('content_id', $post->id)->get()->pluck('id');
            $items = OrderItem::where('user_id', Auth::id())->whereHas('order', function($query) { return $query->where('status', PaymentStatus::PAID); })->whereHas('product', function ($query) use ($products) {
                return $query->whereIn('id', $products);
            })->get();
            if(!$items->isEmpty()) {
                return 'interact';
            }

            return false;
        }
    }

    public static function canAccessCourse(Listing $course) {
        if (Auth::user()->can('edit contents')) {
            return true;
        } else {
            $products = Product::where('course_id', $course->id)->get()->pluck('id');
            $subscriptions = OrderItem::where('user_id', Auth::id())->whereHas('order', function($query) { return $query->where('status', PaymentStatus::PAID); })->whereHas('product', function ($query) use ($products) {
                return $query->whereIn('id', $products);
            })->get();
            if (!$subscriptions->isEmpty()) {
                $timeslots = collect();
                foreach ($subscriptions as $subscription) {
                    if (! isset($subscription->ends_at) && ! isset($subscription->starts_at)) {
                        return true;
                    }
                    if(!isset($subscription->ends_at)) {
                        $subscription->ends_at = Carbon::maxValue();
                    } else if(!isset($subscription->starts_at)) {
                        $subscription->starts_at = Carbon::minValue();
                    }
                    $timeslots->push(['starts_at' => $subscription->starts_at, 'ends_at' => $subscription->ends_at]);
                }
                return $timeslots;
            }
            return false;
        }
    }
}
