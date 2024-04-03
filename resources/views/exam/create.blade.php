@extends('layouts.app')
@push('css')
@endpush
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 text-uppercase">
                    <h4 class="m-0">Tambah Exam</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title m-0"></h5>
                            <div class="card-tools">
                                <a href="{{ route('manage-user.index') }}" class="btn btn-tool"><i
                                        class="fas fa-arrow-alt-circle-left"></i></a>
                            </div>
                        </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Cari Nama Pasien</label>
                                    <input type="text" name="search_name"
                                        class="form-control @error('name')is-invalid @enderror" placeholder="Nama Lengkap" id="search_name">
                                    @error('name')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Pasien</label>
                                    <select name="patient_id" class="form-control @error('patient_id')is-invalid @enderror"
                                        id="patient" onchange="set_email();">
                                        <option value="">Pilih Pasien</option>
                                    </select>
                                    @error('patient_id')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                <div class="form-group">
                                    <label>Alamat Email</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email')is-invalid @enderror "
                                        placeholder="Alamat Email" disabled="">
                                    @error('email')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tujuan Tes</label>
                                    <input type="text" name="purpose" class="form-control" placeholder="Tujuan Tes">
                                </div>
                                <div class="form-group">
                                    <label>Nama Dokter</label>
                                    <option value="">Pilih Dokter</option>
                                    <select name="doctor_id" class="form-control @error('doctor_id')is-invalid @enderror">
                                        @foreach ($doctors as $doctor)
                                            <option value="{{ $doctor->id }}">Dr. {{ $doctor->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('doctor_id')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info btn-block btn-flat" onclick="add_exam();"><i class="fa fa-save"></i>
                                    Simpan</button>
                            </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('') }}plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
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
            let url = "{{ url('/api/search_patient/') }}/" + name;

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
                doctor_id: $('select[name="doctor_id"]').val()
            })
                .done(function(response) {
                    swal(
                        'Berhasil!',
                        'Data berhasil disimpan',
                        'success'
                    ).then((result) => {
                        window.location.href = "{{ route('exams') }}";
                    });
                })
                .fail(function(error) {
                    swal(
                        'Gagal!',
                        'Data gagal disimpan: ' + error.responseJSON.message,
                        'error'
                    );
                });

        }
    </script>
@endpush
