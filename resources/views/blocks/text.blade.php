<div
@class([
    'prose mx-auto break-words hyphens-auto min-h-[4rem]',
    '!container' => $fullWidth,
])>
{!!
 /*(new Tiptap\Editor)
    ->setContent([
        'type' => 'doc',
        'content' => [
            $text
        ],
    ])
    ->getHTML();*/
    $text
!!}
</div>