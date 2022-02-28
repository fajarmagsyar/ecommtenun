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
</head>

<body>
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <span class="logo me-auto"><a href="/"><img src="/user/assets/img/logo.png" height="100%" alt="">
                </a></span>

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
                    <li><a class="nav-link" href="/keranjang">Keranjang</a></li>
                    <li><a class="nav-link" href="/catatan">Catatan Pembelian</a></li>
                    <li><a class="nav-link" href="/login">Masuk</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>

            <a href="" class="appointment-btn scrollto">Buat akun
            </a>

        </div>
    </header>


    @yield('content')

    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>Medilab</h3>
                        <p>
                            A108 Adam Street <br>
                            New York, NY 535022<br>
                            United States <br><br>
                            <strong>Phone:</strong> +1 5589 55488 55<br>
                            <strong>Email:</strong> info@example.com<br>
                        </p>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4>Join Our Newsletter</h4>
                        <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                        <form action="" method="post">
                            <input type="email" name="email"><input type="submit" value="Subscribe">
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="container d-md-flex py-4">
            <div class="me-md-auto text-center text-md-start">
                <div class="copyright">
                    &copy; Copyright <strong><span>Medilab</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
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
