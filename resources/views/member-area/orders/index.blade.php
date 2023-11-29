<x-sitebrew::layouts.member-area-layout>
    <div class="container">
        <h1 class="text-white/80 text-3xl sm:text-5xl font-semibold mt-4 sm:mt-10 mb-4 sm:mb-8 drop-shadow-md">Deine Bestellungen</h1>

        <livewire:sitebrew::shop.order-list :user="Auth::id()"></livewire:sitebrew::shop.order-list>
    </div>
</x-sitebrew::layouts.member-area-layout>