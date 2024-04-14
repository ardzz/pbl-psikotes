@extends('layouts.dashboard')

@section('css')
    <link rel="stylesheet" href="/dist/libs/sweetalert2/dist/sweetalert2.min.css">
@endsection

@section('container-fluid')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Account Setting</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted" href="./index.html">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Account Setting</li>
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
                    <h5 class="card-title fw-semibold">Personal Details</h5>
                    <p class="card-subtitle mb-4">To change your personal detail , edit and save from here</p>
                    <form>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">NIK (Nomor Induk Kependudukan)</label>
                                    <input type="number" class="form-control"  name="nik" id="exampleInputtext" placeholder="4444555566667777" value="{{ $data->nik ?? '' }}">
                                    <span class="help-block">
                                        <small>
                                            <strong>NIK</strong> adalah nomor identitas penduduk yang tercantum dalam <strong>KTP</strong>
                                        </small>
                                    </span>
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Jenis Kelamin</label>
                                    <select class="form-select" aria-label="Default select example" name="gender">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        @isset($data->sex)
                                            @switch($data->sex)
                                                @case('f')
                                                    <option value="f" selected>Perempuan</option>
                                                    <option value="m">Laki-laki</option>
                                                    @break
                                                @case('m')
                                                    <option value="f">Perempuan</option>
                                                    <option value="m" selected>Laki-laki</option>
                                                    @break
                                            @endswitch
                                        @else
                                            <option value="f">Perempuan</option>
                                            <option value="m">Laki-laki</option>
                                        @endisset
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Religion</label>
                                    <select class="form-select" aria-label="Default select example" name="religion">
                                        <option>Pilih Agama</option>
                                        @isset($data->religion)
                                            @switch($data->religion)
                                                @case('islam')
                                                    <option value="islam" selected>Islam</option>
                                                    <option value="protestan">Protestan</option>
                                                    <option value="katolik">Katolik</option>
                                                    <option value="hindu">Hindu</option>
                                                    <option value="buddha">Buddha</option>
                                                    <option value="konghucu">Konghucu</option>
                                                    @break
                                                @case('protestan')
                                                    <option value="islam">Islam</option>
                                                    <option value="protestan" selected>Protestan</option>
                                                    <option value="katolik">Katolik</option>
                                                    <option value="hindu">Hindu</option>
                                                    <option value="buddha">Buddha</option>
                                                    <option value="konghucu">Konghucu</option>
                                                    @break
                                                @case('katolik')
                                                    <option value="islam">Islam</option>
                                                    <option value="protestan">Protestan</option>
                                                    <option value="katolik" selected>Katolik</option>
                                                    <option value="hindu">Hindu</option>
                                                    <option value="buddha">Buddha</option>
                                                    <option value="konghucu">Konghucu</option>
                                                    @break
                                                @case('hindu')
                                                    <option value="islam">Islam</option>
                                                    <option value="protestan">Protestan</option>
                                                    <option value="katolik">Katolik</option>
                                                    <option value="hindu" selected>Hindu</option>
                                                    <option value="buddha">Buddha</option>
                                                    <option value="konghucu">Konghucu</option>
                                                    @break
                                                @case('buddha')
                                                    <option value="islam">Islam</option>
                                                    <option value="protestan">Protestan</option>
                                                    <option value="katolik">Katolik</option>
                                                    <option value="hindu">Hindu</option>
                                                    <option value="buddha" selected>Buddha</option>
                                                    <option value="konghucu">Konghucu</option>
                                                    @break
                                                @case('konghucu')
                                                    <option value="islam">Islam</option>
                                                    <option value="protestan">Protestan</option>
                                                    <option value="katolik">Katolik</option>
                                                    <option value="hindu">Hindu</option>
                                                    <option value="buddha">Buddha</option>
                                                    <option value="konghucu" selected>Konghucu</option>
                                                    @break
                                            @endswitch
                                        @else
                                            <option value="islam">Islam</option>
                                            <option value="protestan">Protestan</option>
                                            <option value="katolik">Katolik</option>
                                            <option value="hindu">Hindu</option>
                                            <option value="buddha">Buddha</option>
                                            <option value="konghucu">Konghucu</option>
                                        @endisset
                                    </select>
                                    <span class="help-block">
                                        <small>
                                            Pilih agama yang sesuai dengan <strong>KTP</strong> atau <strong>Surat Nikah</strong>
                                        </small>
                                    </span>
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Status</label>
                                    <select class="form-select" aria-label="Default select example" name="marital_status">
                                        <option>Pilih Status</option>
                                        @isset($data->marital_status)
                                            @switch($data->marital_status)
                                                @case('single')
                                                    <option value="single" selected>Belum Menikah</option>
                                                    <option value="married">Menikah</option>
                                                    <option value="divorced">Cerai</option>
                                                    <option value="widowed">Duda/Janda</option>
                                                    @break
                                                @case('married')
                                                    <option value="single">Belum Menikah</option>
                                                    <option value="married" selected>Menikah</option>
                                                    <option value="divorced">Cerai</option>
                                                    <option value="widowed">Duda/Janda</option>
                                                    @break
                                                @case('divorced')
                                                    <option value="single">Belum Menikah</option>
                                                    <option value="married">Menikah</option>
                                                    <option value="divorced" selected>Cerai</option>
                                                    <option value="widowed">Duda/Janda</option>
                                                    @break
                                                @case('widowed')
                                                    <option value="single">Belum Menikah</option>
                                                    <option value="married">Menikah</option>
                                                    <option value="divorced">Cerai</option>
                                                    <option value="widowed" selected>Duda/Janda</option>
                                                    @break
                                            @endswitch
                                        @else
                                            <option value="single">Belum Menikah</option>
                                            <option value="married">Menikah</option>
                                            <option value="divorced">Cerai</option>
                                            <option value="widowed">Duda/Janda</option>
                                        @endisset
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Pekerjaan</label>
                                    <input type="text" class="form-control" id="exampleInputtext" name="occupation" placeholder="Full Stack Dev, DevOps Engineer, and CySec Expert" value="{{ $data->occupation ?? '' }}">
                                    <span class="help-block">
                                        <small>
                                            Bila belum bekerja, isi dengan <strong>Mahasiswa</strong> atau <strong>Pelajar SMA/SMK/SMK</strong>
                                        </small>
                                    </span>
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Date of Birth</label>
                                    <input type="date" class="form-control" id="exampleInputtext" name="birthdate" placeholder="12/12/1990" value="{{ $data->birthdate ?? '' }}">
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Phone</label>
                                    <input type="text" class="form-control" id="exampleInputtext" name="phone_number" placeholder="081234567890" value="{{ $data->phone_number ?? '' }}">
                                    <span class="help-block">
                                        <small>Pastikan isi nomor telepon yang dapat dihubungi</small>
                                    </span>
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Pendidikan Terakhir</label>
                                    <select class="form-select" aria-label="Default select example" name="education">
                                        <option>Pilih Pendidikan</option>
                                        @isset($data->education)
                                            @switch($data->education)
                                                @case('elementary')
                                                    <option value="elementary" selected>SD</option>
                                                    <option value="junior_high">SMP</option>
                                                    <option value="senior_high">SMA/SMK</option>
                                                    <option value="diploma">Diploma (D3/D4)</option>
                                                    <option value="bachelor">Sarjana</option>
                                                    <option value="master">Magister</option>
                                                    <option value="doctor">Doktor</option>
                                                    @break
                                                @case('junior_high')
                                                    <option value="elementary">SD</option>
                                                    <option value="junior_high" selected>SMP</option>
                                                    <option value="senior_high">SMA/SMK</option>
                                                    <option value="diploma">Diploma (D3/D4)</option>
                                                    <option value="bachelor">Sarjana</option>
                                                    <option value="master">Magister</option>
                                                    <option value="doctor">Doktor</option>
                                                    @break
                                                @case('senior_high')
                                                    <option value="elementary">SD</option>
                                                    <option value="junior_high">SMP</option>
                                                    <option value="senior_high" selected>SMA/SMK</option>
                                                    <option value="diploma">Diploma (D3/D4)</option>
                                                    <option value="bachelor">Sarjana</option>
                                                    <option value="master">Magister</option>
                                                    <option value="doctor">Doktor</option>
                                                    @break
                                                @case('diploma')
                                                    <option value="elementary">SD</option>
                                                    <option value="junior_high">SMP</option>
                                                    <option value="senior_high">SMA/SMK</option>
                                                    <option value="diploma" selected>Diploma (D3/D4)</option>
                                                    <option value="bachelor">Sarjana</option>
                                                    <option value="master">Magister</option>
                                                    <option value="doctor">Doktor</option>
                                                    @break
                                                @case('bachelor')
                                                    <option value="elementary">SD</option>
                                                    <option value="junior_high">SMP</option>
                                                    <option value="senior_high">SMA/SMK</option>
                                                    <option value="diploma">Diploma (D3/D4)</option>
                                                    <option value="bachelor" selected>Sarjana</option>
                                                    <option value="master">Magister</option>
                                                    <option value="doctor">Doktor</option>
                                                    @break
                                                @case('master')
                                                    <option value="elementary">SD</option>
                                                    <option value="junior_high">SMP</option>
                                                    <option value="senior_high">SMA/SMK</option>
                                                    <option value="diploma">Diploma (D3/D4)</option>
                                                    <option value="bachelor">Sarjana</option>
                                                    <option value="master" selected>Magister</option>
                                                    <option value="doctor">Doktor</option>
                                                    @break
                                                @case('doctor')
                                                    <option value="elementary">SD</option>
                                                    <option value="junior_high">SMP</option>
                                                    <option value="senior_high">SMA/SMK</option>
                                                    <option value="diploma">Diploma (D3/D4)</option>
                                                    <option value="bachelor">Sarjana</option>
                                                    <option value="master">Magister</option>
                                                    <option value="doctor" selected>Doktor</option>
                                                    @break
                                            @endswitch
                                        @else
                                            <option value="elementary">SD</option>
                                            <option value="junior_high">SMP</option>
                                            <option value="senior_high">SMA/SMK</option>
                                            <option value="diploma">Diploma (D3/D4)</option>
                                            <option value="bachelor">Sarjana</option>
                                            <option value="master">Magister</option>
                                            <option value="doctor">Doktor</option>
                                        @endisset
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-start mt-4 gap-3">
                                    <a class="btn btn-primary" onclick="update_profile();">Save</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/dist/libs/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="/dist/js/forms/sweet-alert.init.js"></script>
    <script>

    function update_profile() {
        let url = '{{ route('edit_personal_information') }}';

        let data = {
            nik: document.querySelector('input[name="nik"]').value,
            occupation: document.querySelector('input[name="occupation"]').value,
            birthdate: document.querySelector('input[name="birthdate"]').value,
            phone_number: document.querySelector('input[name="phone_number"]').value,
            religion: document.querySelector('select[name="religion"]').value,
            education: document.querySelector('select[name="education"]').value,
            sex: document.querySelector('select[name="gender"]').value,
            marital_status: document.querySelector('select[name="marital_status"]').value,
        };

        for (let key in data) {
            if (data[key] === '') {
                delete data[key];
            }
        }

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function (response) {
                swal.fire({
                    title: 'Success',
                    text: response.message,
                    icon: 'success',
                    button: 'OK'
                });
            },
            error: function (error) {
                swal.fire({
                    title: 'Error',
                    text: error.responseJSON.message,
                    icon: 'error',
                    button: 'OK'
                });
            }
        });
    }

    function update_account(){
        let url = '{{ route('profile.update') }}';

        let data = {
            name: document.querySelector('input[name="full_name"]').value,
            email: document.querySelector('input[name="email"]').value,
        };

        for (let key in data) {
            if (data[key] === '') {
                delete data[key];
            }
        }

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function (response) {
                swal.fire({
                    title: 'Success',
                    text: response.message,
                    icon: 'success',
                    button: 'OK'
                });
            },
            error: function (error) {
                swal.fire({
                    title: 'Error',
                    text: error.responseJSON.message,
                    icon: 'error',
                    button: 'OK'
                });
            }
        });
    }

    function update_password(){
        let url = '{{ route('password.update') }}';

        let data = {
            current_password: document.querySelector('input[name="current_password"]').value,
            password: document.querySelector('input[name="new_password"]').value,
            password_confirmation: document.querySelector('input[name="new_password"]').value,
        };

        for (let key in data) {
            if (data[key] === '') {
                delete data[key];
            }
        }

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function (response) {
                swal.fire({
                    title: 'Success',
                    text: response.message,
                    icon: 'success',
                    button: 'OK'
                });
            },
            error: function (error) {
                swal.fire({
                    title: 'Error',
                    text: error.responseJSON.message,
                    icon: 'error',
                    button: 'OK'
                });
            }
        });
    }
    </script>
@endsection
