<x-daugt::template-renderer usage="auth">
    <h2 class="text-2xl text-neutral-700 font-semibold">{{__('daugt::auth.login')}}</h2>
    <x-daugt::form.label class="mb-2 text-sm text-neutral-500">{{__('daugt::auth.otp.explanation')}}
    </x-daugt::form.label>
    <!-- Session Status -->
    <x-daugt::auth.auth-session-status class="mb-4" :status="session('status')"/>

    <!-- Validation Errors -->
    <x-daugt::auth.auth-validation-errors class="mb-4" :errors="$errors"/>

    <form method="POST" action="{{ route('daugt.login.otp.verify') }}"
          x-init="init()"
          x-ref="form"
          x-data="{
        length: 6,
        value: '',
        init() {
            $nextTick(() => {
                document.getElementById('0').focus();
            });

            this.$watch('value', (value) => {
                if (value.length === this.length) {
                    this.$refs.form.submit();
                }
            });
        },
        handleInput(e) {
            const input = e.target;

            this.value = Array.from(Array(this.length), (element, i) => {
              return document.getElementById(i).value || '';
            }).join('');

            if (input.nextElementSibling && input.value) {
                input.nextElementSibling.focus();
                input.nextElementSibling.select();
            }
        },
        handlePaste(e) {
            const paste = e.clipboardData.getData('text');
            this.value = paste;

            const inputs = Array.from(Array(this.length));

            inputs.forEach((element, i) => {
                document.getElementById(i).value = paste[i] || '';
            });
        },
        handleBackspace(e) {
            const previous = parseInt(e, 10) - 1;
            document.getElementById(previous) && document.getElementById(previous).focus();
        },
    }">
        @csrf

        <x-honeypot />

        <!-- Password -->
        <div class="my-4">
            <x-daugt::form.label for="password" :value="__('daugt::auth.otp.title')"/>

            <div class="flex justify-between gap-x-1.5">
                <template x-for="(input, index) in length" :key="index">
                    <x-daugt::form.input
                            type="tel"
                            x-init="$el.id = index"
                            maxlength="1"
                            class="sm:w-14! sm:h-14! text-center text-2xl font-semibold"
                            x-on:input="handleInput($event)"
                            x-on:paste="handlePaste($event)"
                            x-on:keydown.backspace="$event.target.value || handleBackspace($event.target.id)"
                    />
                </template>
            </div>
        </div>

        <input type="hidden" name="otp" x-model="value" />
    </form>
</x-daugt::template-renderer>