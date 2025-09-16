<?php

namespace Database\Seeders;

use App\Models\Book;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Anggota;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
        ]);

        Book::create([
            'judul' => 'Pemrograman Web',
            'penulis' => 'Budi',
            'jumlah_eksemplar' => 10,
            'penerbit' => 'Ilham',
            'tahun' => 2024,
            'kategori' => 'lainnya',
            'tgl_masuk' => now(),
            'induk' => 150735
        ]);

        Anggota::create([
            'nama' => 'Asep',
            'alamat' => 'Pekanbaru',
            'no_telp' => '08123456789',
        ], [
            'nama' => 'Ujang',
            'alamat' => 'Kopo',
            'no_telp' => '08123456789',
        ]);
    }
}
