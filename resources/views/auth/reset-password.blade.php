<x-sitebrew::template-renderer :usage="\Sitebrew\Enums\Blocks\TemplateUsage::AUTH->value">
    <h2 class="text-2xl text-neutral-700 font-semibold mb-2">{{__('sitebrew::auth.reset_password')}}</h2>


    <!-- Validation Errors -->
    <x-sitebrew::auth.auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <x-honeypot />

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-sitebrew::form.label for="email" :value="__('sitebrew::auth.email')" />

                <x-sitebrew::form.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-sitebrew::form.label for="password" :value="__('sitebrew::auth.password')" />

                <x-sitebrew::form.input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-sitebrew::form.label for="password_confirmation" :value="__('sitebrew::auth.confirm_password')" />

                <x-sitebrew::form.input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-sitebrew::form.button>
                    {{ __('sitebrew::auth.reset_password') }}
                </x-sitebrew::form.button>
            </div>
        </form>
</x-sitebrew::template-renderer>