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
    <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors mt-5">
        <div class="container">



            <div class="row">
                <div class="col-sm-8 mx-auto">
                    <div class="card shadow" style="border: none">
                        <div class="card-body p-3">
                            <div class="section-title">
                                <h2>Checkout
                                </h2>
                            </div>
                            <div class="row">

                                <div class="col-sm-6 mx-auto">
                                    <center>
                                        <h6 class="mb-3"><b>Detail Barang</b></h6>
                                    </center>
                                    <div class="table-responsive">
                                        <table class="table">
                                            @php
                                                $jumlahHarga = 0;
                                            @endphp
                                            @foreach ($keranjangRows as $key => $r)
                                                <tr>
                                                    <td>{{ $r->nama_produk }}</td>
                                                    <td class="text-end">Rp. {{ number_format($r->harga) }}</td>
                                                </tr>
                                                @php
                                                    $jumlahHarga = $jumlahHarga + $r->harga;
                                                @endphp
                                            @endforeach
                                            <tr>
                                                <th class="text-end"><b>Jumlah Total</b></th>
                                                <th class="text-end">
                                                    Rp. {{ number_format($jumlahHarga) }}
                                                </th>
                                                <th></th>
                                            </tr>
                                        </table>
                                        <input type="hidden" id="hargaTotal" value="{{ $jumlahHarga }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <center>
                                        <h6 class="mb-3"><b>Kurir Pengiriman</b></h6>
                                    </center>
                                    <form action="/checkout/konfirmasiPembelian" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="kurir"><span class="text-danger">*</span> Kurir: </label>
                                            <select id="kurir" class="form-select kurir" name="kurir">
                                                <option value="" disabled selected>Pilih Kurir</option>
                                                <option value="jne" data-img="/user/assets/img/k1.jpg">JNE</option>
                                                <option value="tiki" data-img="/user/assets/img/k4.jpg">TIKI</option>
                                                <option value="pos" data-img="/user/assets/img/k3.jpg">POS</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="provinsi"><span class="text-danger">*</span> Provinsi Tujuan:
                                            </label>
                                            <select id="provinsi" class="form-select kurir" name="provinsi">
                                                <option value="" disabled selected>Pilih Provinsi</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="provinsi"><span class="text-danger">*</span> Kota Tujuan:
                                            </label>
                                            <select id="city" class="form-select kurir" name="kota">
                                                <option value="" disabled selected>Pilih Kota</option>
                                            </select>
                                        </div>

                                        <div class="mb-3 ongkir-checkbox">
                                            <label for="provinsi">Pilih Kurir Pengiriman: </label> <br>
                                            <span class="ongkirDef text-danger small">*Silahkan lengkapi opsi diatas
                                                terlebih
                                                dahulu!</span>
                                            {{-- <input type="checkbox" name="ongkir" value=""> <img
                                                src="/user/assets/img/k1.jpg" height="30px" alt=""> (Rp20.000/Estimasi: 2-4
                                            Hari) <br> --}}
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <center>
                                            <h6 class="mb-3 mt-3"><b>Pembayaran</b></h6>
                                        </center>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="card shadow" style="border: none">
                                                    <div class="card-body p-4">
                                                        <center>
                                                            <img src="/user/assets/img/rek1.png" width="140px" alt=""
                                                                class="mb-2">
                                                            <br>
                                                            <h5 style="font-family: Arial, Helvetica, sans-serif">
                                                                5032147882312324</h5>
                                                            (AN. GUNUNG MAKO)
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="card shadow" style="border: none">
                                                    <div class="card-body p-4">
                                                        <center>
                                                            <img src="/user/assets/img/rek2.png" width="100px" alt=""
                                                                class="mb-2">
                                                            <br>
                                                            <h5 style="font-family: Arial, Helvetica, sans-serif">
                                                                5032147882312324</h5>
                                                            (AN. GUNUNG MAKO)
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mt-4">
                                                <div class="card shadow" style="border: none">
                                                    <div class="card-body p-4">
                                                        <center>
                                                            <span style="font-size: 30px"><i
                                                                    class="fas fa-stopwatch"></i></span>
                                                            <br>
                                                            <p class="card-text alert alert-warning">Segera lakukan
                                                                pembayaran pada salah
                                                                satu rekening diatas lalu upload bukti pembayaran dengan
                                                                nominal: </p>
                                                            <br>
                                                            <b>NOMINAL:</b>
                                                            <h1 id="nominal" class="alert alert-info">
                                                                <span class="text-muted" style="font-size: 14px"> <i
                                                                        class="fas fa-exclamation-triangle"></i> Lengkapi
                                                                    informasi diatas untuk
                                                                    melanjutkan!</span>
                                                            </h1>
                                                        </center>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <label for="" class="mb-2">Upload Bukti
                                                                    pembayaran:</label>
                                                                <input type="file" name="bukti" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end mt-4">
                                    <button class="btn btn-primary px-3" type="submit"
                                        style="border-radius: 20px">Konfirmasi
                                        Pembelian
                                        <i class="fas fa-shopping-cart"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Doctors Section -->

    </main><!-- End #main -->
    <script>
        $('document').ready(function() {
            $.ajax({
                url: "/api/provinsiGet",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    let provinsiAll = res;
                    // console.log(provinsiAll.rajaongkir.results);
                    for (const r in provinsiAll.rajaongkir.results) {
                        // console.log(provinsiAll.rajaongkir.results[r]['province']);
                        $('#provinsi').append($('<option>').val(provinsiAll.rajaongkir.results[r][
                                'province_id'
                            ])
                            .text(
                                provinsiAll.rajaongkir.results[r]['province']));
                    }
                }
            });
            $('#provinsi').on('change', function() {
                // alert($('#provinsi').val());
                $.ajax({
                    url: "/api/kotaGet/" + $('#provinsi').val(),
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        let kotaAll = res;
                        // console.log(kotaAll.rajaongkir.results);
                        $('#city').empty();
                        for (const r in kotaAll.rajaongkir.results) {
                            // console.log(kotaAll.rajaongkir.results[r]['city_name']);
                            $('#city').append($('<option>').val(kotaAll.rajaongkir.results[r][
                                    'city_id'
                                ])
                                .text(kotaAll.rajaongkir.results[r]['city_name'] + " <" +
                                    kotaAll
                                    .rajaongkir.results[r]['postal_code'] + "> "));
                        }
                    }
                });
            })
            $('.kurir').on('change', function() {
                $('.kurir-check').remove();
                $.ajax({
                    url: "/api/costGet/213/" + $('#city').val() + "/" + $('#kurir').val(),
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        if ($('#kurir').val() !== null && $('provinsi').val() !== null && $(
                                'city').val() !== null) {
                            $('.ongkirDef').remove();
                            let cost = res;
                            // console.log(cost.rajaongkir.results);
                            // $('#ongkir').val = cost.rajaongkir[0]['costs'][0]['cost'];
                            const kurir = cost.rajaongkir.results[0]['costs'];
                            for (const r in kurir) {

                                function nominal(param) {
                                    alert(param);
                                    // (Number(document.getElementById('hargaTotal').value) +
                                    //     Number(kurir[r]['cost'][0]['value']))
                                }

                                let kurirSelect = document.getElementById('kurir')
                                let img = kurirSelect.options[kurirSelect.selectedIndex]
                                    .getAttribute('data-img');
                                let price = kurir[r];
                                // console.log(price);
                                $('.ongkir-checkbox').append(
                                    "<input type='radio' class='kurir-check' name='ongkir' onclick='document.getElementById(`nominal`).innerHTML = `Rp. " +
                                (Number(document.getElementById('hargaTotal').value) +
                                    Number(kurir[r]['cost'][0]['value'])) +
                                ",-`' value='" +
                                    kurir[r]['cost'][0]['value'] +
                                    "'> <img class='kurir-check' src='" + img +
                                    "' height = '30px' alt = '' > <span class='kurir-check'>" +
                                    kurir[r]['service'] + " (Rp. " +
                                    kurir[r]['cost'][0]['value'] + " / Estimasi: " +
                                    kurir[r]['cost'][0]['etd'] +
                                    " Hari)</span> <br class='kurir-check' />"
                                )
                            }

                        } else {

                        }
                    }
                });
            });
        });
    </script>
@endsection
