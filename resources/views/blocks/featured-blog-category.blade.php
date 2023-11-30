<div class="container w-full ">
    <div class=" rounded-md  py-3 overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 overflow-auto-x">
            @php
                $posts = collect();
                if(!empty($category)) {
                    $category = \Sitebrew\Models\Listing\ListingItem::with('listing')->where('id', $category)->first();
                    $posts = \Sitebrew\Models\Content\Content::where('type', 'blog')->where('enabled', true)->where('published_at', '<=', now())->orderBy('published_at', 'DESC')->where('blocks->template->attributes->category', $category->id)->limit(3)->get();
                } else {
                    $posts = \Sitebrew\Models\Content\Content::where('type', 'blog')->where('enabled', true)->where('published_at', '<=', now())->orderBy('published_at', 'DESC')->limit(3)->get();
                }
            @endphp
            @foreach($posts as $key=>$post)
                    <div @class([
                        'md:mt-12' => $key % 2 === 1
                    ])>
                <x-sitebrew::template-renderer :usage="\Sitebrew\Enums\Blocks\TemplateUsage::BLOG_POST_CARD->value" :within-template="true" :attributes="['content' => $post]"></x-sitebrew::template-renderer>
                    </div>
            @endforeach
        </div>
    </div>
    <section class="px-0 pt-6 pb-2 flex justify-center">
        <x-sitebrew::form.button href="{{route('content.blog.index')}}" style="primary" class="!text-lg gap-x-2.5">Alle Posts ansehen @svg('arrow-right')</x-sitebrew::form.button>
    </section>
</div>