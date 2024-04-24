@extends('layouts.dashboard')

@section('container-fluid')
    <div class="card w-100 position-relative overflow-hidden mb-0">
        <div class="card-body p-4">
            <div class="border-bottom">
                <div class="row">
                    <div class="col-12 col-sm-auto mb-2">
                        <ol class="breadcrumb font-size-16 mb-0">
                            <li class="breadcrumb-item">
                                <a href="#" class="router-link-active">
                                    <strong class="router-link-active">
                                        <i class="uil uil-home-alt"></i>
                                        PSIKOTES
                                    </strong>
                                </a>
                            </li>
                            <li class="breadcrumb-item active">{{ env('APP_NAME') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- content of question full -->
        <div class="card-body p-4">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-warning" role="alert">
                        <h4 class="alert-heading mb-3">PsiKotes Sedang Dalam Proses Persetujuan</h4>
                        <p class="mb-1">Mohon tunggu hingga admin menyetujui permintaan psikotes anda.</p>
                        <p class="mb-1">Informasi PsikoTes Yang Anda Ajukan:</p>
                        <p class="mb-1"><strong>{{ $exam->purpose }}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function start_exam() {
            let url = '{{ route('start_exam') }}';
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    swal.fire({
                        title: 'Berhasil',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                },
                error: function(xhr, status, error) {
                    swal.fire({
                        title: 'Gagal',
                        text: xhr.responseJSON.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    </script>
@endsection
