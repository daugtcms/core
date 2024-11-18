<div class="container gap-y-3 flex flex-col py-3">
    @isset($mediaList)
        @forelse($mediaList as $media)
            @if(!empty($media))
                <div
                        @class([
                        'border-2 border-neutral-200' => $showLabel || ($media['aggregate_type'] != 'image' && $media['aggregate_type'] != 'video'),
                        'rounded-lg overflow-hidden divide-y-2 divide-neutral-100'
                   ])>
                    @if($showLabel || ($media['aggregate_type'] != 'image' && $media['aggregate_type'] != 'video' && $media['aggregate_type'] != 'audio'))
                        <div
                                class="w-full bg-neutral-50 gap-x-1.5 px-3 py-2.5 truncate text-sm font-medium text-neutral-700 flex items-center">
                            @switch($media['aggregate_type'])
                                @case(\Plank\Mediable\Media::TYPE_IMAGE)
                                    <div class="i-lucide:image h-5 w-5 shrink-0 text-primary-600 mr-1.5"></div>
                                    @break
                                @case(\Plank\Mediable\Media::TYPE_VIDEO)
                                    <div class="i-lucide:video h-5 w-5 shrink-0 text-primary-600 mr-1.5"></div>
                                    @break
                                @case(\Plank\Mediable\Media::TYPE_AUDIO)
                                    <div class="i-lucide:volume-2 h-5 w-5 shrink-0 text-primary-600 mr-1.5"></div>
                                    @break
                                @case(\Plank\Mediable\Media::TYPE_PDF)
                                    <div class="i-lucide:file-text h-5 w-5 shrink-0 text-primary-600 mr-1.5"></div>
                                    @break
                                @default
                                    <div class="i-lucide:file h-5 w-5 shrink-0 text-primary-600 mr-1.5"></div>
                                    @break
                            @endswitch
                            <span>{{$media['name']}}</span>
                        </div>
                    @endif
                    @switch($media['aggregate_type'])
                        @case(\Plank\Mediable\Media::TYPE_IMAGE)
                            <img src="{{$media['url']}}"
                                 alt="{{$media['filename']}}"
                                 @class([' mx-auto max-w-full', 'rounded-lg' => !$showLabel]) style="max-height: {{$maxItemHeight ?? '720px'}}px">
                            @break
                        @case(\Plank\Mediable\Media::TYPE_VIDEO)
                            <video controls x-cloak x-init="new Plyr($el)" playsinline style="max-height: {{$maxItemHeight ?? '720px'}}px">
                                <source src="{{$media['url']}}">
                            </video>
                            @break
                        @case(\Plank\Mediable\Media::TYPE_AUDIO)
                            <audio controls x-cloak x-init="new Plyr($el)">
                                <source src="{{$media['url']}}">
                            </audio>
                            @break
                        @case(\Plank\Mediable\Media::TYPE_PDF)
                                <div class="flex items-center justify-between w-full flex-1 px-3">
                                    <p class="py-3 leading-4 text-neutral-500">

                                        @php
                                            if ( $media['size'] > 0 ) {
                                            $size = (int) $media['size'];
                                            $base = log($size) / log(1024);
                                            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');
                                            $size = round(pow(1024, $base - floor($base)), 2) . $suffixes[floor($base)];
                                            } else {
                                            $size = $media['size'];
                                            }
                                        @endphp
                                        <span class="flex-1 w-0 truncate">
                                            .{{$media['extension']}} - {{$size}}
                                        </span>
                                    </p>
                                    <div class="shrink-0 ml-4" x-data="{pdfOpen: false}">
                                        <button @click="pdfOpen = true" target="_blank"
                                           class="font-medium text-primary-600 hover:text-primary-500 px-2 py-1 rounded-md hover:bg-primary-100">
                                            Anzeigen
                                        </button>
                                        <template x-if="pdfOpen">
                                            <dialog class="h-full w-full bg-transparent backdrop:bg-black/50" x-data="" x-init="$el.showModal()" x-trap.noscroll.inert="pdfOpen" @cancel="pdfOpen=false">
                                                <x-daugt::media.pdf-viewer :src="$media['url']"></x-daugt::media.pdf-viewer>
                                                <x-daugt::form.icon-button style="dark" icon="lucide-x" class="fixed top-2 right-2" @click="pdfOpen=false">
                                                </x-daugt::form.icon-button>
                                            </dialog>
                                        </template>
                                    </div>
                                </div>
                            @break
                        @default
                            <div class="flex items-center justify-between w-full flex-1 px-3">
                                <p class="py-3 leading-4 text-neutral-500">
                                    @php
                                        if ( $media['size'] > 0 ) {
                                        $size = (int) $media['size'];
                                        $base = log($size) / log(1024);
                                        $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');
                                        $size = round(pow(1024, $base - floor($base)), 2) . $suffixes[floor($base)];
                                        } else {
                                        $size = $media['size'];
                                        }
                                    @endphp
                                    <span class="flex-1 w-0 truncate">
                                .{{$media['extension']}} - {{$size}}
                            </span>
                                </p>
                                <div class="shrink-0 ml-4">
                                    <a href="{{$media['url']}}" target="_blank"
                                       class="font-medium text-primary-600 hover:text-primary-500 px-2 py-1 rounded-md hover:bg-primary-100">
                                        Herunterladen
                                    </a>
                                </div>
                            </div>
                            @break
                    @endswitch
                </div>
            @endif
        @empty
            <i>Keine Medien ausgewählt</i>
        @endforelse
    @endisset
</div>