@extends('layouts.dashboard')

@section('container-fluid')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Exam Approval</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted" href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Exam Approval</li>
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
                <div class="card-body">
                    <div class="form-group mb-4">
                        <label class="form-label fw-semibold">Nama Pasien</label>
                        <input class="form-control" type="text" id="name" value="{{ $exam->user->name }}" disabled>
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label fw-semibold">Alamat Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $exam->user->email }}" disabled>
                    </div>
                    <div class="form-group mb-4">
                            <label class="form-label fw-semibold">Keterangan/Tujuan Psikotes</label>
                            <input type="text" name="purpose" class="form-control" value="{{ $exam->purpose }}" disabled>
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label fw-semibold">Nama Dokter</label>
                        <select name="doctor_id" class="form-control">
                            <option value="">Pilih Dokter</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-start mt-4 gap-3">
                            <a class="btn btn-success btn-block btn-flat" onclick="add_exam();">Approve</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function add_exam(){
            let url = "{{ route('approve_exam') }}";

            $.post(url, {
                exam_id: "{{ $exam->id }}",
                doctor_id: $("select[name='doctor_id']").val()
            })
                .done(function(response) {
                    swal.fire(
                        'Berhasil!',
                        'Data berhasil disimpan',
                        'success'
                    ).then((result) => {
                        window.location.href = "{{ route('exam.manage') }}";
                    });
                })
                .fail(function(error) {
                    swal.fire(
                        'Gagal!',
                        'Data gagal disimpan: ' + error.responseJSON.message,
                        'error'
                    );
                });

        }
    </script>
@endsection
