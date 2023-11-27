<div class="container gap-y-3 flex flex-col py-3">
    @foreach($mediaList as $item)
        @php
            $media = \Plank\Mediable\Media::where('id', $item['id'])->first();
        @endphp
        @if(!empty($media))
        <div
                @class([
                'border-2 border-neutral-200' => $showLabel || ($media->aggregate_type != 'image' && $media->aggregate_type != 'video'),
                'rounded-lg overflow-hidden divide-y-2 divide-neutral-100'
           ])>
            @if($showLabel || ($media->aggregate_type != 'image' && $media->aggregate_type != 'video' && $media->aggregate_type != 'audio'))
                <div
                        class="w-full bg-neutral-50 gap-x-2 px-3 py-2.5 truncate text-sm font-medium text-neutral-700 flex items-center">
                    @switch($media->aggregate_type)
                        @case(\Plank\Mediable\Media::TYPE_IMAGE)
                            @svg('image', 'h-5 w-5 shrink-0 text-primary-600 mr-2')
                            @break
                        @case(\Plank\Mediable\Media::TYPE_VIDEO)
                            @svg('video', 'h-5 w-5 shrink-0 text-primary-600 mr-2')
                            @break
                        @case(\Plank\Mediable\Media::TYPE_AUDIO)
                            @svg('volume-2', 'h-5 w-5 shrink-0 text-primary-600 mr-2')
                            @break
                        @default
                            @svg('file', 'h-5 w-5 shrink-0 text-primary-600 mr-2')
                            @break
                    @endswitch
                    <span>{{$media->name}}</span>
                </div>
            @endif
        @switch($media->aggregate_type)
            @case(\Plank\Mediable\Media::TYPE_IMAGE)
                <img src="{{\Sitebrew\Helpers\Media\MediaHelper::getMedia($media, $item['variant'])}}" alt="{{$media->filename}}" @class([' mx-auto max-w-full', 'rounded-lg' => !$showLabel]) style="max-height: {{$maxItemHeight}}px">
                @break
            @case(\Plank\Mediable\Media::TYPE_VIDEO)
                    <video controls x-cloak x-init="new Plyr($el)" playsinline>
                        <source src="{{MediaHelper::getMedia($media, $item['variant'])}}">
                    </video>
                @break
            @case(\Plank\Mediable\Media::TYPE_AUDIO)
                        <audio controls x-cloak x-init="new Plyr($el)">
                            <source src="{{MediaHelper::getMedia($media, $item['variant'])}}">
                        </audio>
                    @break
            @default
                    <div class="flex items-center justify-between w-full flex-1 px-3">
                        <p class="py-3 leading-4 text-neutral-500">

                            @php
                                if ( $media->size > 0 ) {
                                $size = (int) $media->size;
                                $base = log($size) / log(1024);
                                $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');
                                $size = round(pow(1024, $base - floor($base)), 2) . $suffixes[floor($base)];
                                } else {
                                $size = $media->size;
                                }
                            @endphp
                        <span class="flex-1 w-0 truncate">
                            .{{$media->extension}} - {{$size}}
                        </span>
                        </p>
                        <div class="shrink-0 ml-4">
                            <a href="{{MediaHelper::getMedia($media, 'optimized')}}" target="_blank"
                               class="font-medium text-primary-600 hover:text-primary-500 px-2 py-1 rounded-md hover:bg-primary-100">
                                Herunterladen
                            </a>
                        </div>
                    </div>

                </li>
                @break
        @endswitch
        </div>
        @endif
    @endforeach
</div>