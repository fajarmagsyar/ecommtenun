@extends('user.layouts.main')
@section('content')

    <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors mt-5">
        <div class="container">

            <div class="section-title">
                <h2>Produk <span class="text-muted" style="font-size: 20px; opacity: 0.7">| {{ $kategori }}</span>
                </h2>
            </div>

            <div class="row">
                @if (count($produkRows) == 0)
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
                    @foreach ($produkRows as $key => $r)
                        <div class="col-lg-6 mx-auto">
                            <div class="member d-flex align-items-start">
                                <div class="pic"><img src="/{{ $r->gambar }}" class="img-fluid" alt="">
                                </div>
                                <div class="member-info">
                                    <h4>{{ $r->nama_produk }}</h4>
                                    <span>{{ $r->nama_kategori }}</span>
                                    <p>{{ $r->deskripsi }}</p>
                                    <a href="/produk/{{ $r->produk_id }}" class="btn btn-primary btn-sm mt-2 float-end"
                                        style="opacity: 0.8; border-radius: 40px; padding-left: 20px; padding-right:20px">Lihat
                                        produk <i class="ri-shopping-cart-fill"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section><!-- End Doctors Section -->

    </main><!-- End #main -->
@endsection
