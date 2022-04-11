<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Kategori::create([
            'nama_kategori' => 'Selempang',
            'gambar' => '/upload/kategori/selempang.jpg'
        ]);
        Kategori::create([
            'nama_kategori' => 'Sarung',
            'gambar' => '/upload/kategori/sarung.jpg'
        ]);
        Kategori::create([
            'nama_kategori' => 'Aksesoris',
            'gambar' => '/upload/kategori/aksesoris.jpg'
        ]);
        Customer::create([
            'nama_customer' => 'Admin',
            'alamat' => 'Jln. Manafe, Kelurahan Kayu Putih',
            'email' => 'admin@mail.com',
            'username' => 'user',
            'password' => Hash::make('admin'),
            'role' => 1,
        ]);
        Customer::create([
            'nama_customer' => 'User',
            'alamat' => 'Jln. Manafe, Kelurahan Kayu Putih',
            'email' => 'user@mail.com',
            'username' => 'admin',
            'password' => Hash::make('user'),
            'role' => 0,
        ]);
    }
}
