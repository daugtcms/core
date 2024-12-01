<?php

namespace Daugt\Helpers\MemberArea;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Daugt\Enums\Shop\PaymentStatus;
use Daugt\Models\Content\Content;
use Daugt\Models\Listing\Listing;
use Daugt\Models\Listing\ListingItem;
use Daugt\Models\Shop\OrderItem;
use Daugt\Models\Shop\Product;

class AccessHelper
{
    public static function canViewPost(Content $post)
    {
        if (Auth::user()->can('edit contents')) {
            return 'interact';
        } else {
            if($post->published_at <= now()) {
                if (isset($post->attributes['courseSections'])) {
                    $courseSections = $post->attributes['courseSections'];
                    $courseSections = ListingItem::with('listing')->whereIn('id', $courseSections)->get();
                    foreach ($courseSections as $courseSection) {
                        $course = $courseSection->listing;
                        $timeslots = self::canAccessCourse($course);
                        if(isset($post->attributes['freeForAll']) && $post->attributes['freeForAll']) {
                            return 'interact';
                        }
                        if ($timeslots instanceof Collection) {
                            foreach ($timeslots as $slot) {
                                if ($post->published_at->between($slot['starts_at'], $slot['ends_at'])) {
                                    return 'interact';
                                }
                            }
                        } elseif ($timeslots === true) {
                            return 'interact';
                        }
                    }
                }

                $products = Product::whereHas('posts', function ($query) use ($post) {
                    return $query->where('posts.id', $post->id);
                })->get()->pluck('id');
                $items = OrderItem::where('user_id', Auth::id())->whereHas('order', function ($query) {
                    return $query->where('status', PaymentStatus::PAID);
                })->whereHas('product', function ($query) use ($products) {
                    return $query->whereIn('product.id', $products);
                })->get();
                if (!$items->isEmpty()) {
                    return 'interact';
                }
            }

            return false;
        }
    }

    public static function canAccessCourse(Listing $course) {
        if (!Auth::user()->can('edit contents')) {
            return true;
        } else {
            $products = Product::whereHas('courses', function ($query) use ($course) {
                return $query->where('listings.id', $course->id);
            })->get()->pluck('id');
            $subscriptions = OrderItem::where('user_id', Auth::id())->whereHas('order', function($query) { return $query->where('status', PaymentStatus::PAID); })->whereHas('product', function ($query) use ($products) {
                return $query->whereIn('products.id', $products);
            })->with('product.courses')->get();

            if (!$subscriptions->isEmpty()) {
                $timeslots = collect();
                foreach ($subscriptions as $subscription) {
                    $coursesWithPivot = $subscription->product->courses->where('id', $course->id);
                    foreach ($coursesWithPivot as $courseWithPivot) {
                        $timestamps = $subscription->getAccessTimestamps($courseWithPivot);
                        if (!isset($timestamps['ends_at']) && !isset($timestamps['starts_at'])) {
                            return true;
                        }
                        if(!isset($timestamps['ends_at'])) {
                            $timestamps['ends_at'] = Carbon::create(9999,12,31,23,59,59);
                        } else if(!isset($timestamps['starts_at'])) {
                            $timestamps['starts_at'] = Carbon::create(1999,0,0,0,0,0);
                        }
                        if(isset($course->data['keep_unlocked']) && !$course->data['keep_unlocked'] && $timestamps['ends_at'] < now()) {
                            continue;
                        }
                        $timeslots->push($timestamps);
                    }
                }
                return $timeslots;
            }
            return false;
        }
    }

    public static function canCommentPost(Content $post)
    {
       if(!self::canViewPost($post)) {
           return false;
       }

       $courseSections = $post->attributes['courseSections'];

       $courseSections = ListingItem::with('listing')->whereIn('id', $courseSections)->get();
       foreach ($courseSections as $courseSection) {
           $course = $courseSection->listing;
           if(isset($course->data['allow_member_comments']) && $course->data['allow_member_comments']) {
               return true;
           }
       }

      return false;
    }

    public static function canReactPost(Content $post) {
        if(!self::canViewPost($post)) {
            return false;
        }

        $courseSections = $post->attributes['courseSections'];

        $courseSections = ListingItem::with('listing')->whereIn('id', $courseSections)->get();
        foreach ($courseSections as $courseSection) {
            $course = $courseSection->listing;
            if(isset($course->data['allow_member_reactions']) && $course->data['allow_member_reactions']) {
                return true;
            }
        }

        return false;
    }
}
