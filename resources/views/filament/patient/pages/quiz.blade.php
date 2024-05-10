<x-filament-panels::page>
    <x-filament::section>
        <x-slot name="heading">
            MMPI-2 Psychological Test {{ env('APP_NAME') }}
        </x-slot>
        <x-slot name="description">
            Tes ini terdiri dari 567 pertanyaan yang harus dijawab dalam waktu 90 menit.
            <h2>
                <span>Waktu Tersisa</span>
                <strong class="text-dark" id="countdown">00:00</strong>
            </h2>
        </x-slot>
        {{ $this->form }}
    </x-filament::section>
</x-filament-panels::page>
