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
                    <h5 class="card-title fw-semibold">Account Details</h5>
                    <p class="card-subtitle mb-4">To change your account detail, edit and save from here</p>
                    <form>
                        <div class="mb-4">
                            <label for="exampleInputPassword1" class="form-label fw-semibold">Your Name</label>
                            <input type="text" class="form-control" id="exampleInputtext" name="full_name" value="{{ auth()->user()->name }}">
                        </div>
                        <div class="mb-4">
                            <label for="exampleInputPassword1" class="form-label fw-semibold">Your Email</label>
                            <input type="email" class="form-control" id="exampleInputtext" name="email" value="{{ auth()->user()->email }}">
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-start mt-4 gap-3">
                                <a class="btn btn-primary" onclick="update_account()">Save</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="col-12">
            <div class="card w-100 position-relative overflow-hidden mb-0">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold">Credentials</h5>
                    <p class="card-subtitle mb-4">To change your credentials, edit and save from here</p>
                    <form>
                        <div class="mb-4">
                            <label for="exampleInputPassword1" class="form-label fw-semibold">Current Password</label>
                            <input type="password" class="form-control" name="current_password" id="exampleInputtext" placeholder="********">
                        </div>
                        <div class="mb-4">
                            <label for="exampleInputPassword1" class="form-label fw-semibold">New Password</label>
                            <input type="password" class="form-control" name="new_password" id="exampleInputtext" placeholder="********">
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-start mt-4 gap-3">
                                <a class="btn btn-primary" onclick="update_password();">Save</a>
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
