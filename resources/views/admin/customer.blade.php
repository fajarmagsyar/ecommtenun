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
                <h1 class="mt-4">Customer</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="/admin/dashboard"
                            style="color: black; text-decoration:none">Admin</a></li>
                    <li class="breadcrumb-item active">Customer</li>
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
                                    <form action="/admin/customer" method="post">
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
                                @foreach ($checkoutRows as $key => $r)
                                    <tr>
                                        <th class="text-center align-middle">{{ $key = $key + 1 }}</th>
                                        <td class="align-middle text-center">
                                            <code>CHCKID.{{ $r->checkout_id }}</code>
                                        </td>
                                        <td class="text-end">
                                            <ul class="list-group">
                                                @php
                                                    $totalHarga = 0;
                                                @endphp
                                                @foreach ($keranjangRows as $s)
                                                    @if ($r->checkout_id == $s->checkout_id)
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-center">
                                                            {{ $s->nama_produk }}
                                                            <span class="badge" style="color:black">Rp.
                                                                {{ number_format($s->harga) }}</span>

                                                        </li>
                                                        @php
                                                            $totalHarga = $totalHarga + $s->harga;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @php
                                                    $totalHarga = $totalHarga + $r->ongkir;
                                                @endphp
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span>Biaya Pengiriman <b>({{ strtoupper($r->kurir) }})</b>
                                                    </span>
                                                    <span class="badge" style="color:black">Rp.
                                                        {{ number_format($r->ongkir) }}</span>

                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span><strong>Total Harga</strong></span>
                                                    <span class="badge" style="color:black">Rp.
                                                        {{ number_format($totalHarga) }}</span>

                                                </li>
                                            </ul>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if ($r->no_resi != null)
                                                <span class="badge bg-primary">
                                                    No Resi. {{ $r->no_resi }}
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    No Resi Belum Terbit
                                                </span>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </main>
    @endsection
