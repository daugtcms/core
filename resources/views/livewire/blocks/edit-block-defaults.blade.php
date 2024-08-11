<form class="p-3" wire:submit="save">
    @php
        $templates = \Daugt\Misc\ThemeRegistry::getThemeTemplates();

        $templates = collect($templates)->map(function (array $item, string $key){
            return [
                'value' => $key,
                'title' => $item['name']
            ];
        })->values()->toJson();

        $usages = collect();
        collect(\Daugt\Misc\TemplateUsageRegistry::getTemplateUsages())->each(function (\Daugt\Data\Theme\TemplateUsageData $usage, string $key) use(&$usages){
            $usages->push([
                'value' => $key,
                'title' => $usage->name
            ]);
        });

        $usages = $usages->values()->toJson();
    @endphp
    <x-daugt::modal.header>{{__('daugt::blocks.edit_block_defaults')}}</x-daugt::modal.header>
    <div class="flex flex-col gap-y-2">
        <div>
            <x-daugt::form.label for="name">{{__('daugt::general.name')}}</x-daugt::form.label>
            <x-daugt::form.input id="name" readonly disabled :value="$themeBlock->name"/>
        </div>
        @if(isset($themeBlock->attributes))
            <div class="bg-neutral-50 rounded-md pb-1 divide-y-2 divide-neutral-200 overflow-hidden border-neutral-200 border-2">
                <div class="px-3 py-1 bg-neutral-100">
                    <p class="text-lg">{{__('daugt::blocks.attributes')}}</p>
                </div>
                @foreach($themeBlock->attributes as $key => $attribute)
                    <div class="px-2 py-2">
                        <x-daugt::blocks.attribute-input :key="$key"
                                                            wire:key="{{$key}}"
                                                            :attribute="$attribute"
                                                            wire:model="data.{{$key}}"></x-daugt::blocks.attribute-input>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <x-daugt::modal.footer class="justify-end">
        <x-daugt::form.button style="primary">{{__('daugt::general.save')}}</x-daugt::form.button>
    </x-daugt::modal.footer>
</form>