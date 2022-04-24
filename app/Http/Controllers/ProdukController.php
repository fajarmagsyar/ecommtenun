<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PDF;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.produk', [
            'activeLink' => 'produk',
            'page' => 'Gunung Mako Tenun | Data Produk',
            'produkRows' => Produk::select(['produk.*', 'kategori.nama_kategori'])
                ->orderBy('nama_produk', 'asc')
                ->join('kategori', 'kategori.kategori_id', '=', 'produk.kategori_id')
                ->get(),
            'kategoriRows' => Kategori::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $temp = $request->file('gambar')->getPathName();
        $file = "PRODUK - " . date('Ymdhsi') . "." . $request->file('gambar')->extension();

        $folder = "upload/produk/" . $file;
        move_uploaded_file($temp, $folder);

        $data = [
            'kategori_id' => $request->input('kategori'),
            'nama_produk' => $request->input('nama_produk'),
            'harga' => $request->input('harga'),
            'deskripsi' => $request->input('deskripsi'),
            'stok' => $request->input('stok'),
            'gambar' => $folder,
        ];

        Produk::create($data);

        return redirect('/admin/produk')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id)->first();
        $file = $produk->gambar;

        if ($request->input('checkImg')) {
            $temp = $request->file('gambar')->getPathName();
            $file = "PRODUK - " . date('Ymdhsi') . "." . $request->file('gambar')->extension();

            $folder = "upload/produk/" . $file;
            move_uploaded_file($temp, $folder);
        }

        $data = [
            'kategori_id' => $request->input('kategori'),
            'nama_produk' => $request->input('nama_produk'),
            'harga' => $request->input('harga'),
            'deskripsi' => $request->input('deskripsi'),
            'stok' => $request->input('stok'),
            'gambar' => $file,
        ];

        Produk::find($id)->update($data);

        return redirect('/admin/produk')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::find($id)->first();
        Produk::find($id)->delete();
        unlink('upload/produk/' . $produk->gambar);
        return redirect('/admin/produk')->with('success', 'Data berhasil dihapus!');
    }

    public function produkPdf()
    {
        $rows = Produk::get();
        $pdf = PDF::loadView('admin.pdf.produk', ['rows' => $rows])->setPaper('a4', 'landscape');

        return $pdf->download(date("Y-m-d H:m:s") . 'Produk.pdf');
    }
}
