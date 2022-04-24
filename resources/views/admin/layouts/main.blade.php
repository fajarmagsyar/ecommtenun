<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>{{ $page }}</title>
    <link href="/user/assets/img/favicon.ico" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="/admin/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="/admin/dashboard"><img src="/user/assets/img/logo.png" style="height: 30px"
                alt="">
            <span class="text-white" style="font-size: 15px"> - Admin Page</span></a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            {{-- <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div> --}}
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i> {{ auth()->user()->nama_customer }} </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                            data-bs-target="#ubahProfil">Pengaturan
                            Profil</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>

                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Halaman</div>
                        <a class="nav-link {{ $activeLink === 'dashboard' ? 'active' : '' }}" href="/admin/dashboard">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Beranda
                        </a>
                        <div class="sb-sidenav-menu-heading">Produk</div>
                        <a class="nav-link {{ $activeLink === 'produk' ? 'active' : '' }}" href="/admin/produk">
                            <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                            Produk
                        </a>
                        <a class="nav-link {{ $activeLink === 'kategori' ? 'active' : '' }}" href="/admin/kategori">
                            <div class="sb-nav-link-icon"><i class="fas fa-list-alt"></i></div>
                            Kategori
                        </a>
                        <div class="sb-sidenav-menu-heading">Customer</div>
                        <a class="nav-link {{ $activeLink === 'customer' ? 'active' : '' }}" href="/admin/customer">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Customer
                        </a>
                        <a class="nav-link {{ $activeLink === 'pembelian' ? 'active' : '' }}" href="/admin/pembelian">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                            Pembelian
                        </a>
                        <a class="nav-link {{ $activeLink === 'admin' ? 'active' : '' }}" href="/admin/admin">
                            <div class="sb-nav-link-icon"><i class="fas fa-lock"></i></div>
                            Admin
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Login sebagai:</div>
                    {{ auth()->user()->username }}
                </div>
            </nav>
        </div>
        @yield('content')

        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Hak Cipta {{ date('Y') }} &copy; Tenun Moko Alor</div>
                    <div>
                        <a href="#" style="text-decoration: none; color:rgb(76, 76, 76)">Facebook</a>
                        |
                        <a href="#" style="text-decoration: none; color:rgb(76, 76, 76)">Twitter</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    </div>

    {{-- MODAL PROFIL --}}
    <div class="modal fade" id="ubahProfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- FORM Pengisian --}}
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Customer</label>
                        <input type="text" class="form-control" name="nama_customer"
                            value="{{ auth()->user()->nama_customer }}" required disabled>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="{{ auth()->user()->alamat }}"
                            required disabled>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}"
                            required disabled>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username"
                            value="{{ auth()->user()->username }}" required disabled>
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="/admin/admin/" class="btn btn-primary">
                        Ubah Profil <i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <script>

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="/admin/js/scripts.js"></script>
    <script src="/admin/assets/demo/chart-area-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="/admin/js/datatables-simple-demo.js"></script>
</body>

</html>
