@extends('layouts.dashboard')

@section('container-fluid')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Add Exam</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted" href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Add Exam</li>
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
                        <input class="form-control" type="text" id="name" value="{{ auth()->user()->name }}" disabled>
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label fw-semibold">Alamat Email</label>
                        <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                    </div>
                    <div class="form-group mb-4">
                            <label class="form-label fw-semibold">Keterangan/Tujuan Psikotes</label>
                            <input type="text" name="purpose" class="form-control" placeholder="Syarat administrasi pendaftaran PNS">
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-start mt-4 gap-3">
                            <a class="btn btn-info btn-block btn-flat" onclick="add_exam();">Simpan</a>
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
            let url = "{{ route('request_exam') }}";

            $.post(url, {
                purpose: $('input[name=purpose]').val()
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
