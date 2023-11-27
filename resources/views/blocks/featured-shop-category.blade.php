<div class="container w-full ">
    <div class=" rounded-md  py-3 overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 overflow-auto-x">
            @for ($i = 0; $i < 4; $i++)
                <article
                        class="flex bg-neutral-100 transition rounded-lg overflow-hidden w-[42rem] max-w-full border-2 border-neutral-200 flex-shrink-0">
                    <div class="block basis-36 sm:basis-48">
                        <img
                                alt="Guitar"
                                @if($i == 0)
                                    src="https://images.unsplash.com/photo-1581783350171-15a0fc91d955?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=5070&q=80"
                                @elseif($i == 1)
                                    src="https://images.unsplash.com/photo-1615388248492-19ea9a40f115?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=4140&q=80"
                                @elseif($i == 2)
                                    src="https://images.unsplash.com/photo-1476994230281-1448088947db?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2848&q=80"
                                @else
                                    src="https://images.unsplash.com/photo-1588406320565-9fa6d9901d1d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2832&q=80"
                                @endif
                                class="aspect-square h-full w-full object-cover"
                        />
                    </div>

                    <div class="flex flex-1 flex-col justify-between">
                        <div class="p-4 sm:p-6">
                            <a href="#">
                                <h3 class="font-bold uppercase text-neutral-800">
                                    Der Weg zur Selbstbestimmung
                                </h3>
                            </a>
                            <time
                                    datetime="2022-10-10"
                                    class="flex items-center justify-between gap-4 text-xs font-bold uppercase text-neutral-400"
                            >
                                <span>13. September 2023</span>
                            </time>

                            <p class="mt-2 line-clamp-3 text-sm/relaxed text-neutral-700">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae
                                dolores, possimus pariatur animi temporibus nesciunt praesentium dolore
                                sed nulla ipsum eveniet corporis quidem, mollitia itaque minus soluta,
                                voluptates neque explicabo tempora nisi culpa eius atque dignissimos.
                                Molestias explicabo corporis voluptatem?
                            </p>
                        </div>

                        <div class="flex items-end justify-end">
                            <a
                                    href="#"
                                    class="block rounded-tl-md bg-primary-600 px-5 py-3 text-center text-sm font-semibold text-white transition hover:bg-primary-500"
                            >
                                Mehr erfahren
                            </a>
                        </div>
                    </div>
                </article>

            @endfor
        </div>
    </div>
    <section class="px-0 pt-1 pb-2 mx-auto">
        <a class="text-white bg-neutral-100 hover:bg-neutral-200 border-neutral-200 border-2 rounded-lg flex cursor-pointer">
            <div class="flex w-full items-center justify-between py-4 flex-row px-3">
                <p class="text-base font-semibold text-neutral-700">Alle Workshops im Shop entdecken</p>
                @svg('arrow-right', 'w-6 h-6 text-neutral-600')
            </div>
        </a>
    </section>
</div>