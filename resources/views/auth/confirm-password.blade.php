<x-daugt::template-renderer :usage="'auth'">
    <h2 class="text-2xl text-neutral-700 font-semibold">{{__('daugt::auth.confirm_password')}}</h2>

    <x-daugt::form.label class="mb-2 text-sm text-neutral-500">
        {{ __('daugt::auth.confirm_password.text') }}
    </x-daugt::form.label>

    <!-- Validation Errors -->
    <x-daugt::auth.auth-validation-errors class="mb-4" :errors="$errors"/>

    <form method="POST" action="{{ route('daugt.password.confirm') }}">
        @csrf

        <x-honeypot />

        <!-- Password -->
        <div>
            <x-daugt::form.label for="password" :value="__('daugt::auth.password')" />

            <x-daugt::form.input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
        </div>

        <div class="flex justify-end mt-4">
            <x-daugt::form.button>
                {{ __('daugt::general.confirm') }}
            </x-daugt::form.button>
        </div>
    </form>
</x-daugt::template-renderer>