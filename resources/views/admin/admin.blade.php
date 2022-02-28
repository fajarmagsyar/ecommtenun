@extends('admin.layouts.main')
@section('content')
    @if (session()->has('success'))
        <script>
            swal("Berhasil", "{{ session('success') }}", "success")
        </script>
    @endif
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Admin</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="/admin/dashboard"
                            style="color: black; text-decoration:none">Admin</a></li>
                    <li class="breadcrumb-item active">Data Admin</li>
                </ol>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Admin
                        <span class="float-end"><button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                data-bs-target="#tambahModal">+ Tambah</button></span>
                    </div>
                    {{-- MODAL TAMBAH --}}
                    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{-- FORM Pengisian --}}
                                    <form action="/admin/admin" method="post">
                                        @method('post')
                                        @csrf
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Nama Customer</label>
                                            <input type="text" class="form-control" name="nama_customer" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Alamat</label>
                                            <input type="text" class="form-control" name="alamat" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Username</label>
                                            <input type="text" class="form-control" name="username" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Password</label>
                                            <input type="password" class="form-control" name="password" required>
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-secondary"><i class="fa fa-undo"></i>
                                        Reset</button>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                                        Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple" class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Nama Customer</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Token</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Nama Customer</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Token</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($customerRows as $key => $r)
                                    <tr>
                                        <td class="text-center">{{ $key = $key + 1 }}</td>
                                        <td>{{ $r->nama_customer }}</td>
                                        <td>{{ $r->alamat }}</td>
                                        <td><a href="mailto:{{ $r->email }}"><i class="fa fa-envelope"></i>
                                                {{ $r->email }}</a></td>
                                        <td>{{ $r->username }}</td>
                                        <td class="text-center">
                                            <code>{{ $r->token_otp !== null ? $r->token_otp : 'Belum ada' }}</code>
                                        </td>

                                        <td class="text-center align-middle">
                                            <form action="/admin/admin/{{ $r->customer_id }}" method="post"
                                                class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                            <button data-bs-target="#ubah{{ $r->customer_id }}" data-bs-toggle="modal"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    {{-- MODAL TAMBAH --}}
                                    <div class="modal fade" id="ubah{{ $r->customer_id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{-- FORM Pengisian --}}
                                                    <form action="/admin/admin/{{ $r->customer_id }}" method="post">
                                                        @method('patch')
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="exampleInputEmail1" class="form-label">Nama
                                                                Customer</label>
                                                            <input type="text" class="form-control" name="nama_customer"
                                                                value="{{ $r->nama_customer }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleInputEmail1"
                                                                class="form-label">Alamat</label>
                                                            <input type="text" class="form-control" name="alamat"
                                                                value="{{ $r->alamat }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleInputEmail1"
                                                                class="form-label">Email</label>
                                                            <input type="email" class="form-control" name="email"
                                                                value="{{ $r->email }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleInputEmail1"
                                                                class="form-label">Username</label>
                                                            <input type="text" class="form-control" name="username"
                                                                value="{{ $r->username }}" required>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="reset" class="btn btn-secondary"><i
                                                            class="fa fa-undo"></i>
                                                        Reset</button>
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="fa fa-save"></i>
                                                        Simpan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </main>
    @endsection
