<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admin', [
            'activeLink' => 'admin',
            'page' => 'TMA | Data Admin,',
            'customerRows' => Customer::orderBy('nama_customer', 'asc')
                ->where('role', 1)
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
        $data = [
            'nama_customer' => $request->input('nama_customer'),
            'alamat' => $request->input('alamat'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'role' => 1,
            'password' => Hash::make($request->input('password')),
        ];

        Customer::create($data);

        return redirect('/admin/admin')->with('success', 'Data berhasil ditambahkan!');
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
        $data = [
            'nama_customer' => $request->input('nama_customer'),
            'alamat' => $request->input('alamat'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
        ];

        Customer::find($id)->update($data);

        return redirect('/admin/admin')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Customer::find($id)->delete();
        return redirect('/admin/admin')->with('success', 'Data berhasil dihapus!');
    }
}
