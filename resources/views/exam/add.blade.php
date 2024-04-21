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
                        <label class="form-label fw-semibold">Cari Nama Pasien</label>
                        <input type="text" name="search_name" class="form-control " placeholder="Nama Lengkap" id="search_name">
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label fw-semibold">Nama Pasien</label>
                        <select name="patient_id" class="form-control" id="patient" onchange="set_email();">
                            <option value="">Pilih Pasien</option>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label fw-semibold">Alamat Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Alamat Email" disabled="">
                    </div>
                    <div class="form-group mb-4">
                            <label class="form-label fw-semibold">Keterangan/Tujuan Psikotes</label>
                            <input type="text" name="purpose" class="form-control" placeholder="Syarat administrasi pendaftaran PNS">
                    </div>
                    <div class="form-group mb-4">
                            <label class="form-label fw-semibold">Nama Dokter</label>
                            @if(auth()->user()->getUserType() == "Doctor")
                                <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                                <input type="hidden" name="doctor_id" class="form-control" value="{{ auth()->user()->id }}" disabled>
                            @elseif(auth()->user()->getUserType() == "Admin")
                                <select name="doctor_id" class="form-control">
                                    <option value="">Pilih Dokter</option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                    @endforeach
                                </select>
                            @endif
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
        $(function() {
            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })
        })

        function clear_patient(with_initial = 0) {
            $('#patient').empty();
            $('input[name="email"]').val('');
            if (with_initial) {
                $('#patient').append(`<option value="">Pilih Pasien</option>`);
            }
        }

        function set_email() {
            let email = $('#patient option:selected').attr('email');
            $('input[name="email"]').val(email);
        }

        $('#search_name').on('input', function() {
            let name = $(this).val();
            let url = "{{ url('/api/patient/search/') }}/" + name;

            $.get(url)
                .done(function(response) {
                    clear_patient();
                    if (response.length > 1) {
                        response.forEach(element => {
                            $('#patient').append(`<option value="${element.id}" email="${element.email}">${element.name}</option>`);
                        });
                    }
                    else if(response.length === 1){
                        $('#patient').append(`<option value="${response[0].id}" email="${response[0].email}" selected>${response[0].name}</option>`);
                        set_email();
                    }else{
                        $('#patient').append(`<option value="">Tidak ada data</option>`);
                    }
                })
                .fail(function(error) {
                    clear_patient();
                    if (error.status === 404){
                        $('#patient').append(`<option value="">Tidak ada data</option>`);
                    }
                    else{
                        $('#patient').append(`<option value="">Terjadi kesalahan</option>`);
                    }
                });
        })

        function add_exam(){
            let url = "{{ route('add_exam') }}";

            $.post(url, {
                user_id: $('select[name="patient_id"]').val(),
                purpose: $('input[name="purpose"]').val(),
                @if(auth()->user()->getUserType() == "Admin")
                doctor_id: $('select[name="doctor_id"]').val()
                @else
                doctor_id: "{{ auth()->user()->id }}"
                @endif
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
