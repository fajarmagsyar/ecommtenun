<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Tenun Moko Alor</title>
    <link href="/user/assets/img/favicon.ico" rel="icon">
</head>
<link href="/user/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://kit.fontawesome.com/af029991ac.js" crossorigin="anonymous"></script>

<body>

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
    <section class="vh-100" style="background-color: #fff;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-5">
                    <div class="card shadow" style="border-radius: 1rem; border: none">
                        <div class="row g-0">
                            <div class="col-md-12 col-lg-12 d-flex align-items-center">
                                <div class="card-body p-5 p-lg-5 text-black" style="border: none">
                                    <form action="/login" method="post">
                                        @csrf
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <span class="h3 fw-bold mb-4 mx-auto">
                                                <center>
                                                    <img src="/user/assets/img/logo.png" width="100px" alt=""
                                                        class="mb-3"> <br>
                                                    Login | <span class="text-muted">Gunung Mako</span>
                                                </center>
                                            </span>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <input type="email" id="form2Example17" class="form-control form-control-lg"
                                                name="email" />
                                            <label class="form-label" for="form2Example17">Email</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="form2Example27"
                                                class="form-control form-control-lg" name="password" />
                                            <label class="form-label" for="form2Example27">Password <br>
                                                @if (session()->has('error'))
                                                    <span class="text-danger">Email atau password salah, silahkan
                                                        coba
                                                        lagi!</span>
                                                @endif
                                            </label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-lg btn-block" type="submit"
                                                style="background-color: #1977cc; color: white; border-radius: 30px">Sign
                                                In</button>
                                        </div>

                                        <a class="small text-muted" href="#!">Lupa password?</a>
                                        <p class="mb-2 pb-lg-2" style="color: #393f81;">Belum punya akun? <a
                                                href="/signup" style="color: #393f81;">Daftar sekarang</a></p>

                                    </form>

                                    <hr>
                                    <center>
                                        <span class="text-muted d-block mb-3">
                                            - Masuk sebagai -
                                        </span>
                                    </center>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <a href="/login/facebook" class="btn"
                                                style="border-radius:20px; color: white; width: 100%; background-color:#ab12a1">
                                                <i class="fab fa-instagram"></i>
                                                Instagram</a>
                                        </div>
                                        <div class="col-sm-4">
                                            <a href="/login/google" class="btn"
                                                style="border-radius:20px; color: white; width: 100%; background-color:#bd3838">
                                                <i class="fab fa-google"></i> Google
                                            </a>
                                        </div>
                                        <div class="col-sm-4">
                                            <a href="/login/facebook" class="btn"
                                                style="border-radius:20px; color: white; width: 100%; background-color:#1263ab">
                                                <i class="fab fa-facebook-square"></i>
                                                Facebook</a>
                                        </div>
                                    </div>
                                    <br>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
