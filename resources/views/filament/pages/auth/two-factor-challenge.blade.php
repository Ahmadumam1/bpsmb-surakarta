<x-filament-panels::layout.simple :has-topbar="false" max-content-width="sm">
    <style>
        .fi-simple-layout {
            min-height: 100vh;
            background:
                linear-gradient(135deg, rgba(5, 46, 38, 0.92), rgba(15, 23, 42, 0.72)),
                url("{{ asset('assets/bg.jpg') }}");
            background-position: center;
            background-size: cover;
        }

        .fi-simple-main {
            position: relative;
            z-index: 1;
        }
    </style>

    <div class="fi-simple-page">
        <div class="fi-simple-page-content">
            <x-filament-panels::header.simple
                heading="Verifikasi"
                logo
                subheading="Masukkan kode 6 digit dari Google Authenticator"
            />

            <form method="POST" action="{{ route('admin.two-factor.challenge.store') }}" class="fi-sc-form space-y-6">
                @csrf

                <div>
                    <label for="code" class="fi-fo-field-wrp-label mb-1.5 block text-sm font-medium">
                        Kode autentikator
                    </label>

                    <x-filament::input.wrapper :valid="! $errors->has('code')">
                        <x-filament::input
                            id="code"
                            name="code"
                            type="text"
                            inputmode="numeric"
                            pattern="[0-9]*"
                            maxlength="6"
                            autocomplete="one-time-code"
                            autofocus
                            :value="old('code')"
                            class="text-center text-lg font-semibold tracking-[0.35em]"
                        />
                    </x-filament::input.wrapper>

                    @error('code')
                        <p class="mt-2 text-sm font-medium text-danger-600 dark:text-danger-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <x-filament::button type="submit" class="w-full">
                    Verifikasi
                </x-filament::button>
            </form>

            <form method="POST" action="{{ route('admin.two-factor.challenge.logout') }}">
                @csrf

                <x-filament::button type="submit" color="gray" class="w-full">
                    Keluar
                </x-filament::button>
            </form>
        </div>
    </div>
</x-filament-panels::layout.simple>
