<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.kategori', [
            'activeLink' => 'kategori',
            'page' => 'Gunung Mako Tenun | Data Kategori,',
            'kategoriRows' => Kategori::orderBy('nama_kategori', 'asc')
                ->get(),
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
        $file = "KATEGORI - " . date('Ymdhsi') . "." . $request->file('gambar')->extension();

        $folder = "upload/kategori/" . $file;
        move_uploaded_file($temp, $folder);

        $data = [
            'nama_kategori' => $request->input('nama_kategori'),
            'gambar' => $folder,
        ];

        Kategori::create($data);

        return redirect('/admin/kategori')->with('success', 'Data berhasil ditambahkan!');
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
        $kategori = Kategori::where('kategori_id', $id)->first();
        $folder = $kategori->gambar;

        // dd($kategori);
        if ($request->input('checkImg')) {
            $temp = $request->file('gambar')->getPathName();
            $file = "KATEGORI - " . date('Ymdhsi') . "." . $request->file('gambar')->extension();

            $folder = "upload/produk/" . $file;
            move_uploaded_file($temp, $folder);
        }

        $data = [
            'nama_kategori' => $request->input('nama_kategori'),
            'gambar' => $folder,
        ];


        Kategori::find($id)->update($data);

        return redirect('/admin/kategori')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::where('kategori_id', $id)->first();
        Kategori::find($id)->delete();
        unlink($kategori->gambar);
        return redirect('/admin/kategori')->with('success', 'Data berhasil dihapus!');
    }
}
