<?php

namespace Daugt\Livewire\MemberArea;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Daugt\Enums\Listing\ListingUsage;
use Daugt\Models\Listing\Listing;
use Daugt\Models\User;

class Dashboard extends Component
{
    protected $listeners = [
        'refreshComponent' => '$refresh',
    ];
    public function mount()
    {
    }

    #[Layout('daugt::components.layouts.member-area-layout')]
    public function render()
    {
        $query = Auth::user()->orders();

        $courses = collect();
        if(Auth::user()->can('edit contents')) {
            $courses = Listing::with('items')->where('type', 'course')->get();
        } else {
            $course_ids = $query->with('items.product')->get()
                ->pluck('items')
                ->flatten()
                ->pluck('product')
                ->filter(fn ($product) => $product->courses()->exists())
                ->unique()
                ->map(fn ($product) => $product->courses()->pluck('listings.id')->toArray())
                ->flatten()
                ->unique();
            $courses = Listing::whereIn('id', $course_ids)->with('items')->get();
        }

        return view('daugt::livewire.member-area.dashboard', [
            'orders' => $query->limit(5)->orderBy('created_at', 'desc')->get(),
            'courses' => $courses
        ]);
    }
}
