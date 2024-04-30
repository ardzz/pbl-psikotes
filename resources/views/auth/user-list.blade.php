@extends('layouts.dashboard')

@section('css')
    <link rel="stylesheet" href="../../dist/libs/vanilla-datatables-editable/datatable.editable.min.css">
@endsection

@section('container-fluid')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Manage Users</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted" href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Manage Users</li>
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
                    <table
                        class="table table-striped table-bordered"
                        id="editable-datatable"
                    >
                        <thead>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Aksi</th>
                        </thead>
                        <tbody>
                        @foreach ($users as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->getUserType() }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    <div class="btn-group mb-2">
                                        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                            <li>
                                                <a class="dropdown-item" href="{{route('edit.user', $item->id)}}">Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{route('delete.user', $item->id)}}">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="../../dist/libs/vanilla-datatables-editable/datatable.editable.min.js"></script>
    <script src="../../dist/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../../dist/js/plugins/mindmup-editabletable.js"></script>
    <script src="../../dist/js/plugins/numeric-input-example.js"></script>
    <script>
        $("#editable-datatable")
            .numericInputExample()
            .find("td:first")
            .focus();
        $(function () {
            $("#editable-datatable").DataTable();
        });
    </script>
@endsection
