<x-daugt::template-renderer usage="auth">
    <h2 class="text-2xl text-neutral-700 font-semibold">{{__('daugt::auth.login')}}</h2>
    <x-daugt::form.label class="mb-2 text-sm text-neutral-500">{{__('daugt::auth.login_explanation')}}
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

        @if(session()->exists('accept-terms'))
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
        @endif

        <div class="flex items-center justify-end mt-4">
            <x-daugt::form.button style="primary" class="ml-3">
                {{ __('daugt::auth.login') }}
            </x-daugt::form.button>
        </div>
    </form>
</x-daugt::template-renderer>