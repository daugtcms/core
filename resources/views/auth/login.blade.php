<x-sitebrew::template-renderer :usage="\Sitebrew\Enums\Blocks\TemplateUsage::AUTH->value">
    <h2 class="text-2xl text-neutral-700 font-semibold">{{__('sitebrew::auth.login')}}</h2>
    <x-sitebrew::form.label class="mb-2 text-sm text-neutral-500">{{__('sitebrew::auth.no_account')}} <a
                href="{{route('register') }}"
                class="underline text-primary-500 hover:text-primary-600">{{__('sitebrew::auth.register_now')}}</a>
    </x-sitebrew::form.label>
    <!-- Session Status -->
    <x-sitebrew::auth.auth-session-status class="mb-4" :status="session('status')"/>

    <!-- Validation Errors -->
    <x-sitebrew::auth.auth-validation-errors class="mb-4" :errors="$errors"/>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-sitebrew::form.label for="email" :value="__('sitebrew::auth.email')"/>

            <x-sitebrew::form.input id="email" class="block w-full mt-1" type="email" name="email"
                                    :value="old('email')" required
                                    autofocus/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-sitebrew::form.label for="password" :value="__('sitebrew::auth.password')"/>

            <x-sitebrew::form.input id="password" class="block w-full mt-1" type="password" name="password"
                                    required
                                    autocomplete="current-password"/>
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <x-sitebrew::form.checkbox name="remember_me">{{ __('sitebrew::auth.remember_me') }}</x-sitebrew::form.checkbox>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 underline hover:text-gray-900"
                   href="{{ route('password.request') }}">
                    {{ __('sitebrew::auth.forgot_password') }}
                </a>
            @endif

            <x-sitebrew::form.button class="ml-3">
                {{ __('sitebrew::auth.login') }}
            </x-sitebrew::form.button>
        </div>
    </form>
</x-sitebrew::template-renderer>