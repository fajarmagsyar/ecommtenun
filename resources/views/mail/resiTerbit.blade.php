@component('mail::message')
    <i>Pesan otomatis, jangan dibalas.</i><br /><br />
    Terima kasih karena telah mempercayakan kami dalam kegiatan belanja tenun anda, nomor resi pesanan anda telah terbit.
    <br />
    <h1>{{ $data['no_resi'] }}</h1>
    <br />
    <br />
    <i>By Gunung Mako Mama Syariat</i>
@endcomponent
