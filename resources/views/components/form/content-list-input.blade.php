<div x-data="{
            type: '',
            section: '',
            get combinedValue() {
                return {
                    type: this.type,
                    section: this.section,
                };
            },
            set combinedValue(value) {
                if (value) {
                    try {
                        const data = value;
                        this.type = data.type || '';
                        this.section = data.section || '';
                    } catch (e) {
                        console.error('Invalid JSON value for combinedValue:', e);
                    }
                }
            },
        }" x-modelable="combinedValue" {{ $attributes->wire('model') }}
    class="gap-y-2 flex flex-col">
    <!-- Display Text Input -->
    @php
        $content_types = \Daugt\Misc\ContentTypeRegistry::getContentTypes()->filter(function($type) {
            return $type->listable;
        });

        // value is the key of the element and title is the value of the element
        $options = $content_types->map(function($type, $key) {
            return [
                'value' => $key,
                'title' => $type->name
            ];
        })->values()->toJson();
    @endphp
    <x-daugt::form.select x-model="type" placeholder="{{__('daugt::general.type')}}" :options="$options"/>
</div>
