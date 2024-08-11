<button class="flex items-center group" @click="$refs.panel.toggle">
    @svg('chevron-down', 'w-5 h-5 mr-1.5 text-white')

    <x-daugt::avatar class="w-9 h-9"></x-daugt::avatar>
</button>

<div x-ref="panel" x-cloak class="absolute bg-white rounded-md border-2 font-medium border-neutral-200 text-neutral-800 overflow-hidden divide-y flex flex-col z-30" x-float.placement.bottom-end.offset>
    @if(!request()->routeIs('member-area.*'))
    <a href="{{route('member-area.index')}}" class="px-3 py-2 hover:bg-neutral-100 cursor-pointer block">Mitgliederbereich</a>
    @else
    <a href="{{url('/')}}" class="px-3 py-2 hover:bg-neutral-100 cursor-pointer block">Zur Homepage</a>
    @endif
    <a href="{{route('member-area.orders.index')}}" class="px-3 py-2 hover:bg-neutral-100 cursor-pointer block">Meine Käufe & Abos</a>
    @can('access admin panel')
        <a href="{{route('admin.index')}}" class="px-3 py-2 hover:bg-neutral-100 cursor-pointer block">Admin</a>
    @endcan
    @if(app('impersonate')->isImpersonating())
        <a href="{{ route('impersonate.leave') }}" class="px-3 py-2 text-danger-500 hover:bg-danger-50 cursor-pointer block">{{__('daugt::users.end_impersonation')}}</a>
    @else
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="px-3 py-2 w-full text-danger-500 hover:bg-danger-50 text-left">Abmelden</button>
        </form>
    @endif
</div>