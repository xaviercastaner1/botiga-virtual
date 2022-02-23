<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producte;
use App\Models\Proveidor;

class ProducteTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $proveidors = Proveidor::all()->pluck('nom');
        $this->command->info(count($proveidors));

        for($i = 0; $i < 10; $i++) {
            Producte::create([
                'nom' => "Monitor #{$i}",
                'descripcio' => 'Un monitor a bon preu',
                'imatge' => 'https://ae01.alicdn.com/kf/H3bd88539e71c4667bad520f1e4009e3bu/24-inch-23-8-LED-LCD-Curved-Screen-Monitor-PC-75Hz-HD-Gaming-22-27-Inch.jpg_Q90.jpg_.webp',
                'preu' => rand(20, 90),
                'descompte' => rand(0, 15),
                'stock' => 50,
                'proveidor' => $proveidors[rand(0, count($proveidors) - 1)],
                'categoria' => 'monitors'
            ]);

            Producte::create([
                'nom' => "Ratoli #{$i}",
                'descripcio' => 'Un ratoli a bon preu',
                'imatge' => 'http://img.pccomponentes.com/articles/28/287353/logitech-g203-lightsync-2nd-gen-raton-gaming-8000dpi-rgb-negro.jpg',
                'preu' => rand(20, 90),
                'descompte' => rand(0, 15),
                'stock' => 50,
                'proveidor' => $proveidors[rand(0, count($proveidors) - 1)],
                'categoria' => 'ratolins'
            ]);

            Producte::create([
                'nom' => "Teclat #{$i}",
                'descripcio' => 'Un teclat a bon preu',
                'imatge' => 'https://static.carrefour.es/hd_510x_/imagenes/products/84341/43033/793/8434143033793/imagenGrande1.jpg',
                'preu' => rand(20, 90),
                'descompte' => rand(0, 15),
                'stock' => 50,
                'proveidor' => $proveidors[rand(0, count($proveidors) - 1)],
                'categoria' => 'teclats'
            ]);

            Producte::create([
                'nom' => "Altaveus #{$i}",
                'descripcio' => 'Uns altaveus a bon preu',
                'imatge' => 'https://m.media-amazon.com/images/I/711TfVyTXEL._AC_SY355_.jpg',
                'preu' => rand(20, 90),
                'descompte' => rand(0, 15),
                'stock' => 20,
                'proveidor' => $proveidors[rand(0, count($proveidors) - 1)],
                'categoria' => 'altaveus'
            ]);
        }


    }
}

