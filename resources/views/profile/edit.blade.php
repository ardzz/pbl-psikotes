@extends('layouts.dashboard')

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
                        <img src="../../dist/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4">
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
                            <input type="text" class="form-control" id="exampleInputtext" value="{{ auth()->user()->name }}">
                        </div>
                        <div class="mb-4">
                            <label for="exampleInputPassword1" class="form-label fw-semibold">Your Email</label>
                            <input type="email" class="form-control" id="exampleInputtext" value="{{ auth()->user()->email }}">
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-start mt-4 gap-3">
                                <button class="btn btn-primary">Save</button>
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
                            <input type="password" class="form-control" id="exampleInputtext" placeholder="********">
                        </div>
                        <div class="mb-4">
                            <label for="exampleInputPassword1" class="form-label fw-semibold">New Password</label>
                            <input type="password" class="form-control" id="exampleInputtext" placeholder="********">
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-start mt-4 gap-3">
                                <button class="btn btn-primary">Save</button>
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
                    <h5 class="card-title fw-semibold">Personal Details</h5>
                    <p class="card-subtitle mb-4">To change your personal detail , edit and save from here</p>
                    <form>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">NIK (Nomor Induk Kependudukan)</label>
                                    <input type="number" class="form-control" id="exampleInputtext" placeholder="4444555566667777">
                                    <span class="help-block">
                                        <small>
                                            <strong>NIK</strong> adalah nomor identitas penduduk yang tercantum dalam <strong>KTP</strong>
                                        </small>
                                    </span>
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Jenis Kelamin</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option value="1">Laki-laki</option>
                                        <option value="2">Perempuan</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Religion</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option value="1">Islam</option>
                                        <option value="2">Kristen</option>
                                        <option value="3">Katolik</option>
                                        <option value="4">Hindu</option>
                                        <option value="5">Budha</option>
                                        <option value="6">Konghucu</option>
                                    </select>
                                    <span class="help-block">
                                        <small>
                                            Pilih agama yang sesuai dengan <strong>KTP</strong> atau <strong>Surat Nikah</strong>
                                        </small>
                                    </span>
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Status</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option value="1">Belum Menikah</option>
                                        <option value="2">Menikah</option>
                                        <option value="3">Duda</option>
                                        <option value="4">Janda</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Pekerjaan</label>
                                    <input type="text" class="form-control" id="exampleInputtext" placeholder="Full Stack Dev, DevOps Engineer, and CySec Expert">
                                    <span class="help-block">
                                        <small>
                                            Bila belum bekerja, isi dengan <strong>Mahasiswa</strong> atau <strong>Pelajar SMA/SMK</strong>
                                        </small>
                                    </span>
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Date of Birth</label>
                                    <input type="date" class="form-control" id="exampleInputtext" placeholder="12/12/1990">
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Phone</label>
                                    <input type="text" class="form-control" id="exampleInputtext" placeholder="081234567890">
                                    <span class="help-block">
                                        <small>Pastikan isi nomor telepon yang dapat dihubungi</small>
                                    </span>
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Pendidikan Terakhir</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option value="1">SD</option>
                                        <option value="2">SMP</option>
                                        <option value="3">SMA/SMK</option>
                                        <option value="4">D3</option>
                                        <option value="5">S1</option>
                                        <option value="6">S2</option>
                                        <option value="7">S3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-start mt-4 gap-3">
                                    <button class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
