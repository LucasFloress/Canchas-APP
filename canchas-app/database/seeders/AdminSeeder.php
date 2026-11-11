<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::firstOrCreate(
            ['email' => 'admin@tuapp.com'],
            [
                'name'     => 'Administrador',
                'password' => 'password123',  // se hashea solo por el cast 'hashed'
            ]
        );
    }
}
