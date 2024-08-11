<div class="relative container py-1">
    <div
        @class([
            "w-full border-2 rounded-md flex flex-col sm:flex-row items-center p-3 gap-y-3 gap-x-6",
            'bg-neutral-100 border-neutral-200' => $backgroundColor == 'neutral',
            'bg-primary-600 border-primary-200' => $backgroundColor == 'primary',
            'bg-secondary-600 border-secondary-200' => $backgroundColor == 'secondary',
       ])>
        <img @class([
               "flex-shrink-0 w-full max-w-full sm:w-64 sm:max-h-64 object-cover rounded-md border-2",
               "border-secondary-500" => $color == 'secondary',
                "border-primary-500" => $color == 'primary',
                "border-neutral-200" => $color == 'neutral',
               ])
             src="{{get_single_media($featuredImage) ?: 'https://images.unsplash.com/photo-1567532900872-f4e906cbf06a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1280&q=80'}}">
        <div class="">
            <p @class([
            "text-lg font-semibold",
            "text-secondary-500" => $color == 'secondary',
            "text-primary-500" => $color == 'primary',
            "text-neutral-900" => $color == 'neutral',
            ])>{{$title ?: 'Lorem ipsum'}}</p>
            <h2 @class([
            "text-xl font-semibold",
            "text-secondary-700" => $color == 'secondary',
            "text-primary-700" => $color == 'primary',
            "text-neutral-800" => $color == 'neutral',
            ])
            >{{$subtitle ?: 'Anim nostrud proident fugiat quis'}}</h2>
            <p @class([
                "text-neutral-600" => $backgroundColor == 'neutral',
                "text-neutral-200" => $backgroundColor !== 'neutral',
            ])>{{$text ?: 'Et labore velit Lorem reprehenderit reprehenderit reprehenderit fugiat est ea amet nostrud magna minim. Ullamco ex exercitation irure amet irure occaecat ullamco.'}}</p>
            <x-daugt::form.button style="{{$color == 'primary' ? 'primary' : ($color == 'secondary' ? 'secondary' : 'light')}}" :href="$link" class="mt-2"
                                      target="_blank">{{$linkText}} @svg('arrow-right', 'h-5 w-5')</x-daugt::form.button>
        </div>
    </div>
</div>
