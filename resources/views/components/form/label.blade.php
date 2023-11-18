@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-gray-700']) }}>
    {{ $value ?? $slot }}
    @if(isset($additional))
    <p class="opacity-75 text-sm -mt-0.5 mb-1">
        {{ $additional ?? '' }}
    </p>
    @endif
</label>