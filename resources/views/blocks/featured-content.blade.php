<div class="relative container py-1">
    <div class="w-full bg-neutral-100 border-2 border-neutral-200 rounded-md flex flex-col sm:flex-row items-center p-3 gap-y-3 gap-x-6">
        <img class="aspect-[3/2] flex-shrink-0 w-full max-w-full sm:w-64 object-cover rounded-md border-secondary-500 border-2"
             src="{{get_single_media($featuredImage) ?: 'https://images.unsplash.com/photo-1567532900872-f4e906cbf06a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1280&q=80'}}">
        <div class="">
            <p class="text-secondary-500 text-lg font-semibold">{{$title ?: 'Lorem ipsum'}}</p>
            <h2 class="text-xl font-semibold text-secondary-800">{{$subtitle ?: 'Anim nostrud proident fugiat quis'}}</h2>
            <p class="text-neutral-600">{{$text ?: 'Et labore velit Lorem reprehenderit reprehenderit reprehenderit fugiat est ea amet nostrud magna minim. Ullamco ex exercitation irure amet irure occaecat ullamco.'}}</p>
            <x-sitebrew::form.button style="secondary" :href="$link" class="mt-2"
                                      target="_blank">{{$linkText}} @svg('arrow-right', 'h-5 w-5')</x-sitebrew::form.button>
        </div>
    </div>
</div>