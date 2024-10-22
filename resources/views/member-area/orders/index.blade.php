<x-daugt::layouts.member-area-layout>
    @push('title')
        Deine Bestellungen
    @endpush
    <div class="container">
        <livewire:daugt::shop.order-list :user="Auth::id()"></livewire:daugt::shop.order-list>
    </div>
</x-daugt::layouts.member-area-layout>