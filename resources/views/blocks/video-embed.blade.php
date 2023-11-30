<div class="container rounded-md !overflow-hidden">
<div class="plyr__video-embed" id="player" x-data x-init="new Plyr($el)">
    @php
        // replace youtube.com with youtube-nocookie.com to enable privacy mode
        $url = str_replace('youtube.com', 'youtube-nocookie.com', $url);
    @endphp
    <iframe
            src="{{$url}}"
            allowfullscreen
            allowtransparency
            allow="autoplay"
    ></iframe>
</div>
</div>