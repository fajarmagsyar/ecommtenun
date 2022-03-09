@extends('user.layouts.main')
@section('content')
    <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors mt-5">
        <div class="container">
            <div class="row mb-4">
                <h4 style="color:rgb(21, 50, 78)"><strong>{{ $produkRow->nama_produk }}</strong></h4>
                <h6>{{ $produkRow->nama_kategori }}</h6>
            </div>
            <div class="row">
                <div class="col-sm-6"><img src="/{{ $produkRow->gambar }}" class="shadow-lg" width="100%"
                        style="border-radius: 20px" alt=""></div>
                <div class="col-sm-6">
                    <div class="card shadow-lg" style="border:none">
                        <div class="card-body">

                            <p class="card-text"><strong>Deskripsi :</strong></p>
                            <p>{{ $produkRow->deskripsi }}</p>
                            <p class="card-text" style="font-size: 30px">
                                <strong>Rp.{{ number_format($produkRow->harga) }}</strong>
                            </p>
                            <p class="card-text text-danger small" style="opacity: 0.8"><i class="ri-hard-drive-2-fill"></i>
                                <strong>Sisa
                                    stok</strong> {{ $produkRow->stok }}
                            </p>
                            @if ($logged == true)
                                <a href="/produk/addToCart" class="btn btn-primary float-end btn-sm px-4"
                                    style="border-radius: 30px">Masukkan
                                    Keranjang <i class="ri-shopping-cart-fill"></i></a>
                                <a href="/produk/checkout" class="btn btn-info btn-sm px-4"
                                    style="color:white;border-radius: 30px">Checkout <i
                                        class="ri-checkbox-circle-line"></i></a>
                            @else
                                <a href="/login" class="btn btn-primary float-end btn-sm px-4"
                                    style="border-radius: 30px">Masukkan
                                    Keranjang <i class="ri-shopping-cart-fill"></i></a>
                                <a href="/login" class="btn btn-info btn-sm px-4"
                                    style="color:white;border-radius: 30px">Checkout <i
                                        class="ri-checkbox-circle-line"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Doctors Section -->

    </main><!-- End #main -->
@endsection
