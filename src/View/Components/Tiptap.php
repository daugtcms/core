<?php

namespace Felixbeer\SiteCore\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use function Felixbeer\SiteCore\Blocks\View\Components\view;
use function Felixbeer\SiteCore\View\Components;

class Tiptap extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('site-core::components.tiptap');
    }
}
