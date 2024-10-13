<div x-data="{
            text: '',
            url: '',
            get combinedValue() {
                return {
                    text: this.text,
                    url: this.url,
                };
            },
            set combinedValue(value) {
                if (value) {
                    try {
                        const data = value;
                        this.text = data.text || '';
                        this.url = data.url || '';
                    } catch (e) {
                        console.error('Invalid JSON value for combinedValue:', e);
                    }
                }
            },
        }" x-modelable="combinedValue" {{ $attributes->wire('model') }}
    class="gap-y-2 flex flex-col">
    <!-- Display Text Input -->
    <x-daugt::form.input type="text" x-model="text" placeholder="{{__('daugt::content.display_text')}}"/>

    <!-- Link URL Input -->
    <x-daugt::form.input type="text" x-model="url" placeholder="{{__('daugt::content.link_url')}}"/>
</div>
