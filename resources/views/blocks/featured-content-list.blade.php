<div class="container w-full ">
    <div class=" rounded-md  py-3 overflow-hidden">
        @if($contentList)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 overflow-auto-x">
                @foreach($contentList['items'] as $key=>$item)
                    <div @class([
                            'md:mt-12' => $key % 2 === 1
                        ])>
                        {{-- TODO: Make this dynamic based on given type --}}
                        <x-daugt::template-renderer :usage="'blog_card'"
                                                       :within-template="true"
                                                       :attributes="['content' => $item]"></x-daugt::template-renderer>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <section class="px-0 pt-6 pb-2 flex justify-center">
        {{-- TODO: Make this dynamic based on given type --}}
        <x-daugt::form.button href="{{route('daugt.content.show', ['blog'])}}" style="primary" class="!text-lg gap-x-2.5">Alle ansehen <div class="i-lucide:arrow-right"></div></x-daugt::form.button>
    </section>
</div>