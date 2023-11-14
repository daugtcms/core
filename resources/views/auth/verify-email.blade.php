<x-sitebrew::template-renderer :usage="\Sitebrew\Enums\Blocks\TemplateUsage::AUTH->value">
    <h2 class="text-2xl text-neutral-700 font-semibold">{{__('sitebrew::verify-email')}}</h2>

    <x-sitebrew::form.label class="mb-2 text-sm text-neutral-500">{{ __('sitebrew::auth.verify_email.text') }}
    </x-sitebrew::form.label>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('sitebrew::auth.verify_email.link_sent') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-sitebrew::form.button>
                    {{ __('sitebrew::auth.verify_email.resend') }}
                </x-sitebrew::form.button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                {{ __('sitebrew::auth.logout') }}
            </button>
        </form>
    </div>
</x-sitebrew::template-renderer>
