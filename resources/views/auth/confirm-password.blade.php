<x-sitebrew::template-renderer :usage="\Sitebrew\Enums\Blocks\TemplateUsage::AUTH->value">
    <h2 class="text-2xl text-neutral-700 font-semibold">{{__('sitebrew::auth.confirm_password')}}</h2>

    <x-sitebrew::form.label class="mb-2 text-sm text-neutral-500">
        {{ __('sitebrew::auth.confirm_password.text') }}
    </x-sitebrew::form.label>

    <!-- Validation Errors -->
    <x-sitebrew::auth.auth-validation-errors class="mb-4" :errors="$errors"/>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-sitebrew::form.label for="password" :value="__('sitebrew::auth.password')" />

            <x-sitebrew::form.input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
        </div>

        <div class="flex justify-end mt-4">
            <x-sitebrew::form.button>
                {{ __('sitebrew::general.confirm') }}
            </x-sitebrew::form.button>
        </div>
    </form>
</x-sitebrew::template-renderer>