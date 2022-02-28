<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class UserController extends Controller
{
    function index()
    {
        return view('user.beranda', [
            'kategoriRows' => Kategori::get(),
        ]);
    }
    function login()
    {
        return view('admin.login');
    }
}
