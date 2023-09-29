<x-site-core::layouts.app>
    <x-site-core::auth.auth-card>
        <x-slot name="logo">
            <a href="/">
                <div class="h-20 w-20 bg-primary-500 rounded-lg py-2 px-1 shadow">
                    <x-site-core::core.application-logo
                            class="block w-full h-full drop-shadow-md text-white fill-current "/>
                </div>
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-site-core::auth.auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-site-core::form.label for="name" :value="__('Benutzername')"/>

                <x-site-core::form.input id="name" class="block mt-1 w-full" type="text" name="name"
                                         :value="old('name')" required
                                         autofocus/>
            </div>

            <div class="mt-4">
                <x-site-core::form.label for="full_name" :value="__('Vor- und Nachname (Rechnungen, ...)')"/>

                <x-site-core::form.input id="full_name" class="block mt-1 w-full" type="text" name="full_name"
                                         :value="old('full_name')" required/>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-site-core::form.label for="email" :value="__('Email')"/>

                <x-site-core::form.input id="email" class="block mt-1 w-full" type="email" name="email"
                                         :value="old('email')" required/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-site-core::form.label for="password" :value="__('Password')"/>

                <x-site-core::form.input id="password" class="block mt-1 w-full"
                                         type="password"
                                         name="password"
                                         required autocomplete="new-password"/>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-site-core::form.label for="password_confirmation" :value="__('Confirm Password')"/>

                <x-site-core::form.input id="password_confirmation" class="block mt-1 w-full"
                                         type="password"
                                         name="password_confirmation" required/>
            </div>

            <div class="block mt-4 prose">
                <x-site-core::form.checkbox name="agb" required>
                    Ich habe die <a href="{{url('/agb')}}">AGB</a> gelesen und verstanden und bin damit
                    einverstanden.<span class="text-red-500">*</span>
                </x-site-core::form.checkbox>
            </div>

            <div class="block mt-4 prose">
                <x-site-core::form.checkbox name="datenschutz" required>
                    Ich habe die <a href="{{url('/datenschutz')}}">Datenschutzerklärung</a> gelesen und verstanden und
                    bin damit einverstanden.<span class="text-red-500">*</span>
                </x-site-core::form.checkbox>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-site-core::core.button class="ml-4">
                    {{ __('Register') }}
                </x-site-core::core.button>
            </div>
        </form>
    </x-site-core::auth.auth-card>
</x-site-core::layouts.app>
