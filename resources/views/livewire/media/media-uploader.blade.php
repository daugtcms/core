<div>
<div wire:ignore class="p-3" x-data x-init="
    const pond = FilePond.create($refs.input, {
        allowMultiple: true,
        allowRevert: false,
        allowRemove: false,
        allowReorder: false,
        allowReplace: false,
        server: {
            process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                @this.upload('files', file, load, error, (event) => {
                    progress(event.detail.progress, event.detail.progress, 100);
                })
            },
            revert: (filename, load) => {
                @this.removeUpload('files', filename, load)
            },
        },
    });
    /*this.addEventListener('pondReset', e => {
        pond.removeFiles();
    });*/">
    <x-daugt::modal.header close="close()">
            {{ __('daugt::media.upload_files') }}
    </x-daugt::modal.header>
    <input x-ref="input" type="file" multiple>
</div>
</div>