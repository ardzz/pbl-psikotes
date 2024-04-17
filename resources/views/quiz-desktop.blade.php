@extends('layouts.dashboard')

@section('container-fluid')
    <div class="card">
        <div class="col-12">
            <div class="card w-100 position-relative overflow-hidden mb-0">
                <div class="card-body p-4">
                    <div>
                        <div class="row">
                            <div class="col-12 col-sm-auto mb-2">
                                <ol class="breadcrumb font-size-16 mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="#" class="router-link-active">
                                            <strong class="router-link-active">
                                                <i class="uil uil-home-alt"></i>
                                                PSIKOTES MMPI-2
                                            </strong>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">{{ env('APP_NAME') }}</li>
                                </ol>
                                <p class="text-muted text-truncate mb-0">
                                    <span>Deadline</span>
                                    <strong class="text-dark">{{ \Carbon\Carbon::parse($deadline)->format('d F Y H:i A') }}</strong>
                                </p>
                            </div>
                            <div class="col mb-2">
                                <div class="d-flex justify-content-center">
                                    <h4 class="text-center mb-0" id="countdown_desc">Waktu Tersisa</h4>
                                    <h4 class="text-center mb-0 ms-2" id="countdown">00:00:00</h4>
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-small btn-danger me-2">
                                        <i class="uil uil-edit me-1"></i>
                                        Selesaikan Ujian
                                    </button>
                                    <button class="btn btn-small btn-success">
                                        <i class="uil uil-trash-alt me-1"></i>
                                        Daftar Soal
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-4">
            <div class="border-bottom">
                <div class="row">
                    <div class="col-12 col-sm-auto mb-2">
                        <div class="d-flex justify-content-center">
                            <h3 class="text-truncate mb-2 btn btn-lg btn-light">
                                <span>No</span>
                                <strong class="text-dark">5</strong>
                                <span>dari</span>
                                <strong class="text-dark">568</strong>
                                <span>soal</span>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-4 mt-0">
            <div class="row">
                <div class="col-12 mt-0">
                    <div class="d-flex justify-content-center mb-4">
                        <div>
                            <h3 class="text mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi.</h3>
                        </div>
                    </div>
                    <!-- answer option using button (3 options) and centering -->
                    <!-- make button each line vertically -->
                    <div class="mt-2 d-flex justify-content-center">
                        <div class="col-md-6">
                            <button class="btn btn-light btn-lg w-100 mb-2">YA</button>
                            <button class="btn btn-light btn-lg w-100 mb-2">TIDAK MENJAWAB</button>
                            <button class="btn btn-light btn-lg w-100 mb-2">TIDAK</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer border-top p-4">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-dark">Kembali</button>
                        <button class="btn btn-dark">Selanjutnya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let deadline_date = new Date('{{ $deadline }}').getTime();
        let x = setInterval(function() {
            let now = new Date().getTime();
            let t = deadline_date - now;
            let hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((t % (1000 * 60)) / 1000);
            document.getElementById("countdown").innerHTML = hours + ":" + minutes + ":" + seconds;
            if (t < 0) {
                clearInterval(x);
                // replace content countdown_desc
                $('#countdown_desc').replaceWith('<h3 class="text-danger">Waktu Habis</h3>');
                $('#countdown').remove();
            }
        }, 1000);
    </script>
@endsection
