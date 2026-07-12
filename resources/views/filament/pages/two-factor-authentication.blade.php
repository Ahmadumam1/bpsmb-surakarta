<x-filament-panels::page>
    @php($enabled = (bool) (Filament\Facades\Filament::auth()->user()?->google2fa_enabled))

    <div style="display: grid; gap: 1.5rem;">
        <x-filament::section>
            <x-slot name="heading">
                Status
            </x-slot>

            <div class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                @if ($enabled)
                    <p class="font-medium text-success-600 dark:text-success-400">
                        Two-Factor Authentication aktif.
                    </p>
                    <p>Setelah login, admin wajib memasukkan kode 6 digit dari Google Authenticator.</p>
                @else
                    <p class="font-medium text-warning-600 dark:text-warning-400">
                        Two-Factor Authentication belum aktif.
                    </p>
                    <p>Scan QR Code menggunakan Google Authenticator, lalu masukkan kode 6 digit untuk mengaktifkan.</p>
                @endif
            </div>
        </x-filament::section>

        @if (! $enabled)
            <x-filament::section>
                <x-slot name="heading">
                    Setup Google Authenticator
                </x-slot>

                <div class="grid gap-6 lg:grid-cols-[260px_1fr]">
                    <div>
                        <div class="rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-700">
                            {!! $qrCodeSvg !!}
                        </div>
                    </div>

                    <div class="grid gap-5">
                        <div>
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-200">Secret key</p>
                            <code class="mt-1 block overflow-x-auto rounded-lg bg-gray-100 px-3 py-2 text-sm dark:bg-gray-800">
                                {{ $secret }}
                            </code>
                        </div>

                        <form wire:submit="enable" class="fi-sc-form space-y-6">
                            {{ $this->form }}

                            <div class="flex flex-wrap gap-3">
                                <x-filament::button type="submit">
                                    Aktifkan 2FA
                                </x-filament::button>

                                <x-filament::button type="button" color="gray" wire:click="regenerate">
                                    Buat QR Baru
                                </x-filament::button>
                            </div>
                        </form>
                    </div>
                </div>
            </x-filament::section>
        @else
            <x-filament::section>
                <x-slot name="heading">
                    Nonaktifkan 2FA
                </x-slot>

                <form wire:submit="disable" class="fi-sc-form max-w-xl space-y-6">
                    {{ $this->form }}

                    <x-filament::button type="submit" color="danger">
                        Nonaktifkan 2FA
                    </x-filament::button>
                </form>
            </x-filament::section>
        @endif
    </div>
</x-filament-panels::page>
