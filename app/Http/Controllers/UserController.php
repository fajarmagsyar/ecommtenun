<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;

use App\Mail\verificationEmail;
use App\Mail\pemesananKonfirmasi;
use App\Mail\pesananKonfirmasi;
use App\Models\Checkout;
use App\Models\Pemesanan;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->countKeranjang = null;
            if (Auth::check() == true) {
                $this->countKeranjang = Pemesanan::where('customer_id', auth()->user()->customer_id)->where('checkout_id', null)->count();
            }
            return $next($request);
        });
    }
    function index()
    {
        return view('user.beranda', [
            'kategoriRows' => Kategori::get(),
            'produkRows' => Produk::select(['produk.*', 'kategori.nama_kategori'])
                ->join('kategori', 'kategori.kategori_id', '=', 'produk.kategori_id')
                ->get(),
            'logged' => auth::check(),
            'countKeranjang' => $this->countKeranjang,
        ]);
    }
    function login()
    {
        return view('admin.login');
    }
    function signUp()
    {
        return view('user.signUp', [
            'kategoriRows' => Kategori::get(),
            'logged' => auth::check(),
            'countKeranjang' => $this->countKeranjang,
        ]);
    }
    function signUpStore(Request $request)
    {
        $data = [
            'nama_customer' => $request->input('nama_customer'),
            'alamat' => $request->input('alamat'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'role' => 0,
            'status' => 0,
            'token_otp' => strtoupper(Str::random(6)),
            'password' => Hash::make($request->input('password')),
        ];
        $customer = Customer::create($data)->getAttributes();

        Mail::to($request->input('email'))->send(new verificationEmail($data));

        return redirect('/signup/emailverification/' . $customer['customer_id'])->with('success', 'Akun berhasil didaftarkan, silahkan isi token verifikasi!');
    }
    function signUpVerification($id)
    {
        return view('user.emailVerification', [
            'kategoriRows' => Kategori::get(),
            'customer_id' => $id,
            'countKeranjang' => $this->countKeranjang,
            'logged' => auth::check(),
        ]);
    }
    function signUpVerificationStore(Request $request)
    {
        $customer = Customer::where('customer_id', $request->input('customer_id'))->first();
        $token = implode('', $request->input('verif'));
        // dd($token);
        if ($token == $customer['token_otp']) {
            Customer::where('customer_id', $request->input('customer_id'))->update(['status' => 1]);
            return redirect('/login')->with('success', 'Token berhasil diverifikasi');
        } else {
            return redirect('/signup/emailverification/' . $request->input('customer_id'))->with('error', 'Token salah silahkan periksa kembali token yang anda masukkan.');
        }
    }
    function kategori($param)
    {
        return view('user.produk', [
            'kategoriRows' => Kategori::get(),
            'produkRows' => Produk::select(['produk.*', 'kategori.nama_kategori'])
                ->join('kategori', 'kategori.kategori_id', '=', 'produk.kategori_id')
                ->where('kategori.nama_kategori', $param)
                ->get(),
            'kategori' => $param,
            'countKeranjang' => $this->countKeranjang,
            'logged' => auth::check(),
        ]);
    }
    function produkDetail($param)
    {
        return view('user.produkDetail', [
            'kategoriRows' => Kategori::get(),
            'produkRow' => Produk::select(['produk.*', 'kategori.nama_kategori'])
                ->join('kategori', 'kategori.kategori_id', '=', 'produk.kategori_id')
                ->where('produk.produk_id', $param)
                ->first(),
            'logged' => auth::check(),
            'countKeranjang' => $this->countKeranjang,
        ]);
    }
    function addToCart($param)
    {
        $data = [
            'customer_id' => auth()->user()->customer_id,
            'produk_id' => $param,
            'checkout_id' => null,
            'jumlah' => 1,
            'status' => 0,
        ];
        Pemesanan::create($data);
        return redirect('/produk/' . $param)->with('success', 'Item berhasil ditambahkan');
    }
    function keranjang()
    {
        if ($this->countKeranjang == null) {
            return redirect('/')->with('error', 'Keranjang Kosong, silahkan masukkan produk pada keranjang terlebih dahulu');
        }
        return view('user.keranjang', [
            'kategoriRows' => Kategori::get(),
            'keranjangRows' => Pemesanan::join('produk', 'produk.produk_id', '=', 'pemesanan.produk_id')->where('pemesanan.customer_id', auth()->user()->customer_id)->where('checkout_id', null)->get(),
            'logged' => auth::check(),
            'countKeranjang' => $this->countKeranjang,
        ]);
    }
    function keranjangItemHapus(Request $request)
    {
        Pemesanan::find($request->input('pemesanan_id'))->delete();
        return redirect('/keranjang')->with('success', 'Item berhasil dihapus');
    }

    function checkout()
    {
        if ($this->countKeranjang == null) {
            return redirect('/keranjang');
        }
        return view('user.checkout', [
            'kategoriRows' => Kategori::get(),
            'keranjangRows' => Pemesanan::join('produk', 'produk.produk_id', '=', 'pemesanan.produk_id')->where('pemesanan.checkout_id', null)->where('pemesanan.customer_id', auth()->user()->customer_id)->get(),
            'logged' => auth::check(),
            'countKeranjang' => $this->countKeranjang,
        ]);
    }
    function checkoutKonfirmasi(Request $request)
    {
        $temp = $request->file('bukti')->getPathName();
        $file = "bukti - " . date('Ymdhsi') . '-' . Str::random(6) . "." . $request->file('bukti')->extension();

        $folder = "upload/bukti/" . $file;
        move_uploaded_file($temp, $folder);

        $data = [
            'kurir' => $request->input('kurir'),
            'customer_id' => auth()->user()->customer_id,
            'status' => 'Menunggu pembayaran',
            'bukti_pembayaran' => $folder,
            'ongkir' => $request->input('ongkir'),
        ];
        // dd($data);
        $checkout = Checkout::create($data)->getAttributes();

        Pemesanan::where('pemesanan.customer_id', auth()->user()->customer_id)->where('pemesanan.checkout_id', null)->update(['checkout_id' => $checkout['checkout_id']]);

        Mail::to(auth()->user()->email)->send(new pesananKonfirmasi($data));

        return redirect('/')->with('success', 'Pesanan anda berhasil diproses, silahkan tunggu konfirmasi dari admin!');
    }
    function provinsiGet()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: a4b48b8f647f7d7509ebb3536fd48843"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }
    function kotaGet($param)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $param,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: a4b48b8f647f7d7509ebb3536fd48843"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }
    function costGet($asal, $tujuan, $kurir)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=" . $asal . "&destination=" . $tujuan . "&weight=1000&courier=" . $kurir,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: a4b48b8f647f7d7509ebb3536fd48843"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }
    function catatanPembelian()
    {
        return view('user.catatanPembelian', [
            'kategoriRows' => Kategori::get(),
            'checkoutRows' => Checkout::where('customer_id', auth()->user()->customer_id)->get(),
            'keranjangRows' => Checkout::join('pemesanan', 'checkout.checkout_id', '=', 'pemesanan.checkout_id')
                ->join('produk', 'produk.produk_id', '=', 'pemesanan.produk_id')
                ->where('pemesanan.customer_id', auth()->user()->customer_id)
                ->get(),
            'logged' => auth::check(),
            'countKeranjang' => $this->countKeranjang,
        ]);
    }
}
