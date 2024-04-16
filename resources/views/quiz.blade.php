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
                                                Home
                                            </strong>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">#5</li>
                                </ol>
                                <p class="text-muted text-truncate mb-0">
                                    <span>No soal</span>
                                    <span class="text-success">5</span>
                                    <span>Dari</span>
                                    <span class="text-success">568</span>
                                </p>
                            </div>
                            <div class="col mb-2">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-sm btn-outline-primary me-2">
                                        <i class="uil uil-edit me-1"></i>
                                        Selesaikan Ujian
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="uil uil-trash-alt me-1"></i>
                                        Lihat Daftar Soal
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
