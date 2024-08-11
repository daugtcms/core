<form class="p-3" wire:submit="save">
    <x-daugt::modal.header>{{__('daugt::blocks.editing_block')}}</x-daugt::modal.header>
    <div class="flex flex-col gap-y-2">
        @if(isset($this->block->block))
            <div class="bg-neutral-50 rounded-md pb-1 divide-y-2 divide-neutral-200 overflow-hidden border-neutral-200 border-2">
                <div class="px-3 py-1 bg-neutral-100">
                    <p class="text-lg">{{__('daugt::blocks.attributes')}}</p>
                </div>
                @foreach(\Daugt\Misc\ThemeRegistry::getThemeBlock($this->block->block)->attributes   as $key => $attribute)
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