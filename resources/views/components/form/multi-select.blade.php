@props(['options' => '', 'error' => '', 'multi' => false])
<div x-data="{
        selectOpen: false,
        selectedItems: [],
        selectableItems: {{$options ?? '[]'}},
        selectableItemActive: null,
        selectId: $id('select'),
        selectKeydownValue: '',
        selectKeydownTimeout: 1000,
        selectKeydownClearTimeout: null,
        isMultiSelect: {{$multi ? 'true' : 'false'}},
        selectableItemIsActive(item) {
            return this.selectableItemActive && this.selectableItemActive.value==item.value;
        },
        selectableItemActiveNext(){
            let index = this.selectableItems.indexOf(this.selectableItemActive);
            if(index < this.selectableItems.length-1){
                this.selectableItemActive = this.selectableItems[index+1];
                this.selectScrollToActiveItem();
            }
        },
        selectableItemActivePrevious(){
            let index = this.selectableItems.indexOf(this.selectableItemActive);
            if(index > 0){
                this.selectableItemActive = this.selectableItems[index-1];
                this.selectScrollToActiveItem();
            }
        },
        selectScrollToActiveItem(){
            if(this.selectableItemActive){
                document.getElementById(this.selectableItemActive.value + '-' + this.selectId).scrollIntoView({block: 'nearest'});
            }
        },
        toggleItem(item) {
            if (this.isMultiSelect) {
                if (this.selectedItems.includes(item.value)) {
                    this.selectedItems = this.selectedItems.filter(selectedItem => selectedItem !== item.value);
                } else {
                    this.selectedItems = [...this.selectedItems, item.value];
                }
            } else {
                this.selectedItems = [item.value];
                this.selectOpen = false;
            }
        },
        selectKeydown(event){
            if (event.keyCode >= 65 && event.keyCode <= 90) {
                this.selectKeydownValue += event.key;
                selectedItemBestMatch = this.selectItemsFindBestMatch();
                if(selectedItemBestMatch){
                    if(this.selectOpen){
                        this.selectableItemActive = selectedItemBestMatch;
                        this.selectScrollToActiveItem();
                    } else {
                        // this.selectedItem = this.selectableItemActive = selectedItemBestMatch;
                    }
                }

                if(this.selectKeydownValue != ''){
                    clearTimeout(this.selectKeydownClearTimeout);
                    this.selectKeydownClearTimeout = setTimeout(() => {
                        this.selectKeydownValue = '';
                    }, this.selectKeydownTimeout);
                }
            }

            /*if (this.isMultiSelect && event.key === ' ' && this.selectableItemActive) {
                this.toggleItem(this.selectableItemActive);
            }*/
        },
        selectItemsFindBestMatch(){
            typedValue = this.selectKeydownValue.toLowerCase();
            var bestMatch = null;
            var bestMatchIndex = -1;
            for (var i = 0; i < this.selectableItems.length; i++) {
                var title = this.selectableItems[i].title.toLowerCase();
                var index = title.indexOf(typedValue);
                if (index > -1 && (bestMatchIndex == -1 || index < bestMatchIndex) && !this.selectableItems[i].disabled) {
                    bestMatch = this.selectableItems[i];
                    bestMatchIndex = index;
                }
            }
            return bestMatch;
        }
    }"
     x-init="
        $watch('selectOpen', function(){
            if(!selectedItems.length){
                selectableItemActive=selectableItems[0];
            } else {
                selectableItemActive=selectedItems[0];
            }
            setTimeout(function(){
                selectScrollToActiveItem();
            }, 10);
        });
        selectedValue = $wire.get('{{ $attributes->wire('model')->value() }}')
        if(selectedValue){
            // selectedItem = selectableItems.find(item => item.value == selectedValue);
        }
"
     @keydown.escape="if(selectOpen){ selectOpen=false; }"
     @keydown.down="if(selectOpen){ selectableItemActiveNext(); } else { selectOpen=true; } event.preventDefault();"
     @keydown.up="if(selectOpen){ selectableItemActivePrevious(); } else { selectOpen=true; } event.preventDefault();"
     @keydown.enter="if(selectOpen){ toggleItem(selectableItemActive); $event.preventDefault() };"
     @keydown="selectKeydown($event);"
     @keydown.space="if(selectOpen){ toggleItem(selectableItemActive); $event.preventDefault() };"
     class="relative">

    @php
        $classList = 'relative py-1.5 rounded-md shadow-sm border-neutral-300 border focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 w-full flex text-left pl-3 focus:outline-none';
        if($error) {
            $classList .= ' border-danger-500 ring ring-danger-200 ring-opacity-50';
        }
    @endphp

    <button type="button" x-modelable="selectedItems" x-ref="selectButton"
            @click="$refs.panel.toggle; selectOpen=true;" {{$attributes->merge(['class' => $classList])}}>
        <span x-text="selectedItems.length > 0 ? selectedItems.map(item => ({{--item.title ?? item.value--}}item)).join(', ') : '{{ __('sitebrew::general.no_value_available') }}'"
              :class="{ 'truncate pr-7': true, 'text-neutral-500': selectedItems.length === 0 }">{{ __('sitebrew::general.no_value_available') }}</span>
        <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
            @svg('chevrons-left-right', 'w-5 h-5 text-neutral-400 rotate-90')
        </span>
    </button>
    @if($error)
        <div class="text-sm text-danger-600 mt-1">{{$error}}</div>
    @endif

    <ul
            x-ref="panel"
            x-transition:enter="transition ease-out duration-50"
            x-transition:enter-start="opacity-0 -translate-y-1"
            x-transition:enter-end="opacity-100"
            x-float.placement.bottom-start.flip.offset.size.trap.hide="{
                size: {
                    apply(obj) {
                        // Do things with the data, e.g.
                        Object.assign($refs.panel.style, {
                            maxWidth: `${obj.reference.width}px`,
                        });
                    },
                },
                offset: 2
            }"
            class="absolute w-full py-1 mt-1 overflow-auto text-sm bg-white rounded-md shadow-md max-h-56 ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
            x-cloak>

        <template x-for="item in selectableItems" :key="item.value">
            <li
                    @click="toggleItem(item)"
                    :id="item.value + '-' + selectId"
                    :data-disabled="item.disabled"
                    :class="{ 'bg-neutral-100 text-gray-900' : selectableItemIsActive(item), '' : !selectableItemIsActive(item) }"
                    @mousemove="selectableItemActive=item"
                    class="relative flex items-center h-full py-2 pl-8 text-gray-700 cursor-default select-none data-[disabled=true]:opacity-50  data-[disabled=true]:pointer-events-none">
                <svg x-show="selectedItems.includes(item.value)"
                     class="absolute left-0 w-4 h-4 ml-2 stroke-current text-neutral-400"
                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <span class="block truncate" x-text="item.title ?? item.value"></span>
            </li>
        </template>

    </ul>

</div>