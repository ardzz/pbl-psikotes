@extends('layouts.dashboard')

@section('container-fluid')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Manage User</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted" href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">User Delete</li>
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
                        <input class="form-control" type="text" id="name" value="{{ $item->name }}" disabled>
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label fw-semibold">Alamat Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $item->email }}" disabled>
                    </div>
                    <div class="form-group mb-4">
                            <label class="form-label fw-semibold">Role</label>
                            <input type="text" name="purpose" class="form-control" value="{{ $item->getUserType() }}" disabled>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between mt-4 gap-3">
                            <a class="btn btn-danger btn-block btn-flat" onclick="delete_user();">Delete</a>
                            <a class="btn btn-primary btn-block btn-flat" href="{{route('manageUser')}}" >Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function delete_user() {
            let url = "{{ route('delete-user') }}";

            $.post(url, {
                id: "{{$item->id}}",
            })
                .done(function(response) {
                    swal.fire(
                        'Berhasil!',
                        'Data User berhasil dihapus',
                        'success'
                    ).then((result) => {
                        window.location.href = "{{ route('manageUser') }}";
                    });
                })
                .fail(function(error) {
                    swal.fire(
                        'Gagal!',
                        'Data User gagal dihapus: ' + error.responseJSON.message,
                        'error'
                    );
                });
        }


    </script>
@endsection
