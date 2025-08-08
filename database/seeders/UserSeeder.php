<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // User Guru
        User::create([
            'name' => 'Ahmad Zulkifli',
            'email' => 'guru@ahmadzulkifli.sch.id',
            'password' => Hash::make(value: 'guru123'),
            'role' => 'guru',
        ]);

        // User Tata Tertib
        User::create([
            'name' => 'Muhammad Hasan Bisri',
            'email' => 'tatatertib@muhammadhasanbisri.sch.id',
            'password' => Hash::make('tatatertib123'),
            'role' => 'tata_tertib',
        ]);

        // Additional Users
        User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@sitiaminah.sch.id',
            'password' => Hash::make('guru123'),
            'role' => 'guru',
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@budisantoso.sch.id',
            'password' => Hash::make('tatatertib123'),
            'role' => 'tata_tertib',
        ]);
    }
}