<x-sitebrew::layouts.app>
    <x-sitebrew::auth.auth-card>
        <x-slot name="logo">
            <div class="flex flex-col items-center">
                <a href="/">
                    <div class="h-20 w-20 bg-primary-500 rounded-lg py-2 px-1 shadow">
                        <x-sitebrew::core.application-logo
                                class="block w-full h-full drop-shadow-md text-white fill-current "/>
                    </div>
                </a>
                <x-sitebrew::form.label class="mt-4 -mb-5">Noch keinen Account? <a href="{{route('register') }}"
                                                                                    class="underline text-primary-500 hover:text-primary-600">Jetzt
                        registrieren.</a></x-sitebrew::form.label>
            </div>
        </x-slot>

        <!-- Session Status -->
        <x-sitebrew::auth.auth-session-status class="mb-4" :status="session('status')"/>

        <!-- Validation Errors -->
        <x-sitebrew::auth.auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-sitebrew::form.label for="email" :value="__('Email')"/>

                <x-sitebrew::form.input id="email" class="block w-full mt-1" type="email" name="email"
                                         :value="old('email')" required
                                         autofocus/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-sitebrew::form.label for="password" :value="__('Password')"/>

                <x-sitebrew::form.input id="password" class="block w-full mt-1" type="password" name="password"
                                         required
                                         autocomplete="current-password"/>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <x-sitebrew::form.checkbox name="remember_me">{{ __('Remember me') }}</x-sitebrew::form.checkbox>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 underline hover:text-gray-900"
                       href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-sitebrew::core.button class="ml-3">
                    {{ __('Log in') }}
                </x-sitebrew::core.button>
            </div>
        </form>
    </x-sitebrew::auth.auth-card>
</x-sitebrew::layouts.app>
