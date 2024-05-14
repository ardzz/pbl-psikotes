<x-filament-panels::page>
    @if($this->currentSchema == 'quiz')
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
        <script>
            let deadline_date = new Date('{{ $this->deadline }}').getTime();
            let x = setInterval(function() {
                let now = new Date().getTime();
                let t = deadline_date - now;
                let hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                let minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((t % (1000 * 60)) / 1000);
                document.getElementById("countdown").innerHTML = hours + ":" + minutes + ":" + seconds;
                if (t < 0) {
                    clearInterval(x);
                    $('#countdown_desc').replaceWith('<h3 class="text-danger">Waktu Habis</h3>');
                    $('#countdown').remove();
                }
            }, 1000);
        </script>

    @else
        {{ $this->form }}
    @endif
</x-filament-panels::page>
