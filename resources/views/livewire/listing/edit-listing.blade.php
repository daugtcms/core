<form class="p-3" wire:submit="save">
    <x-sitebrew::modal.header>{{__('sitebrew::listing.manage_listing')}}</x-sitebrew::modal.header>
    <div class="flex flex-col gap-y-2">
        <div>
            <x-sitebrew::form.label for="name">{{__('sitebrew::general.name')}}</x-sitebrew::form.label>
            <x-sitebrew::form.input id="name" wire:model.blur="name" :error="$errors->first('name')"/>
        </div>
        <div>
            @php
                $usages = collect(\Sitebrew\Enums\Listing\ListingUsage::cases())->map(function (\Sitebrew\Enums\Listing\ListingUsage $usage){
                    return [
                        'value' => $usage->value,
                        'title' => $usage->name
                    ];
                })->values()->toJson();
            @endphp
            <x-sitebrew::form.label for="usage">{{__('sitebrew::general.usage')}}</x-sitebrew::form.label>
            <x-sitebrew::form.select id="usage" wire:model.live="usage"
                                     :options="$usages"
                                     :error="$errors->first('usage')"/>
        </div>
        <div>
            <x-sitebrew::form.label for="title">{{__('sitebrew::general.description')}}</x-sitebrew::form.label>
            <x-sitebrew::form.textarea id="title" wire:model.blur="description"
                                       :error="$errors->first('description')"/>
        </div>

        @if($usage == \Sitebrew\Enums\Listing\ListingUsage::COURSE->value)
            <div>
                <x-sitebrew::form.label for="starts_at">{{__('sitebrew::general.starts_at')}}
                    <x-slot name="additional">{{__('sitebrew::content.leave_empty_for_continuous_course')}}</x-slot>
                </x-sitebrew::form.label>
                <x-sitebrew::form.input id="starts_at" wire:model.blur="data.starts_at" type="date" :error="$errors->first('data.starts_at')"/>
            </div>
            <div>
                <x-sitebrew::form.label for="ends_at">{{__('sitebrew::general.ends_at')}}
                    <x-slot name="additional">{{__('sitebrew::content.leave_empty_for_continuous_course')}}</x-slot>
                </x-sitebrew::form.label>
                <x-sitebrew::form.input id="ends_at" wire:model.blur="data.ends_at" type="date" :error="$errors->first('data.ends_at')"/>
            </div>
        @endif
    </div>
    <x-sitebrew::modal.footer class="justify-end">
        <x-sitebrew::form.button style="primary">{{__('sitebrew::general.save')}}</x-sitebrew::form.button>
    </x-sitebrew::modal.footer>
</form>