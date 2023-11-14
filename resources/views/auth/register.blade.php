<x-sitebrew::template-renderer :usage="\Sitebrew\Enums\Blocks\TemplateUsage::AUTH->value">
        <h2 class="text-2xl text-neutral-700 font-semibold">{{__('sitebrew::auth.register')}}</h2>
        <x-sitebrew::form.label class="mb-2 text-sm text-neutral-500">{{__('sitebrew::auth.already_registered')}} <a
                href="{{route('login') }}"
                class="underline text-primary-500 hover:text-primary-600">{{__('sitebrew::auth.login_now')}}</a>
        </x-sitebrew::form.label>
        <!-- Validation Errors -->
        <x-sitebrew::auth.auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-sitebrew::form.label for="name" :value="__('sitebrew::auth.username')"/>

                <x-sitebrew::form.input id="name" class="block mt-1 w-full" type="text" name="name"
                                         :value="old('name')" required
                                         autofocus/>
            </div>

            <div class="mt-4">
                <x-sitebrew::form.label for="full_name" :value="__('sitebrew::auth.full_name')"/>

                <x-sitebrew::form.input id="full_name" class="block mt-1 w-full" type="text" name="full_name"
                                         :value="old('full_name')" required/>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-sitebrew::form.label for="email" :value="__('sitebrew::auth.email')"/>

                <x-sitebrew::form.input id="email" class="block mt-1 w-full" type="email" name="email"
                                         :value="old('email')" required/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-sitebrew::form.label for="password" :value="__('sitebrew::auth.password')"/>

                <x-sitebrew::form.input id="password" class="block mt-1 w-full"
                                         type="password"
                                         name="password"
                                         required autocomplete="new-password"/>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-sitebrew::form.label for="password_confirmation" :value="__('sitebrew::auth.confirm_password')"/>

                <x-sitebrew::form.input id="password_confirmation" class="block mt-1 w-full"
                                         type="password"
                                         name="password_confirmation" required/>
            </div>

            <div class="block mt-4 prose">
                <x-sitebrew::form.checkbox name="agb" required>
                    {!! __('sitebrew::auth.accept_terms', ['url' => url('/agb')]) !!}<span class="text-red-500">*</span>
                </x-sitebrew::form.checkbox>
            </div>

            <div class="block mt-4 prose">
                <x-sitebrew::form.checkbox name="datenschutz" required>
                    {!! __('sitebrew::auth.accept_privacy', ['url' => url('/datenschutz')]) !!}<span class="text-red-500">*</span>
                </x-sitebrew::form.checkbox>
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-sitebrew::form.button class="ml-4">
                    {{ __('sitebrew::auth.register') }}
                </x-sitebrew::form.button>
            </div>
        </form>
</x-sitebrew::template-renderer>
