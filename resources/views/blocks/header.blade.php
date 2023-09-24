<div class="relative sm:mt-10">
    <div class="container mx-auto sm:px-6 lg:px-8">
        <div class="relative shadow-xl sm:rounded-2xl sm:overflow-hidden">
            <div class="absolute inset-0">
                <img class="h-full w-full object-cover"
                     src="{{$backgroundImage ?: 'https://images.unsplash.com/photo-1567532900872-f4e906cbf06a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1280&q=80'}}" alt="header-image">
                <div class="absolute inset-0 bg-gradient-to-tl from-primary-700/75 to-primary-300/20">
                </div>
            </div>
            <div class="relative px-4 py-16 sm:px-6 sm:py-24 lg:py-40 lg:px-8 flex items-end flex-col">

                <h1 class="text-4xl text-right font-extrabold tracking-tight sm:text-5xl lg:text-6xl">
                    <span class="block text-primary-200">{{$title ?: 'Lorem ipsum'}}</span>
                </h1>
                <p class="mt-6 max-w-lg text-xl text-white text-right">
                    {{$subtitle ?: 'Excepteur voluptate nulla incididunt labore sint laborum cillum eiusmod. Eu eu sunt dolor adipisicing qui.'}}</p>

            </div>
        </div>
    </div>
</div>