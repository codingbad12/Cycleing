<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profil;
use Illuminate\Support\Facades\Hash;

class admin_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'email' => 'admin@nautica.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        Profil::create([
            'userid' => $admin->id,
            'nama' => 'Administrator Nautica',
            'alamat' => 'Jl. Laut Biru No.1, Jakarta',
            'no_telp' => '081234567890',
            'bio' => 'Admin utama sistem penyewaan kapal Nautica.',
            'tanggal_lahir' => '1990-01-01',
        ]);
    }
}
