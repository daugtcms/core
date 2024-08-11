<x-daugt::template-renderer :usage="\Daugt\Enums\Blocks\TemplateUsage::AUTH->value">
    <h2 class="text-2xl text-neutral-700 font-semibold mb-2">{{__('daugt::auth.reset_password')}}</h2>


    <!-- Validation Errors -->
    <x-daugt::auth.auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <x-honeypot />

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-daugt::form.label for="email" :value="__('daugt::auth.email')" />

                <x-daugt::form.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-daugt::form.label for="password" :value="__('daugt::auth.password')" />

                <x-daugt::form.input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-daugt::form.label for="password_confirmation" :value="__('daugt::auth.confirm_password')" />

                <x-daugt::form.input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-daugt::form.button>
                    {{ __('daugt::auth.reset_password') }}
                </x-daugt::form.button>
            </div>
        </form>
</x-daugt::template-renderer>