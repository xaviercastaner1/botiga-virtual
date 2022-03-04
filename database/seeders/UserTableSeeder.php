<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => env('ADMIN_NAME', 'admin'),
            'admin' => true,
            'email' => env('ADMIN_EMAIL', 'admin@admin.com'),
            'password' => Hash::make(env('ADMIN_PASSWORD', 'adminpasswd'))
        ]);

    }
}
