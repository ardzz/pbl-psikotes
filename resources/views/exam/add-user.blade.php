@extends('layouts.dashboard')

@section('container-fluid')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Add Users</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted" href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Add Users</li>
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
                        <label class="form-label fw-semibold">Name</label>
                        <input type="text" name="name" class="form-control " placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group mb-4">
                            <label class="form-label fw-semibold">Email address</label>
                            <input type="text" name="email" class="form-control" placeholder="Email Address">
                    </div>
                    <div class="form-group mb-4">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="text" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group mb-4">
                            <label class="form-label fw-semibold">Confirm Password</label>
                            <input type="text" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                    </div>
                    <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Select Role</label>
                                    <select class="form-select" aria-label="Default select example" name="selectrole">
                                        <option value="">Select Role</option>
                                            <option value="doctor">Doctor</option>
                                            <option value="patient">Patient</option>
                                    </select>
                                </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-start mt-4 gap-3">
                            <a class="btn btn-info btn-block btn-flat" onclick="add_user();">Simpan</a>
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

        function add_user(){
            let url = "{{ route('add-user') }}";

            $.post(url, {
                name: $('input[name="name"]').val(),
                email: $('input[name="email"]').val(),
                password: $('input[name="password"]').val(),
                password_confirmation: $('input[name="password_confirmation"]').val(),
                role: $('select[name="selectrole"]').val(),
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
