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
    <section class="d-flex align-items-center mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="carouselExampleControls" class="carousel" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="/user/assets/img/banner-1.jpg" class="d-block w-100" style="border-radius: 40px"
                                    alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="/user/assets/img/banner-2.jpg" class="d-block w-100" style="border-radius: 40px"
                                    alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="/user/assets/img/banner-3.jpg" class="d-block w-100" style="border-radius: 40px"
                                    alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <main id="main">
        <!-- ======= Why Us Section ======= -->
        <section id="why-us" class="why-us" style="margin-top: -5rem">
            <div class="container">

                <div class="row">
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="content">
                            <h3>
                                <center><img src="/user/assets/img/logo.png" style="width: 10rem" alt=""></center>
                            </h3>
                            <p>
                                Kami beroperasi dengan fokus memberikan pelayanan dan kualitas terbaik untuk memajukan
                                tenunan lokal di
                                <b>Nusa Tenggara Timur</b>
                            </p>
                            <div class="text-center">
                                <a href="#" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 d-flex align-items-stretch">
                        <div class="icon-boxes d-flex flex-column justify-content-center">
                            <div class="row">
                                @foreach ($kategoriRows as $r)
                                    <div class="col-xl-4 d-flex align-items-stretch">
                                        <div class="icon-box mt-4 mt-xl-0">
                                            <div><img src="{{ $r->gambar }}" width="100%" style="border-radius: 20px"
                                                    alt=""></div>
                                            <h4 class="mt-3">{{ $r->nama_kategori }}</h4>
                                            <a href="/kategori/{{ $r->nama_kategori }}"
                                                class="btn-primary btn-sm mt-0 px-4"
                                                style="border-radius: 50px">Jelajahi</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div><!-- End .content-->
                    </div>
                </div>

            </div>
        </section><!-- End Why Us Section -->

        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts">
            <div class="container">

                <div class="row">
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="col-lg-3 col-md-6">
                            <div class="count-box shadow" style="border-radius:10px">
                                <img src="/user/assets/img/k{{ $i }}.jpg" width="100%" alt="">
                            </div>
                        </div>
                    @endfor

                </div>

            </div>
        </section><!-- End Counts Section -->

        <!-- ======= Services Section ======= -->

        <!-- ======= Doctors Section ======= -->
        <section id="doctors" class="doctors">
            <div class="container">

                <div class="section-title">
                    <h2>Produk</h2>
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
                                    <div class="pic"><img src="/{{ $r->gambar }}" class="img-fluid"
                                            alt="">
                                    </div>
                                    <div class="member-info">
                                        <h4>{{ $r->nama_produk }}</h4>
                                        <span>{{ $r->nama_kategori }} <br>
                                            <b>Stok {{ $r->stok == 0 ? 'Kosong' : $r->stok }}</b>
                                        </span>
                                        <h4 class="mt-2" style="color: rgb(49, 49, 49)">
                                            <strong>Rp.{{ number_format($r->harga) }}</strong>
                                        </h4>
                                        <a href="/produk/{{ $r->produk_id }}"
                                            class="btn btn-primary btn-sm mt-2 float-end"
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
        {{-- <!-- ======= Testimonials Section ======= -->
        <section id="testimonials" class="testimonials">
            <div class="container">

                <div class="section-title">
                    <h2>Testimoni</h2>
                </div>
                <div class="testimonials-slider swiper-container" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <img src="/user/assets/img/testimonials/testimonials-1.jpg" class="testimonial-img"
                                        alt="">
                                    <h3>Saul Goodman</h3>
                                    <h4>Ceo &amp; Founder</h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit
                                        rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam,
                                        risus at semper.
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <img src="/user/assets/img/testimonials/testimonials-2.jpg" class="testimonial-img"
                                        alt="">
                                    <h3>Sara Wilsson</h3>
                                    <h4>Designer</h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid
                                        cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet
                                        legam anim culpa.
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <img src="/user/assets/img/testimonials/testimonials-3.jpg" class="testimonial-img"
                                        alt="">
                                    <h3>Jena Karlis</h3>
                                    <h4>Store Owner</h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem
                                        veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint
                                        minim.
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <img src="/user/assets/img/testimonials/testimonials-4.jpg" class="testimonial-img"
                                        alt="">
                                    <h3>Matt Brandon</h3>
                                    <h4>Freelancer</h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim
                                        fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem
                                        dolore labore illum veniam.
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <img src="/user/assets/img/testimonials/testimonials-5.jpg" class="testimonial-img"
                                        alt="">
                                    <h3>John Larson</h3>
                                    <h4>Entrepreneur</h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster
                                        veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam
                                        culpa fore nisi cillum quid.
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section><!-- End Testimonials Section --> --}}

    </main><!-- End #main -->
@endsection
