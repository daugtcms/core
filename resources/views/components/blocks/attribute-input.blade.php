@props(['key' => '', 'attribute'])
@php
    use Sitebrew\Enums\Blocks\AttributeType;
@endphp
<div class="w-full px-3 py-2">
    <h2 class="font-medium">{{$attribute['title']}}</h2>
    @isset($attribute['description'])
        <h3 class="text-sm text-neutral-500 break-words">{{$attribute['description']}}</h3>
    @endisset
    @if(isset($attribute['readonly']) && $attribute['readonly'])
        <p class="text-sm mt-1.5 text-neutral-500 italic text-center">{{__('sitebrew::blocks.readonly_info')}}</p>
    @else
        @switch($attribute['type']->value)
            @case(AttributeType::TEXT->value)
                <x-sitebrew::form.input class="w-full mt-1" type="text"
                                        placeholder="{{Str::ucfirst($attribute['type']->value)}}" {{ $attributes }}>
                </x-sitebrew::form.input>
                @break
            @case(AttributeType::NUMBER->value)
                <x-sitebrew::form.input class="w-full mt-1" type="number" required
                                        placeholder="{{Str::ucfirst($attribute['type']->value)}}" {{ $attributes }}>
                </x-sitebrew::form.input>
                @break
            @case(AttributeType::BOOLEAN->value)
                <div class="pt-1 -mb-2">
                    <x-sitebrew::form.checkbox {{$attributes}}>{{$attribute['title']}}</x-sitebrew::form.checkbox>
                </div>
                @break
            @case(AttributeType::RICH_TEXT->value)
                <x-sitebrew::form.rich-text {{$attributes}}></x-sitebrew::form.rich-text>
                @break
            @case(AttributeType::MEDIA->value)
                <x-sitebrew::form.media {{$attributes}}></x-sitebrew::form.media>
                @break
            @case(AttributeType::CUSTOM_SELECT->value)
                @php
                    $options = collect($attribute['options'])->map(function($value, $key) use (&$options){
                        return [
                            'value' => $key,
                            'title' => $value
                        ];
                    })->values()->toJson();
                @endphp
                <x-sitebrew::form.select :options="$options" {{ $attributes }}></x-sitebrew::form.select>
                @break
            @case(AttributeType::NAVIGATION->value)
                @php
                    \Sitebrew\Models\Listing\Listing::where('usage', \Sitebrew\Enums\Listing\ListingUsage::NAVIGATION)->each(function(\Sitebrew\Models\Listing\Listing $navigation) use (&$navigations){
                        $navigations[] = [
                            'value' => $navigation->id,
                            'title' => $navigation->name
                        ];
                    });
                    $navigations = collect($navigations)->toJson()
                @endphp
                <x-sitebrew::form.select :options="$navigations" {{ $attributes }}></x-sitebrew::form.select>
                @break
            @case(AttributeType::BLOG_CATEGORY->value)
                @php
                    \Sitebrew\Models\Listing\Listing::where('usage', \Sitebrew\Enums\Listing\ListingUsage::BLOG_CATEGORIES)->first()->items->each(function(\Sitebrew\Models\Listing\ListingItem $blogCategory) use (&$blogCategories){
                        $blogCategories[] = [
                            'value' => $blogCategory->id,
                            'title' => $blogCategory->name
                        ];
                    });
                    $blogCategories = collect($blogCategories)->toJson()
                @endphp
                <x-sitebrew::form.select :options="$blogCategories" {{ $attributes }}></x-sitebrew::form.select>
                @break
            @case(AttributeType::COURSE_SECTION->value)
                @php
                    $courseSections = [];
                    \Sitebrew\Models\Listing\Listing::where('usage', \Sitebrew\Enums\Listing\ListingUsage::COURSE->value)->with('items')->get()->each(function(\Sitebrew\Models\Listing\Listing $course) use (&$courseSections){
                        $course->items->each(function(\Sitebrew\Models\Listing\ListingItem $courseSection) use (&$courseSections, $course){
                            $courseSections[] = [
                                'value' => $courseSection->id,
                                'title' => $course->name . ' - ' . $courseSection->name
                            ];
                        });
                    });
                    $courseSections = collect($courseSections)->toJson()

                @endphp
                <x-sitebrew::form.select :options="$courseSections" {{ $attributes }}></x-sitebrew::form.select>
                @break
        @endswitch
    @endif
</div>
