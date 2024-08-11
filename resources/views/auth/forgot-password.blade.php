<x-daugt::template-renderer :usage="\Daugt\Enums\Blocks\TemplateUsage::AUTH->value">
    <h2 class="text-2xl text-neutral-700 font-semibold">{{__('daugt::auth.forgot_password')}}</h2>

    <x-daugt::form.label class="mb-2 text-sm text-neutral-500">
        {{ __('daugt::auth.forgot_password.text') }}
    </x-daugt::form.label>

    <!-- Session Status -->
    <x-daugt::auth.auth-session-status class="mb-4" :status="session('status')"/>

    <!-- Validation Errors -->
    <x-daugt::auth.auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <x-honeypot />

            <!-- Email Address -->
            <div>
                <x-daugt::form.label for="email" :value="__('daugt::auth.email')" />

                <x-daugt::form.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-daugt::form.button>
                    {{ __('daugt::auth.forgot_password.submit') }}
                </x-daugt::form.button>
            </div>
        </form>
</x-daugt::template-renderer>
