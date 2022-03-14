@extends('user.layouts.main')
@section('content')
    <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors mt-5">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 mx-auto">
                    <div class="member">
                        <center>
                            <div class="section-title mx-auto">
                                <h2>
                                    Buat akun
                                </h2>
                            </div>
                        </center>
                        <div>
                            <form action="/signup/" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                                    <input type="text" name="nama_customer" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" required>
                                    <div id="emailHelp" class="form-text">Kami tidak akan membagikan email yang
                                        anda berikan.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Alamat</label>
                                    <textarea name="alamat" id="" class="form-control" rows="3" required></textarea>
                                    <div id="emailHelp" class="form-text">Masukkan alamat lengkap,
                                        alamat akan digunakan sebagai lokasi pengiriman.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" maxlength="12" required>
                                    <div id="emailHelp" class="form-text">Username maksimal 12 karakter.</div>
                                </div>

                                <div class="mb-5">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                        required>
                                </div>

                                <div class="text-end">
                                    <button type="submit"
                                        style="border-radius: 50px; opacity: 0.9; background-color:#1977cc; color:white"
                                        class="btn px-4">Buat
                                        akun</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Doctors Section -->

    </main><!-- End #main -->
@endsection
