<div class="relative w-full h-[36rem]">
    <img class="absolute h-full w-full object-cover"
         src="{{get_single_media($backgroundImage) ?: 'https://images.unsplash.com/photo-1567532900872-f4e906cbf06a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1280&q=80'}}"
         alt="header-image">
    <div class="absolute h-full w-full bg-gradient-to-tl from-primary-800/50 to-primary-300/50"></div>
    <div class="container mx-auto px-4 h-full">
        <div class="relative sm:overflow-hidden h-full flex flex-col sm:flex-row items-center justify-between pt-28 sm:pt-0">
            <div class="relative flex items-start flex-col border-l-4 border-secondary-400 sm:mt-12 pl-4">

                <h1 class="text-4xl text-left font-extrabold tracking-tight sm:text-5xl lg:text-7xl">
                    <span class="block text-secondary-400 drop-shadow-xl">{{$title ?: 'Lorem ipsum'}}</span>
                </h1>
                <p class="mt-6 max-w-lg text-xl md:text-2xl text-secondary-50 text-left">
                    {{$subtitle ?: 'Excepteur voluptate nulla incididunt labore sint laborum cillum eiusmod. Eu eu sunt dolor adipisicing qui.'}}</p>

            </div>

            <div class="flex items-end justify-end w-full sm:w-auto h-64 sm:h-full sm:pt-28 sm:pr-12 md:pr-20 flex-shrink-0">
                <img src="{{get_single_media($personImage)}}" class="h-full sm:h-auto sm:w-96">
            </div>
        </div>
    </div>
</div>