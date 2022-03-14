@extends('user.layouts.main')
@section('content')

    @if (session()->has('success'))
        <script>
            swal("Berhasil", "{{ session('success') }}", "success")
        </script>
    @endif
    @if (session()->has('error'))
        <script>
            swal("Gagal", "{{ session('error') }}", "error")
        </script>
    @endif
    <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors mt-5">
        <div class="container">

            <div class="section-title">
                <h2>Keranjang Belanja
                </h2>
            </div>

            <div class="row">
                @if (count($keranjangRows) == 0)
                    <div class="col-lg-12">
                        <div class="member">
                            <div class="member-info">
                                <center class="mx-auto">
                                    Belum ada produk
                                </center>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-sm-8 mx-auto">
                        <div class="card shadow" style="border: none">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nama Barang</th>
                                            <th class="text-center">Harga Satuan</th>
                                            <th class="text-center">Hapus</th>
                                        </tr>
                                        @php
                                            $jumlahHarga = 0;
                                        @endphp
                                        @foreach ($keranjangRows as $key => $r)
                                            <tr>
                                                <th class="text-center">{{ $key = $key + 1 }}</th>
                                                <td>{{ $r->nama_produk }}</td>
                                                <td class="text-end">Rp. {{ number_format($r->harga) }}</td>
                                                <td class="text-center">
                                                    <form action="/keranjang/deleteitem" method="post">
                                                        @csrf
                                                        <input type="hidden" name="pemesanan_id"
                                                            value="{{ $r->pemesanan_id }}">
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Apakah anda yakin ingin menghapus item ini?')"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @php
                                                $jumlahHarga = $jumlahHarga + $r->harga;
                                            @endphp
                                        @endforeach
                                        <tr>
                                            <th colspan="2" class="text-end"><b>Jumlah Total</b></th>
                                            <th class="text-end">
                                                Rp. {{ number_format($jumlahHarga) }}
                                            </th>
                                            <th></th>
                                        </tr>
                                    </table>
                                    <div class="text-end">
                                        <a class="btn btn-primary px-3 {{ $countKeranjang == 0 ? 'disabled' : '' }}"
                                            href="{{ $countKeranjang == 0 ? '#' : '/checkout' }}"
                                            style="border-radius: 20px">Checkout <i class="fas fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section><!-- End Doctors Section -->

    </main><!-- End #main -->
@endsection
