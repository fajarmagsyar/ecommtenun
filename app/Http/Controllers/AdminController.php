<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    function index()
    {
        return view('admin.beranda', [
            'activeLink' => 'dashboard',
            'page' => 'TMA | Admin,'
        ]);
    }
    function pembelian()
    {
        return view('admin.pembelian', [
            'activeLink' => 'pembelian',
            'page' => 'TMA | Admin,',
            'checkoutRows' => Checkout::select(['customer.nama_customer', 'checkout.*'])->join('customer', 'customer.customer_id', '=', 'checkout.customer_id')->get(),
            'keranjangRows' => Checkout::join('pemesanan', 'checkout.checkout_id', '=', 'pemesanan.checkout_id')
                ->join('produk', 'produk.produk_id', '=', 'pemesanan.produk_id')
                ->get(),
        ]);
    }
    function deletePembelian(Request $request)
    {
        Checkout::where('checkout_id', $request->input('checkout_id'))->delete();
        return redirect('/admin/pembelian')->with('success', 'Pemesanan tersebut berhasil ditolak');
    }
    function updateResi(Request $request)
    {
        Checkout::where('checkout_id', $request->input('checkout_id'))->update(['no_resi' => $request->input('no_resi')]);
        return redirect('/admin/pembelian')->with('success', 'Resi berhasil ditambahkan');
    }
}
