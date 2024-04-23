@extends('layouts.dashboard')

@section('css')
    <link rel="stylesheet" href="../../dist/libs/vanilla-datatables-editable/datatable.editable.min.css">
    <style>
        .dataTables_paginate {
            justify-content: center !important;
        }
    </style>
@endsection

@section('container-fluid')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Daftar Soal Ujian Psikotest</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted" href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Psikotest</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="/dist/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="col-12">
            <div class="card w-100 position-relative overflow-hidden mb-0">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold">Detail Psikotest</h5>
                    <p class="card-subtitle mb-4">Detail dari psikotest yang sedang Anda kerjakan.</p>
                    <form>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Waktu Diajukan</label>
                                    <input type="text" class="form-control" id="exampleInputtext" name="full_name" value="{{ \Carbon\Carbon::parse($exam->created_at)->format('d F Y H:i') }}" disabled>
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Waktu Pengerjaan</label>
                                    <input type="text" class="form-control" id="exampleInputtext" name="full_name" value="{{ \Carbon\Carbon::parse($exam->start_time)->format('d F Y H:i') }}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Deskripsi Psikotest</label>
                                    <input type="tex" class="form-control" id="exampleInputtext" name="full_name" value="{{ $exam->purpose }}" disabled>
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Waktu Selesai</label>
                                    <input type="text" class="form-control" id="exampleInputtext" name="full_name" value="{{ $exam->end_time ? \Carbon\Carbon::parse($exam->end_time)->format('d F Y H:i') : \Carbon\Carbon::parse($exam->start_time)->addMinutes(90)->format('d F Y H:i') }}" disabled>
                                </div>
                            </div>
                        </div>
                    </form>
                   @if(!$exam->isExpired())
                        @if($null_answered->count() >= 30)
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading mb-3">ANDA TERLALU BANYAK MENJAWAB JAWABAN <strong>TIDAK MENJAWAB</strong></h4>
                                <p class="mb-1">Mohon untuk menjawab semua pertanyaan yang ada.</p>
                                <p class="mb-1">Jika Anda tidak menjawab pertanyaan, maka ujian psikotes tidak dapat diinterpretasikan.</p>
                                <p class="mb-1">Jika tidak diinterpretasikan, maka hasil ujian psikotes dianggap <strong>tidak valid</strong>.</p>
                            </div>
                        @endif

                        @if($unanswered->count() >= 30)
                            <div class="alert alert-warning" role="alert">
                                <h4 class="alert-heading mb-3">ANDA BELUM MENJAWAB SEMUA PERTANYAAN</h4>
                                <p class="mb-1">Mohon untuk menjawab semua pertanyaan yang ada.</p>
                                <p class="mb-1">Jika Anda tidak menjawab pertanyaan, maka ujian psikotes tidak dapat diinterpretasikan.</p>
                                <p class="mb-1">Terima kasih.</p>
                            </div>
                        @endif
                            <div class="col mb-2">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-small btn-danger me-2">
                                        <i class="uil uil-edit me-1"></i>
                                        Selesaikan Ujian
                                    </button>
                                    <button class="btn btn-small btn-primary" onclick="window.location.href='{{ route('mmpi2') }}'">
                                        Kembali ke Halaman Soal
                                    </button>
                                </div>
                            </div>
                    @else
                        @if($null_answered->count() >= 30 || $unanswered->count() >= 30)
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading mb-3">UJIAN PSIKOTES TIDAK VALID</h4>
                                <p class="mb-1">Hasil ujian psikotes dianggap <strong>tidak valid</strong>.</p>
                                <p class="mb-2">Karena Anda terlalu banyak menjawab jawaban <strong>tidak menjawab</strong>.</p>
                                <h5 class="mb-1">Keterangan: </h5>
                                <li class="mb-1">Soal yang belum dijawab: {{ $unanswered->count() }}</li>
                                <li class="mb-1">Soal yang dijawab <strong>tidak menjawab</strong>: {{ $null_answered->count() }}</li>
                            </div>
                            <div class="col mb-2">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-small btn-dark me-2" onclick="window.location.href='{{ route('mmpi2.request') }}'">
                                        <i class="uil uil-edit me-1"></i>
                                        Ajukan Ujian Baru
                                    </button>
                                </div>
                            </div>
                        @else
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading mb-3">WAKTU UJIAN TELAH BERAKHIR</h4>
                            <p class="mb-1">Selamat, Anda telah menyelesaikan ujian psikotes.</p>
                            <p class="mb-1">Silahkan tunggu hasil interpretasi dari dokter.</p>
                            <p class="mb-1">Jika proses interpretasi telah selesai, Anda akan mendapatkan notifikasi melalu email.</p>
                            <p class="mb-1">Terima kasih.</p>
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="col-12">
            <div class="card w-100 position-relative overflow-hidden mb-0">
                <div class="card-body p-4">
                    <table class="table table-striped table-bordered" id="editable-datatable">
                        <thead>
                        <th>No</th>
                        <th>Soal</th>
                        <th>Jawaban</th>
                        </thead>
                        <tbody>
                        @foreach ($questions as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->content }}</td>
                                @if($item->answers->first() !== null)
                                    @php
                                    $answer = match ($item->answers->first()->answer) {
                                        1 => '<span class="badge bg-success">YA</span>',
                                        0 => '<span class="badge bg-warning">TIDAK</span>',
                                        default => '<span class="badge bg-danger">TIDAK MENJAWAB</span>',
                                    };
                                    @endphp
                                    <td>{!! $answer !!}</td>
                                @else
                                    <td></td>
                                @endisset
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="../../dist/libs/vanilla-datatables-editable/datatable.editable.min.js"></script>
    <script src="../../dist/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../../dist/js/plugins/mindmup-editabletable.js"></script>
    <script src="../../dist/js/plugins/numeric-input-example.js"></script>
    <script>
        $.fn.DataTable.ext.pager.numbers_length = 3;
        $("#editable-datatable")
            .numericInputExample()
            .find("td:first")
            .focus();
        $(function () {
            $("#editable-datatable").DataTable({
                "info": false
            });
        });
    </script>
@endsection
