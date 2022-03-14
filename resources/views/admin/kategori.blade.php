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
                <h1 class="mt-4">Kategori</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="/admin/dashboard"
                            style="color: black; text-decoration:none">Admin</a></li>
                    <li class="breadcrumb-item active">Kategori</li>
                </ol>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Customer
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
                                    <form action="/admin/kategori" method="post" enctype="multipart/form-data">
                                        @method('post')
                                        @csrf
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Nama Kategori</label>
                                            <input type="text" class="form-control" name="nama_kategori" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="harga" class="form-label">Gambar</label>
                                            <input type="file" class="form-control" name="gambar" id="harga" required
                                                accept=".jpg, .png">
                                            <div id="emailHelp" class="text-danger">*File JPG atau PNG dengan ukuran
                                                maks. 2MB</div>
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
                                    <th class="text-center">Nama Kategori</th>
                                    <th class="text-center">Gambar</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Nama Kategori</th>
                                    <th class="text-center">Gambar</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($kategoriRows as $key => $r)
                                    <tr>
                                        <td class="text-center">{{ $key = $key + 1 }}</td>
                                        <td>{{ $r->nama_kategori }}</td>
                                        <td class="text-center">
                                            <a href="/{{ $r->gambar }}" target="_blank">
                                                <img height="50px" src="{{ $r->gambar }}" alt="">
                                            </a>
                                        </td>
                                        <td class="text-center align-middle">
                                            <form action="/admin/kategori/{{ $r->kategori_id }}" method="post"
                                                class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                            <button data-bs-target="#ubah{{ $r->kategori_id }}" data-bs-toggle="modal"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    {{-- MODAL EDIT --}}
                                    <div class="modal fade" id="ubah{{ $r->kategori_id }}" tabindex="-1"
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
                                                    <form action="/admin/kategori/{{ $r->kategori_id }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @method('patch')
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="exampleInputEmail1" class="form-label">Nama
                                                                Kategori</label>
                                                            <input type="text" value="{{ $r->nama_kategori }}"
                                                                class="form-control" name="nama_kategori" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="harga" class="form-label"><input type="checkbox"
                                                                    name="checkImg"> Centang jika ingin
                                                                mengubah gambar :</label>
                                                            <input type="file" class="form-control" name="gambar"
                                                                id="harga" accept=".jpg, .png">
                                                            <div id="emailHelp" class="text-danger">*File JPG atau PNG
                                                                dengan ukuran
                                                                maks. 2MB</div>
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
