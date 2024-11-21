<?php

namespace Daugt\Livewire\Analytics;

use Carbon\Carbon;
use Daugt\Data\Analytics\ViewsListItem;
use Daugt\Models\AnalyticsEvent;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class VisitorAnalytics extends Component
{
    public function mount()
    {
    }

    #[Layout('daugt::components.layouts.admin')]
    public function render()
    {
        // TODO: Extract this to a scheduled job
        AnalyticsEvent::where('created_at', '<', Carbon::now()->subDays(7))->delete();

        $views = AnalyticsEvent::whereNull('event')
            ->whereNotNull('eventable_type')
            ->whereNotNull('eventable_id')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->select('eventable_type', 'eventable_id', DB::raw('COUNT(*) as total_amount'))
            ->groupBy('eventable_type', 'eventable_id')
            ->orderBy('total_amount', 'desc')
            ->limit(20)
            ->get();

        // fetch all eventable models
        $views = $views->map(function ($view) use($views) {
            // calculate percentage of total views
            $percentage = $view->total_amount / $views->sum('total_amount');
            return new ViewsListItem($view->eventable, $view->total_amount, $percentage);
        });

        $start = Carbon::now()->subDays(7)->startOfHour();
        $end = Carbon::now()->startOfHour();

        $hours = collect();
        for ($time = $start->timestamp; $time <= $end->timestamp; $time += 3600) {
            $hours->add([
                $time * 1000, 0
            ]);
        }

        $hourlyViews = AnalyticsEvent::whereNull('event')
            ->whereNotNull('eventable_type')
            ->whereNotNull('eventable_id')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->select(
                \DB::raw('EXTRACT(EPOCH FROM DATE_TRUNC(\'hour\', created_at))::BIGINT as hour'),
                \DB::raw('COUNT(*) as total_amount')
            )
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        $hourlyViews = $hourlyViews->map(function ($item) {
            return [$item->hour * 1000, $item->total_amount];
        });

        // merge the hourly views with the hours array
        $hourlyViews = $hours->map(function ($hour) use ($hourlyViews) {
            $view = $hourlyViews->firstWhere('0', $hour[0]);
            return $view ?? $hour;
        });

        $hourlyVisitors = AnalyticsEvent::whereNotNull('session_id')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->select(
                \DB::raw('EXTRACT(EPOCH FROM DATE_TRUNC(\'hour\', created_at))::BIGINT as hour'),
                \DB::raw('COUNT(DISTINCT session_id) as total_amount')
            )
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        $hourlyVisitors = $hourlyVisitors->map(function ($item) {
            return [$item->hour * 1000, $item->total_amount];
        });

        // merge the hourly visitors with the hours array
        $hourlyVisitors = $hours->map(function ($hour) use ($hourlyVisitors) {
            $visitor = $hourlyVisitors->firstWhere('0', $hour[0]);
            return $visitor ?? $hour;
        });

        return view('daugt::livewire.analytics.visitor-analytics', [
            'visitors' => $hourlyVisitors,
            'views' => $hourlyViews,
            'viewsList' => $views,
        ]);
    }
}
