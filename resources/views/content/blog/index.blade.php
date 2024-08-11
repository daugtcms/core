<x-daugt::template-renderer :usage="\Daugt\Enums\Blocks\TemplateUsage::BLOG_OVERVIEW->value">
    @foreach($posts as $post)
        <x-daugt::template-renderer :usage="\Daugt\Enums\Blocks\TemplateUsage::BLOG_POST_CARD->value"
                                       :attributes="['content' => $post]"
                                       :within-template="true"></x-daugt::template-renderer>
    @endforeach
</x-daugt::template-renderer>