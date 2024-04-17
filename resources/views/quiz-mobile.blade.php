@extends('layouts.dashboard')

@section('container-fluid')
    <div class="card">
        <div class="col-12">
            <div class="card w-100 position-relative overflow-hidden mb-0">
                <div class="card-body p-4">
                    <div class="border-bottom">
                        <div class="row">
                            <div class="col-12 col-sm-auto mb-2">
                                <ol class="breadcrumb font-size-16 mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="#" class="router-link-active">
                                            <strong class="router-link-active">
                                                <i class="uil uil-home-alt"></i>
                                                EXAM
                                            </strong>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">{{ env('APP_NAME') }}</li>
                                </ol>
                                <p class="text-muted text-truncate mb-2">
                                    <span>No soal</span>
                                    <span class="text-success">5</span>
                                    <span>Dari</span>
                                    <span class="text-success">568</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="row">
                            <div class="col mb-2 mt-4">
                                <div class="d-flex justify-content-center">
                                    <h2>00:00:00</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-bottom mb-0">
                        <div class="row">
                            <div class="col mb-3 mt-1">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-sm btn-warning me-2">
                                        <i class="uil uil-edit me-1"></i>
                                        Selesaikan Ujian
                                    </button>
                                    <button class="btn btn-sm btn-success">
                                        <i class="uil uil-trash-alt me-1"></i>
                                        Daftar Soal
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content of question full -->
                <div class="card-body p-4 mt-0">
                    <div class="row">
                        <div class="col-12 mt-0">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="mb-2">Soal no 5</h5>
                                    <p class="text-muted mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi.</p>
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
        </div>
    </div>
@endsection