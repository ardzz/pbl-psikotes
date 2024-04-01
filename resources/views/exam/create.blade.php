@extends('layouts.app')
@push('css')
@endpush
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 text-uppercase">
                    <h4 class="m-0">Tambah Pengguna</h4>
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
                        <form action="{{ route('manage-user.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name')is-invalid @enderror" placeholder="Nama Lengkap">
                                    @error('name')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
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
                                <button type="submit" class="btn btn-info btn-block btn-flat"><i class="fa fa-save"></i>
                                    Simpan</button>
                            </div>
                        </form>
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
    </script>
@endpush
