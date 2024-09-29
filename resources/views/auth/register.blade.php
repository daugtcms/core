<x-daugt::template-renderer :usage="\Daugt\Enums\Blocks\TemplateUsage::AUTH->value">
        <h2 class="text-2xl text-neutral-700 font-semibold">{{__('daugt::auth.register')}}</h2>
        <x-daugt::form.label class="mb-2 text-sm text-neutral-500">{{__('daugt::auth.already_registered')}} <a
                href="{{route('daugt.login') }}"
                class="underline text-primary-500 hover:text-primary-600">{{__('daugt::auth.login_now')}}</a>
        </x-daugt::form.label>
        <!-- Validation Errors -->
        <x-daugt::auth.auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="{{ route('daugt.register') }}">
            @csrf

            <x-honeypot />

            <!-- Name -->
            <div>
                <x-daugt::form.label for="name" :value="__('daugt::auth.username')"/>

                <x-daugt::form.input id="name" class="block mt-1 w-full" type="text" name="name"
                                         :value="old('name')" required
                                         autofocus/>
            </div>

            <div class="mt-4">
                <x-daugt::form.label for="full_name" :value="__('daugt::auth.full_name')"/>

                <x-daugt::form.input id="full_name" class="block mt-1 w-full" type="text" name="full_name"
                                         :value="old('full_name')" required/>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-daugt::form.label for="email" :value="__('daugt::auth.email')"/>

                <x-daugt::form.input id="email" class="block mt-1 w-full" type="email" name="email"
                                         :value="old('email')" required/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-daugt::form.label for="password" :value="__('daugt::auth.password')"/>

                <x-daugt::form.input id="password" class="block mt-1 w-full"
                                         type="password"
                                         name="password"
                                         required autocomplete="new-password"/>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-daugt::form.label for="password_confirmation" :value="__('daugt::auth.confirm_password')"/>

                <x-daugt::form.input id="password_confirmation" class="block mt-1 w-full"
                                         type="password"
                                         name="password_confirmation" required/>
            </div>

            <div class="block mt-4 prose">
                <x-daugt::form.checkbox name="agb" required>
                    {!! __('daugt::auth.accept_terms', ['url' => url('/agb')]) !!}<span class="text-red-500">*</span>
                </x-daugt::form.checkbox>
            </div>

            <div class="block mt-4 prose">
                <x-daugt::form.checkbox name="datenschutz" required>
                    {!! __('daugt::auth.accept_privacy', ['url' => url('/datenschutz')]) !!}<span class="text-red-500">*</span>
                </x-daugt::form.checkbox>
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-daugt::form.button class="ml-4">
                    {{ __('daugt::auth.register') }}
                </x-daugt::form.button>
            </div>
        </form>
</x-daugt::template-renderer>
