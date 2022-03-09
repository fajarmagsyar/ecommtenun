<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function index()
    {
        return view('user.beranda', [
            'kategoriRows' => Kategori::get(),
            'produkRows' => Produk::select(['produk.*', 'kategori.nama_kategori'])
                ->join('kategori', 'kategori.kategori_id', '=', 'produk.kategori_id')
                ->get(),
        ]);
    }
    function login()
    {
        return view('admin.login');
    }
    function signUp()
    {
        return view('user.signUp', [
            'kategoriRows' => Kategori::get()
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
            'status' => 1,
            'password' => Hash::make($request->input('password')),
        ];
        Customer::create($data);

        return redirect('/admin/customer')->with('success', 'Data berhasil ditambahkan!');
    }
    function signUpVerification()
    {
        return view('user.emailVerification', [
            'kategoriRows' => Kategori::get()
        ]);
    }
    function kategori($param)
    {
        return view('user.produk', [
            'kategoriRows' => Kategori::get(),
            'produkRows' => Produk::select(['produk.*', 'kategori.nama_kategori'])
                ->join('kategori', 'kategori.kategori_id', '=', 'produk.kategori_id')
                ->where('kategori.nama_kategori', $param)
                ->get(),
            'kategori' => $param
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
        ]);
    }
}
