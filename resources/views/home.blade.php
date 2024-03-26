@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0" style="font-family: 'Inter', sans-serif; color: #02D1FF;">Selamat datang {{ ucwords(auth()->user()->name) }}</h4>
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
                            <h5 class="m-0" style="font-weight: bold;">QUIZ TEST</h5>
                            <p>Click tombol di bawah untuk memulai test</p>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-primary" style="background-color: #02D1FF;">START QUIZ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('.toast').toast('show')
    </script>
@endpush
