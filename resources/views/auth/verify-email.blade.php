<x-daugt::template-renderer :usage="'auth'">
    <h2 class="text-2xl text-neutral-700 font-semibold">{{__('daugt::auth.verify_email')}}</h2>

    <x-daugt::form.label class="mb-2 text-sm text-neutral-500">{{ __('daugt::auth.verify_email.text') }}
    </x-daugt::form.label>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('daugt::auth.verify_email.link_sent') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('daugt.verification.send') }}">
            @csrf

            <x-honeypot />

            <div>
                <x-daugt::form.button>
                    {{ __('daugt::auth.verify_email.resend') }}
                </x-daugt::form.button>
            </div>
        </form>

        <form method="POST" action="{{ route('daugt.logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                {{ __('daugt::auth.logout') }}
            </button>
        </form>
    </div>
</x-daugt::template-renderer>
