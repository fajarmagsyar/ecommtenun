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
                <h1 class="mt-4">Produk</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="/admin/dashboard"
                            style="color: black; text-decoration:none">Admin</a></li>
                    <li class="breadcrumb-item active">Produk</li>
                </ol>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Produk
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
                                    <form action="/admin/produk" method="post" enctype="multipart/form-data">
                                        @method('post')
                                        @csrf
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
                                            <input type="text" class="form-control" name="nama_produk" required>
                                            {{-- <div id="emailHelp" class="form-text">We'll never share your email with
                                                anyone else.</div> --}}
                                        </div>
                                        <div class="mb-3">
                                            <label for="harga" class="form-label">Harga (Rp.
                                                @satuan)</label>
                                            <input type="number" min="0" class="form-control" name="harga" id="harga"
                                                placeholder="(ex: 200000)" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="harga" class="form-label">Kategori</label>
                                            <select class="form-select" name="kategori" id="" required>
                                                <option value="" selected disabled>Pilih Kategori</option>
                                                @foreach ($kategoriRows as $r)
                                                    <option value="{{ $r->kategori_id }}">{{ $r->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
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
                                    <th class="text-center">Nama Produk</th>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Gambar</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Nama Produk</th>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Gambar</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($produkRows as $key => $r)
                                    <tr>
                                        <td class="text-center">{{ $key = $key + 1 }}</td>
                                        <td>{{ $r->nama_produk }}</td>
                                        <td class="text-center">{{ $r->nama_kategori }}</td>
                                        <td class="text-end">Rp.{{ number_format($r->harga) }}</td>
                                        <td class="text-center">
                                            <a href="/upload/produk/{{ $r->gambar }}" target="_blank">
                                                <img height="50px" src="/upload/produk/{{ $r->gambar }}" alt="">
                                            </a>
                                        </td>
                                        <td class="text-center align-middle">
                                            <form action="/admin/produk/{{ $r->produk_id }}" method="post"
                                                class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                            <button data-bs-target="#ubah{{ $r->produk_id }}" data-bs-toggle="modal"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    {{-- MODAL EDIT --}}
                                    <div class="modal fade" id="ubah{{ $r->produk_id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{-- FORM Pengisian --}}
                                                    <form action="/admin/produk" method="post"
                                                        enctype="multipart/form-data">
                                                        @method('post')
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="exampleInputEmail1" class="form-label">Nama
                                                                Produk</label>
                                                            <input type="text" value="{{ $r->nama_produk }}"
                                                                class="form-control" name="nama_produk" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="harga" class="form-label">Harga (Rp.
                                                                @satuan)</label>
                                                            <input value="{{ $r->harga }}" type="number" min="0"
                                                                class="form-control" name="harga" id="harga"
                                                                placeholder="(ex: 200000)" required>
                                                        </div>
                                                        <div class="mb-5">
                                                            <label for="harga" class="form-label">Kategori</label>
                                                            <select class="form-select" name="kategori" id="" required>
                                                                <option disabled>Pilih Kategori</option>
                                                                @foreach ($kategoriRows as $s)
                                                                    <option value="{{ $s->kategori_id }}"
                                                                        {{ $r->kategori_id === $s->kategori_id ? 'selected' : '' }}>
                                                                        {{ $s->nama_kategori }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="harga" class="form-label"><input type="checkbox"
                                                                    name="checkImg"> Centang jika ingin
                                                                mengubah gambar :</label>
                                                            <input type="file" class="form-control" name="gambar"
                                                                id="harga" required accept=".jpg, .png">
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
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2021</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection
