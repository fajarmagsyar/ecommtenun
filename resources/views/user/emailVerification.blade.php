@extends('user.layouts.main')
@section('content')
    <style>
        ::-webkit-input-placeholder {
            text-align: center;
        }

        :-moz-placeholder {
            /* Firefox 18- */
            text-align: center;
        }

        ::-moz-placeholder {
            /* Firefox 19+ */
            text-align: center;
        }

        :-ms-input-placeholder {
            text-align: center;
        }

    </style>
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
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="member">
                        <center>
                            <div class="section-title mx-auto">
                                <h2>
                                    Masukkan Kode Verifikasi
                                </h2>
                            </div>
                        </center>
                        <div>
                            <form action="/signup/emailverification" method="post">
                                @csrf
                                <input type="hidden" value="{{ $customer_id }}" name="customer_id">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-4">Kode verifikasi dikirimkan ke
                                        <strong>meyer.willm@gmail.com</strong>:</label>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <input style="height: 60px" type="text" name="verif[]" class="form-control"
                                                id="verif1" aria- placeholder="*" required>
                                        </div>
                                        <div class="col-sm-2">
                                            <input style="height: 60px" type="text" name="verif[]" class="form-control"
                                                id="verif2" aria- required placeholder="*">
                                        </div>
                                        <div class="col-sm-2">
                                            <input style="height: 60px" type="text" name="verif[]" class="form-control"
                                                id="verif3" aria- required placeholder="*">
                                        </div>
                                        <div class="col-sm-2">
                                            <input style="height: 60px" type="text" name="verif[]" class="form-control"
                                                id="verif4" aria- required placeholder="*">
                                        </div>
                                        <div class="col-sm-2">
                                            <input style="height: 60px" type="text" name="verif[]" class="form-control"
                                                id="verif5" aria- required placeholder="*">
                                        </div>
                                        <div class="col-sm-2">
                                            <input style="height: 60px" type="text" name="verif[]" class="form-control"
                                                id="verif6" aria- required placeholder="*">
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <a style="border-radius: 50px; opacity: 0.9; color:red; font-size: 12px"
                                        class="mr-5" href="/login">
                                        <u>
                                            Lewati sementara
                                        </u>
                                    </a>
                                    &nbsp;&nbsp;
                                    <button type="submit"
                                        style="border-radius: 50px; opacity: 0.9; background-color:#1977cc; color:white"
                                        class="btn px-4">Lanjutkan <i class="fas fa-chevron-right"></i>
                                    </button>
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
