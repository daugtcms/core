<x-daugt::template-renderer usage="auth">
    <h2 class="text-2xl text-neutral-700 font-semibold">{{__('daugt::auth.login')}}</h2>
    <x-daugt::form.label class="mb-2 text-sm text-neutral-500">{{__('daugt::auth.no_account')}} <a
                href="{{route('daugt.register') }}"
                class="underline text-primary-500 hover:text-primary-600">{{__('daugt::auth.register_now')}}</a>
    </x-daugt::form.label>
    <!-- Session Status -->
    <x-daugt::auth.auth-session-status class="mb-4" :status="session('status')"/>

    <!-- Validation Errors -->
    <x-daugt::auth.auth-validation-errors class="mb-4" :errors="$errors"/>

    <form method="POST" action="{{ route('daugt.login') }}">
        @csrf

        <x-honeypot />

        <!-- Email Address -->
        <div>
            <x-daugt::form.label for="email" :value="__('daugt::auth.email')"/>

            <x-daugt::form.input id="email" class="block w-full mt-1" type="email" name="email"
                                    :value="old('email')" required
                                    autofocus/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-daugt::form.label for="password" :value="__('daugt::auth.password')"/>

            <x-daugt::form.input id="password" class="block w-full mt-1" type="password" name="password"
                                    required
                                    autocomplete="current-password"/>
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <x-daugt::form.checkbox name="remember">{{ __('daugt::auth.remember_me') }}</x-daugt::form.checkbox>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('daugt.password.request'))
                <a class="text-sm text-gray-600 underline hover:text-gray-900"
                   href="{{ route('daugt.password.request') }}">
                    {{ __('daugt::auth.forgot_password') }}
                </a>
            @endif

            <x-daugt::form.button class="ml-3">
                {{ __('daugt::auth.login') }}
            </x-daugt::form.button>
        </div>
    </form>
</x-daugt::template-renderer>