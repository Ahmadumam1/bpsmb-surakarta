<x-filament-panels::page>
    <form wire:submit="save" class="fi-sc-form space-y-6">
        {{ $this->form }}

        <x-filament::button type="submit">
            Simpan Password
        </x-filament::button>
    </form>
</x-filament-panels::page>
