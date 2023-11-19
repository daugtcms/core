@props(['name' => ''])

<label for="{{$name}}" class="inline-flex items-center gap-x-2 text text-neutral-700">
    <input class="border-neutral-300 rounded shadow-sm text-primary-600 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
           id="{{$name}}" type="checkbox" name="{{$name}}" {!! $attributes !!}>
    <span>{{$slot}}</span>
</label>