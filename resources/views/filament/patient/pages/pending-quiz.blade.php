@php use App\Models\Exam; @endphp
@php
    /* @var Exam $exam */
@endphp
<div class="flex p-4 mb-4 text-sm text-yellow-900 border border-yellow-300 rounded-lg bg-yellow-100 dark:bg-gray-800 dark:border-yellow-800 dark:text-yellow-400 "
     role="alert">
    <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
         fill="currentColor" viewBox="0 0 20 20">
        <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <span class="sr-only">Danger</span>
    <div>
        <span class="font-medium">Pengajuan Psikotes Anda sedang dalam proses verifikasi.</span>
        <span class="block">Mohon tunggu hingga proses verifikasi selesai, Anda akan mendapatkan notifikasi jika pengajuan Anda diterima, terima kasih.</span>
        <!-- Exam Information -->
        <div class="mt-4">
            <div class="flex items-center justify-between">
                <div class="flex items">
                    <div class="flex flex-col">
                        <span class="text-sm font-medium">Keterangan Psikotes</span>
                        <span class="text-sm">{{ $exam->purpose }}</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between mt-2">
                <div class="flex items">
                    <div class="flex flex-col">
                        <span class="text-m font-medium">Status Pembayaran</span>
                        @if($exam->payment->method == 'online')
                            @switch($exam->payment->status)
                                @case('pending') <span class="text-yellow-500">Menunggu Pembayaran</span> @break
                                @case('paid') <span class="text-green-500">Pembayaran Berhasil</span> @break
                                @case('failed') <span class="text-red-500">Pembayaran Gagal</span> @break
                                @case('expired') <span class="text-red-500">Pembayaran Kadaluarsa</span> @break
                            @endswitch
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
