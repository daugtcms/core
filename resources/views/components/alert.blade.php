@props(['title', 'message', 'icon' => 'shield-alert', 'actions' => []])

<div class="rounded-md bg-warning-50 p-4">
    <div class="flex">
        <div class="flex-shrink-0">
            <div class="i-{{$icon}} text-warning-400">
        </div>
        <div class="ml-3">
            <h3 class="text-sm font-medium text-warning-800">{{$title}}</h3>
            <div class="mt-2 text-sm text-warning-700">
                <p>{{$message}}</p>
            </div>
            <div class="mt-2">
                <div class="-mx-2 flex">
                    {{$actions}}
                </div>
            </div>
        </div>
    </div>
</div>
