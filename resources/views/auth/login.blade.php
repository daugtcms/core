<x-site-core::layouts.app>
    <x-site-core::auth.auth-card>
        <x-slot name="logo">
            <div class="flex flex-col items-center">
                <a href="/">
                    <div class="h-20 w-20 bg-primary-500 rounded-lg py-2 px-1 shadow">
                        <x-site-core::core.application-logo
                                class="block w-full h-full drop-shadow-md text-white fill-current "/>
                    </div>
                </a>
                <x-site-core::form.label class="mt-4 -mb-5">Noch keinen Account? <a href="{{route('register') }}"
                                                                                    class="underline text-primary-500 hover:text-primary-600">Jetzt
                        registrieren.</a></x-site-core::form.label>
            </div>
        </x-slot>

        <!-- Session Status -->
        <x-site-core::auth.auth-session-status class="mb-4" :status="session('status')"/>

        <!-- Validation Errors -->
        <x-site-core::auth.auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-site-core::form.label for="email" :value="__('Email')"/>

                <x-site-core::form.input id="email" class="block w-full mt-1" type="email" name="email"
                                         :value="old('email')" required
                                         autofocus/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-site-core::form.label for="password" :value="__('Password')"/>

                <x-site-core::form.input id="password" class="block w-full mt-1" type="password" name="password"
                                         required
                                         autocomplete="current-password"/>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <x-site-core::form.checkbox name="remember_me">{{ __('Remember me') }}</x-site-core::form.checkbox>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 underline hover:text-gray-900"
                       href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-site-core::form.button class="ml-3">
                    {{ __('Log in') }}
                </x-site-core::form.button>
            </div>
        </form>
    </x-site-core::auth.auth-card>
</x-site-core::layouts.app>
