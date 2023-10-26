@props(['style', 'href'])

@php
    $classes = '';
    switch ($style ?? 'dark') {
    case 'primary':
    $classes .=
    'text-white bg-primary-600 hover:bg-primary-500 active:bg-primary-900 focus:border-primary-900 ring-primary-300';
    break;
    case 'secondary':
    $classes .=
    'text-white bg-secondary-600 hover:bg-secondary-500 active:bg-secondary-900 focus:border-secondary-900 ring-secondary-300';
    break;
    case 'dark':
    $classes .= 'text-white bg-neutral-800 hover:bg-neutral-700 active:bg-neutral-900 focus:border-neutral-900 ring-neutral-300';
    break;
    case 'light':
    $classes .= 'text-neutral-700 bg-neutral-100 hover:bg-neutral-200 active:bg-neutral-300 focus:border-neutral-200 ring-neutral-200';
    break;
    case 'danger':
    $classes .= 'text-white bg-danger-600 hover:bg-danger-500 active:bg-danger-900 focus:border-danger-900 ring-danger-300';
    break;
    case 'success':
    $classes .= 'text-white bg-success-600 hover:bg-success-500 active:bg-success-900 focus:border-success-900 ring-success-300';
    break;
    }
@endphp

@if(isset($href))
    <a {{ $attributes->merge(['href' => $href, 'class' => 'inline-flex items-center justify-center px-2.5 py-1.5
    border border-transparent rounded-md font-medium tracking-wide focus:outline-none focus:ring
    disabled:opacity-25 transition ease-in-out duration-150 gap-x-1 ' . $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-2.5 py-1.5
    border border-transparent rounded-md text-sm font-medium tracking-wide focus:outline-none focus:ring
    disabled:opacity-25 transition ease-in-out duration-150 gap-x-1 ' . $classes]) }}>
        {{ $slot }}
    </button>
@endif
