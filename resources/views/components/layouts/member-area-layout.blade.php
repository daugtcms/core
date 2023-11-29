<x-sitebrew::layouts.member-area-base>
    <x-sitebrew::template-renderer :within-template="true" :usage="\Sitebrew\Enums\Blocks\TemplateUsage::MEMBER_AREA->value">
        {{$slot}}
    </x-sitebrew::template-renderer>
</x-sitebrew::layouts.member-area-base>