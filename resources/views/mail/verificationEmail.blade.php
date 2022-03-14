@component('mail::message')
    <i>Pesan otomatis, jangan dibalas.</i><br /><br />
    Halo {{ $data['nama_customer'] }}, <br />
    Terima kasih karena telah mendaftar di website Gunung Mako Mama Syariat, dengan ini anda telah mendukung kelestarian
    budaya tenun di Nusa Tenggara Timur.
    <br />
    <br />
    Berikut adalah no verifikasi anda <br />
    <h1>{{ $data['token_otp'] }}</h1>
    <br />
    <br />
    <i>By Gunung Mako Mama Syariat</i>
@endcomponent
