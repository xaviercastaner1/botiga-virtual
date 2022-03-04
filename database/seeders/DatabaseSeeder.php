<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ProveidorTableSeeder;
use Database\Seeders\UserTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->command->info('User table seeded!');

        $this->call(ProveidorTableSeeder::class);
        $this->command->info('Proveidor table seeded!');

        $this->call(CategoriaTableSeeder::class);
        $this->command->info('Categoria table seeded!');

        $this->call(ProducteTableSeeder::class);
        $this->command->info('Producte table seeded!');

    }
}
