<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;


class CategoriaTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Categoria::create([
            'nom' => 'monitors',
        ]);

        Categoria::create([
            'nom' => 'ratolins',
        ]);

        Categoria::create([
            'nom' => 'teclats',
        ]);

        Categoria::create([
            'nom' => 'altaveus',
        ]);

    }
}

