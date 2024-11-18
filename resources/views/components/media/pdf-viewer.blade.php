@props(['src'])
<div class="w-full h-full flex items-center justify-center relative"
     x-data="setupPdfViewer('{{ $src }}')"
>
    <canvas class="max-h-full max-w-full"></canvas>
    <div class="absolute mx-auto bottom-3 gap-x-1.5 inline-flex">
        <x-daugt::form.icon-button icon="lucide-chevron-left" @click="previousPage()" style="dark"></x-daugt::form.icon-button>
        <x-daugt::form.icon-button icon="lucide-chevron-right" @click="nextPage()" style="dark"></x-daugt::form.icon-button>
    </div>
</div>