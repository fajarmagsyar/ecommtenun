<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Tenun Moko Alor</title>
</head>
<link href="/user/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


<body>
    <section class="vh-100" style="background-color: #9A616D;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="/upload/kategori/sarung.jpg" alt="login form" class="img-fluid"
                                    style="border-radius: 1rem 0 0 1rem; height: 100%" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form action="/login" method="post">
                                        @csrf
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                            <span class="h1 fw-bold mb-4 mx-auto"><img src="/user/assets/img/logo.png"
                                                    width="200px" alt=""></span>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <input type="email" id="form2Example17" class="form-control form-control-lg"
                                                name="email" />
                                            <label class="form-label" for="form2Example17">Email address</label>
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
                                            <button class="btn btn-dark btn-lg btn-block" type="submit">Sign In</button>
                                        </div>

                                        <a class="small text-muted" href="#!">Lupa password?</a>
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Belum punya akun? <a href="#!"
                                                style="color: #393f81;">Daftar sekarang</a></p>

                                    </form>

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
