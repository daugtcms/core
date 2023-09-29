@props(['disabled' => false, 'error'])

@php
    $classList = 'py-1.5 rounded-md shadow-sm border-neutral-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 w-full';

    if($error) {
        $classList .= ' border-danger-500 ring ring-danger-200 ring-opacity-50';
    }
@endphp

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $classList]) !!}>
@if($error)
    <div class="text-sm text-danger-600 mt-1">{{$error}}</div>
@endif