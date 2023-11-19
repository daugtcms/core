<form class="p-3" wire:submit="save">
    @php
        $templates = config('sitebrew.available_templates');

        $templates = collect($templates)->map(function (string $item, string $key){
            return [
                'value' => $key
            ];
        })->values()->toJson();

        $usages = collect(\Sitebrew\Enums\Blocks\TemplateUsage::cases())->map(function (\Sitebrew\Enums\Blocks\TemplateUsage $usage){
            return [
                'value' => $usage->value,
                'title' => $usage->name
            ];
        });

        $usages = $usages->push(...collect(config('sitebrew.content_types'))->map(function (string $item, string $key){
            return [
                'value' => $key,
                'title' => $item
            ];
        })->values());

        $usages = $usages->values()->toJson();
    @endphp
    <x-sitebrew::modal.header>{{__('sitebrew::blocks.manage_template')}}</x-sitebrew::modal.header>
    <div class="flex flex-col gap-y-2">
        <div>
            <x-sitebrew::form.label for="name">{{__('sitebrew::general.name')}}</x-sitebrew::form.label>
            <x-sitebrew::form.input id="name" wire:model.blur="name" :error="$errors->first('name')"/>
        </div>
        <div>
            <x-sitebrew::form.label for="usage">{{__('sitebrew::general.usage')}}</x-sitebrew::form.label>
            <x-sitebrew::form.select id="usage" wire:model.live="usage"
                                     :error="$errors->first('usage')"
                                     :options="$usages"></x-sitebrew::form.select>
        </div>
        <div class="mb-1">
            <x-sitebrew::form.label for="view_name">{{__('sitebrew::general.viewName')}}</x-sitebrew::form.label>
            <x-sitebrew::form.select id="view_name" wire:model.live="view_name"
                                      :error="$errors->first('view_name')"
                                      :options="$templates"></x-sitebrew::form.select>
        </div>
        @if(isset($templateBlock))
            <div class="bg-neutral-50 rounded-md pb-1 divide-y-2 divide-neutral-200 overflow-hidden border-neutral-200 border-2">
                <div class="px-3 py-1 bg-neutral-100">
                    <p class="text-lg">{{__('sitebrew::blocks.attributes')}}</p>
                </div>
                @foreach($templateBlock->getMetadata()['attributes'] as $key => $attribute)
                    <x-sitebrew::blocks.attribute-input :key="$key"
                                                        wire:key="{{$key}}"
                                                         :attribute="$attribute"
                                                         wire:model="data.{{$key}}"></x-sitebrew::blocks.attribute-input>
                @endforeach
            </div>
        @endif

    </div>
    <x-sitebrew::modal.footer class="justify-end">
        <x-sitebrew::form.button style="primary">{{__('sitebrew::general.save')}}</x-sitebrew::form.button>
    </x-sitebrew::modal.footer>
</form>