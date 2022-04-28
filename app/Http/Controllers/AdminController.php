<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

use App\Mail\resiTerbit;
use App\Mail\pesananTolakMail;
use App\Models\Pemesanan;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    function index()
    {
        $jumlahPesanan = DB::select("SELECT COUNT(checkout_id) AS jumlah, MONTH(created_at) AS bulan FROM checkout GROUP BY MONTH(created_at)");
        $jumlahPesananTahunan = [];
        for ($i = 1; $i <= 11; $i++) {
            for ($j = 0; $j <= 11; $j++) {
                if (array_key_exists($j, $jumlahPesanan)) {
                    if ($jumlahPesanan[$j]->bulan == $i) {
                        array_push($jumlahPesananTahunan, $jumlahPesanan[$j]->jumlah);
                    }
                }
            }
            array_push($jumlahPesananTahunan, 0);
        }
        return view('admin.beranda', [
            'activeLink' => 'dashboard',
            'page' => 'Gunung Mako Tenun | Dashboard',
            'jumlahTahunan' => $jumlahPesananTahunan,
            'pesananTerbaru' => Checkout::select(['customer.nama_customer', 'customer.email', 'customer.alamat', 'checkout.*'])->join('customer', 'customer.customer_id', '=', 'checkout.customer_id')->get(),
            'keranjangRows' => Checkout::join('pemesanan', 'checkout.checkout_id', '=', 'pemesanan.checkout_id')
                ->join('produk', 'produk.produk_id', '=', 'pemesanan.produk_id')
                ->get(),
        ]);
    }
    function pembelian()
    {
        return view('admin.pembelian', [
            'activeLink' => 'pembelian',
            'page' => 'Gunung Mako Tenun | Pembelian',
            'checkoutRows' => Checkout::select(['customer.nama_customer', 'customer.email', 'customer.alamat', 'checkout.*'])
                ->join('customer', 'customer.customer_id', '=', 'checkout.customer_id')
                ->get(),
            'keranjangRows' => Checkout::join('pemesanan', 'checkout.checkout_id', '=', 'pemesanan.checkout_id')
                ->join('produk', 'produk.produk_id', '=', 'pemesanan.produk_id')
                ->get(),
        ]);
    }
    function deletePembelian(Request $request)
    {
        Checkout::where('checkout_id', $request->input('checkout_id'))->update(['no_resi' => 'Ditolak oleh admin']);
        Mail::to($request->input('email'))->send(new pesananTolakMail());
        return redirect('/admin/pembelian')->with('success', 'Pemesanan tersebut berhasil ditolak');
    }
    function updateResi(Request $request)
    {
        Checkout::where('checkout_id', $request->input('checkout_id'))->update(['no_resi' => $request->input('no_resi')]);
        $data = [
            'no_resi' => $request->input('no_resi'),
            'email' => $request->input('email'),
        ];
        Mail::to($request->input('email'))->send(new resiTerbit($data));
        return redirect('/admin/pembelian')->with('success', 'Resi berhasil ditambahkan');
    }
    function pembelianPdf($jenis)
    {
        switch ($jenis) {
            case 'harian':
                $rows = Checkout::select(['customer.nama_customer', 'customer.email', 'customer.alamat', 'checkout.*'])
                    ->join('customer', 'customer.customer_id', '=', 'checkout.customer_id')
                    ->whereDate('checkout.created_at', Carbon::today())
                    ->get();

                $keranjangRows = Checkout::join('pemesanan', 'checkout.checkout_id', '=', 'pemesanan.checkout_id')
                    ->join('produk', 'produk.produk_id', '=', 'pemesanan.produk_id')
                    ->whereDate('checkout.created_at', Carbon::today())
                    ->get();
                break;
            case 'minggu':
                $rows = Checkout::select(['customer.nama_customer', 'customer.email', 'customer.alamat', 'checkout.*'])
                    ->join('customer', 'customer.customer_id', '=', 'checkout.customer_id')
                    ->whereBetween('checkout.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->get();
                $keranjangRows = Checkout::join('pemesanan', 'checkout.checkout_id', '=', 'pemesanan.checkout_id')
                    ->join('produk', 'produk.produk_id', '=', 'pemesanan.produk_id')
                    ->whereBetween('checkout.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->get();
                break;
            case 'bulan':
                $rows = Checkout::select(['customer.nama_customer', 'customer.email', 'customer.alamat', 'checkout.*'])
                    ->join('customer', 'customer.customer_id', '=', 'checkout.customer_id')
                    ->whereMonth('checkout.created_at', Carbon::now()->month)
                    ->get();
                $keranjangRows = Checkout::join('pemesanan', 'checkout.checkout_id', '=', 'pemesanan.checkout_id')
                    ->join('produk', 'produk.produk_id', '=', 'pemesanan.produk_id')
                    ->whereMonth('checkout.created_at', Carbon::now()->month)
                    ->get();
                break;
            case 'tahun':
                $rows = Checkout::select(['customer.nama_customer', 'customer.email', 'customer.alamat', 'checkout.*'])
                    ->join('customer', 'customer.customer_id', '=', 'checkout.customer_id')
                    ->whereYear('checkout.created_at', Carbon::now()->year)
                    ->get();
                $keranjangRows = Checkout::join('pemesanan', 'checkout.checkout_id', '=', 'pemesanan.checkout_id')
                    ->join('produk', 'produk.produk_id', '=', 'pemesanan.produk_id')
                    ->whereYear('checkout.created_at', Carbon::now()->year)
                    ->get();
                break;
            default:
                $keranjangRows = Checkout::join('pemesanan', 'checkout.checkout_id', '=', 'pemesanan.checkout_id')
                    ->join('produk', 'produk.produk_id', '=', 'pemesanan.produk_id')
                    ->get();
                break;
        }

        $pdf = PDF::loadView('admin.pdf.pembelian', ['rows' => $rows, 'keranjangRows' => $keranjangRows])->setPaper('a4', 'landscape');

        return $pdf->download(date("Y-m-d H:m:s") . '_Pembelian.pdf');
    }
}
