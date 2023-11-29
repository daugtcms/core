<x-sitebrew::template-renderer :usage="\Sitebrew\Enums\Blocks\TemplateUsage::BLOG_OVERVIEW->value">
    @foreach($posts as $post)
        <x-sitebrew::template-renderer :usage="\Sitebrew\Enums\Blocks\TemplateUsage::BLOG_POST_CARD->value" :attributes="['content' => $post]" :within-template="true"></x-sitebrew::template-renderer>
    @endforeach
</x-sitebrew::template-renderer>