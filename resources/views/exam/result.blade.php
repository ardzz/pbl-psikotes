@extends('layouts.dashboard')

@section('css')
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
                    <h4 class="fw-semibold mb-8">Hasil Ujian Psikotest</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted" href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Psikotest</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3">
                <img src="/dist/images/logos/3.png" alt="" width="100" height="70" class="img-fluid mb-1 mt-n3">
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="col-12">
            <div class="card w-100 position-relative overflow-hidden mb-0">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold">Detail Hasil Ujian Psikotest</h5>
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
                                @if(auth()->user()->user_type == 2 || auth()->user()->user_type == 3)
                                    <div class="alert alert-warning" role="alert">
                                        <h4 class="alert-heading mb-3">USER BELUM MENJAWAB SEMUA PERTANYAAN</h4>
                                        <p class="mb-1">Mohon untuk memberitahu user untuk menjawab semua pertanyaan yang ada.</p>
                                        <p class="mb-1">Jika User tidak menjawab pertanyaan, maka ujian psikotes tidak dapat diinterpretasikan.</p>
                                        <p class="mb-1">Terima kasih.</p>
                                    </div>
                                @else
                                    <div class="alert alert-warning" role="alert">
                                        <h4 class="alert-heading mb-3">ANDA BELUM MENJAWAB SEMUA PERTANYAAN</h4>
                                        <p class="mb-1">Mohon untuk menjawab semua pertanyaan yang ada.</p>
                                        <p class="mb-1">Jika Anda tidak menjawab pertanyaan, maka ujian psikotes tidak dapat diinterpretasikan.</p>
                                        <p class="mb-1">Terima kasih.</p>
                                    </div>
                                @endif
                        @endif
                            <div class="col mb-2">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-small btn-danger me-2" onclick="force_finish_exam();">
                                        <i class="uil uil-edit me-1"></i>
                                        Selesaikan Ujian
                                    </button>
                                    @if(auth()->user()->user_type != 2 && auth()->user()->user_type != 3)
                                        <button class="btn btn-small btn-primary" onclick="window.location.href='{{ route('mmpi2') }}'">
                                            Kembali ke Halaman Soal
                                        </button>
                                    @endif
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
                    <h4 class="card-title fw-semibold">Validity and Clinical Scales Profile</h4>
                    <div class="d-flex justify-content-center">
                        <canvas id="canvasVCS" width="1" height="1"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="col-12">
            <div class="card w-100 position-relative overflow-hidden mb-0">
                <div class="card-body p-4">
                    <h4 class="card-title fw-semibold">Restructured Clinical Scales Profile</h4>
                    <div class="d-flex justify-content-center">
                        <canvas id="canvasRCS" width="1" height="1"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="col-12">
            <div class="card w-100 position-relative overflow-hidden mb-0">
                <div class="card-body p-4">
                    <h4 class="card-title fw-semibold">Content Scales Profile</h4>
                    <div class="d-flex justify-content-center">
                        <canvas id="canvasCSP" width="1" height="1"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="col-12">
            <div class="card w-100 position-relative overflow-hidden mb-0">
                <div class="card-body p-4">
                    <h4 class="card-title fw-semibold">Supplementary Scales Profile</h4>
                    <div class="d-flex justify-content-center">
                        <canvas id="canvasSS" width="1" height="1"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="col-12">
            <div class="card w-100 position-relative overflow-hidden mb-0">
                <div class="card-body p-4">
                    <h4 class="card-title fw-semibold">PSY-5 Scales Profile</h4>
                    <div class="d-flex justify-content-center">
                        <canvas id="canvasPSY" width="1" height="1"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="col-12">
            <div class="card w-100 position-relative overflow-hidden mb-0">
                <div class="card-body p-4" id="score_text">
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="col-12">
            <div class="card w-100 position-relative overflow-hidden mb-0">
                <div class="card-body p-4" id="ci_table">
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="col-12">
            <div class="card w-100 position-relative overflow-hidden mb-0">
                <div class="card-body p-4">
                    <h4 class="card-title fw-semibold">Question & Answer</h4>
                    <p class="card-subtitle mb-4">Table of questions and answers.</p>
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
    <script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
    <script src="../../dist/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="../../dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ---------------------------------------------- -->
    <!-- core files -->
    <!-- ---------------------------------------------- -->
    <script src="../../dist/js/app.min.js"></script>
    <script src="../../dist/js/app.init.js"></script>
    <script src="../../dist/js/app-style-switcher.js"></script>
    <script src="../../dist/js/sidebarmenu.js"></script>

    <script src="../../dist/js/custom.js"></script>
    <script src="../../dist/libs/prismjs/prism.js"></script>

    <!-- ---------------------------------------------- -->
    <!-- current page js files -->
    <!-- ---------------------------------------------- -->
    <script src="../../dist/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script src="../../dist/js/datatable/datatable-advanced.init.js"></script>
    <script type="text/javascript" src="/assets/mmpi2/scales.js"></script>
    <script type="text/javascript" src="/assets/mmpi2/questions.js"></script>
    <script type="text/javascript" src="/assets/mmpi2/canvastext.js"></script>
    <script type="text/javascript" src="/assets/mmpi2/chart.js"></script>
    <script type="text/javascript" src="/assets/mmpi2/score.js"></script>
    <script type="text/javascript" src="/assets/mmpi2/utils.js"></script>
    <script>
        longform=true;
        gender= {{ $exam->user->personal_information->gender == 'm' ? 1 : 0 }}
        chart_style=0;
        $.fn.DataTable.ext.pager.numbers_length = 3;
        score_text('{{ \App\MMPI2\Scale::make($exam)->toTF() }}');
        $("#editable-datatable").DataTable({"info": false});


        function force_finish_exam(){
            $.ajax(
                {
                    url: '{{ route('force_finish_exam') }}',
                    type: 'POST',
                    data: {
                        exam_id: '{{ $exam->id }}'
                    },
                    success: function (data) {
                        swal.fire({
                            title: 'Ujian telah selesai',
                            text: 'Ujian telah selesai, silahkan tunggu hasil interpretasi dari dokter.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '{{ route('exam.result', $exam->id) }}';
                            }
                        });
                    },
                    error: function (data) {
                        swal.fire({
                            title: 'Gagal',
                            text: 'Gagal menyelesaikan ujian, : ' + data.responseJSON.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            );
        }
    </script>
@endsection
