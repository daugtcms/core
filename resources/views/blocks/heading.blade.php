<div
    @class([
        'container w-full flex flex-col',
        'items-start text-left' => $alignment == 'left',
        'items-center text-center' => $alignment == 'center',
        'items-end text-right' => $alignment == 'right',
])>
    <h2
        @class([
        'text-2xl font-semibold',
        'text-primary-600' => $color == 'primary',
        'text-secondary-600' => $color == 'secondary',
        'text-neutral-800' => $color == 'neutral',
        ])>{{$title ?: 'Lorem ipsum dolor sit amet.'}}</h2>
    <h3 class="text-neutral-700 pb-2 pt-1">{{$subtitle}}</h3>
</div>