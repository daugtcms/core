@props(['icon', 'style', 'href', 'disabled'])

@php
    $classes = '';
    switch ($style ?? 'secondary') {
    case 'secondary':
    $classes .= 'text-neutral-600 bg-transparent hover:bg-neutral-300 active:bg-neutral-200 focus:border-neutral-200 ring-neutral-300';
    break;
    }
@endphp

@if(isset($icon))
    @if(isset($href))
        <a {{ $attributes->merge(['href' => $href, 'class' => 'inline-flex items-center justify-center p-1 w-5 h-5
    border border-transparent rounded-md focus:outline-none focus:ring
    disabled:opacity-25 transition ease-in-out duration-150 gap-x-1 ' . $classes]) }}>
            @svg($icon)
        </a>
    @else
        <button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center p-1 w-8 h-8
    border border-transparent rounded-md focus:outline-none focus:ring
    disabled:opacity-25 transition ease-in-out duration-150 gap-x-1 ' . $classes]) }}>
            @svg($icon)
        </button>
    @endif
@endif