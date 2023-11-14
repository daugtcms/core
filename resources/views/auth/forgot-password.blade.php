<x-sitebrew::template-renderer :usage="\Sitebrew\Enums\Blocks\TemplateUsage::AUTH->value">
    <h2 class="text-2xl text-neutral-700 font-semibold">{{__('sitebrew::auth.forgot_password')}}</h2>

    <x-sitebrew::form.label class="mb-2 text-sm text-neutral-500">
        {{ __('sitebrew::auth.forgot_password.text') }}
    </x-sitebrew::form.label>

    <!-- Session Status -->
    <x-sitebrew::auth.auth-session-status class="mb-4" :status="session('status')"/>

    <!-- Validation Errors -->
    <x-sitebrew::auth.auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-sitebrew::form.label for="email" :value="__('sitebrew::auth.email')" />

                <x-sitebrew::form.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-sitebrew::form.button>
                    {{ __('sitebrew::auth.forgot_password.submit') }}
                </x-sitebrew::form.button>
            </div>
        </form>
</x-sitebrew::template-renderer>
