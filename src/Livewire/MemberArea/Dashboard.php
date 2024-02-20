<?php

namespace Sitebrew\Livewire\MemberArea;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Sitebrew\Enums\Listing\ListingUsage;
use Sitebrew\Models\Listing\Listing;
use Sitebrew\Models\User;

class Dashboard extends Component
{
    protected $listeners = [
        'refreshComponent' => '$refresh',
    ];
    public function mount()
    {
    }

    #[Layout('sitebrew::components.layouts.member-area-layout')]
    public function render()
    {
        $query = Auth::user()->orders();

        $courses = collect();
        if(Auth::user()->can('edit contents')) {
            $courses = Listing::with('items')->where('usage', ListingUsage::COURSE)->get();
        } else {
            $course_ids = $query->with('items.product')->get()->pluck('items')->flatten()->pluck('product')->filter(fn ($product) => $product->course_id)->unique()->map(fn ($product) => $product->course_id);
            $courses = Listing::whereIn('id', $course_ids)->with('items')->get();
        }
        return view('sitebrew::livewire.member-area.dashboard', [
            'orders' => $query->limit(5)->orderBy('created_at', 'desc')->get(),
            'courses' => $courses
        ]);
    }
}