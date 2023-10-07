<form class="p-3" wire:submit="save">
    @php
        $templates = config('site-core.available_templates');

        $templates = collect($templates)->map(function (string $item, string $key){
            return [
                'value' => $key
            ];
        })->values()->toJson();
    @endphp
    <x-site-core::modal.header>{{__('site-core::blocks.manage_template')}}</x-site-core::modal.header>
    <div class="flex flex-col gap-y-2">
        <div>
            <x-site-core::form.label for="name">{{__('site-core::general.name')}}</x-site-core::form.label>
            <x-site-core::form.input id="name" wire:model.blur="name" :error="$errors->first('name')"/>
        </div>
        <div class="mb-1">
            <x-site-core::form.label for="view_name">{{__('site-core::general.viewName')}}</x-site-core::form.label>
            <x-site-core::form.select id="view_name" wire:model.live="view_name"
                                      :error="$errors->first('view_name')"
                                      :options="$templates"></x-site-core::form.select>
        </div>
        @if(isset($templateBlock))
            <div class="bg-neutral-50 rounded-md pb-1 divide-y-2 divide-neutral-200 overflow-hidden border-neutral-200 border-2">
                <div class="px-3 py-1 bg-neutral-100">
                    <p class="text-lg">{{__('site-core::blocks.attributes')}}</p>
                </div>
                @foreach($templateBlock->getMetadata()['attributes'] as $key => $attribute)
                    <x-site-core::blocks.attribute-input :key="$key"
                                                         :attribute="$attribute"
                                                         wire:model="data.{{$key}}"></x-site-core::blocks.attribute-input>
                @endforeach
            </div>
        @endif

    </div>
    <x-site-core::modal.footer class="justify-end">
        <x-site-core::core.button style="primary">{{__('site-core::general.save')}}</x-site-core::core.button>
    </x-site-core::modal.footer>
</form>