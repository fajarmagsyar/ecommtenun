<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Tenun Moko Alor | Beli Online Terpercaya</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="/user/assets/img/favicon.png" rel="icon">
    <link href="/user/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <link href="/user/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="/user/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/user/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/user/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/user/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="/user/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/user/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/user/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <link href="/user/assets/css/style.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <span class="logo me-auto"><a href="/"><img src="/user/assets/img/logo.png" height="100%" alt="">
                </a><span style="font-size: 24px">Tenun Gunung Mako</span></span>

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link active" href="/">Home</a></li>
                    <li><a class="nav-link" href="/produk">Produk</a></li>
                    <li class="dropdown"><a href="/kategori"><span>Kategori</span>
                            <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            @foreach ($kategoriRows as $r)
                                <li><a href="/kategori/{{ $r->nama_kategori }}">{{ $r->nama_kategori }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @if ($logged == true)

                        <li><a class="nav-link" href="/keranjang">
                                Keranjang &nbsp;
                                @if ($countKeranjang !== null)
                                    <span class="badge bg-primary">{{ $countKeranjang }} <i
                                            class="fas fa-shopping-cart"></i></span>
                                @endif
                            </a>
                        </li>
                        <li><a class="nav-link" href="/catatan">Catatan Pembelian</a></li>
                    @else
                        <li><a class="nav-link" href="/login">
                                Keranjang
                            </a>
                        </li>
                        <li><a class="nav-link" href="/login">Catatan Pembelian</a></li>
                    @endif
                    @if ($logged !== true)
                        <li><a class="nav-link" href="/login">Masuk</a></li>
                    @else
                        <li class="dropdown"><a href="#"><span><i class="fas fa-user"></i>
                                    {{ auth()->user()->username }}</span>
                                <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href="#">Profil</a></li>

                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i
                                            class="fas fa-logout"></i> Logout</button>
                                </form>
                            </ul>
                        </li>
                    @endif
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            @if ($logged !== true)
                <a href="/signup" class="appointment-btn scrollto">Buat akun
            @endif
            </a>

        </div>
    </header>


    @yield('content')

    <footer id="footer">
        <div class="container d-md-flex py-4">
            <div class="me-md-auto text-center text-md-start">
                <div class="copyright">
                    &copy; Hak Cipta <strong><span>Tenun Moko Alor {{ date('Y') }}</span></strong>.
                </div>
                <div class="credits">
                    <a href="/"><i class="ri-star-fill"></i> ESC <sup>17</sup></a>
                </div>
            </div>
            <div class="social-links text-center text-md-right pt-3 pt-md-0">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
        </div>
    </footer>

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script src="/user/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/user/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="/user/assets/vendor/php-email-form/validate.js"></script>
    <script src="/user/assets/vendor/purecounter/purecounter.js"></script>
    <script src="/user/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/user/assets/js/main.js"></script>
</body>

</html>
