<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proveidor;


class ProveidorTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Proveidor::create([
            'nom' => 'SAMSUNG',
            'telefon' => '982354112',
            'direccio' => 'Avenida de Barajas, 32, 28108, Alcobendas, Madrid',
            'email' => 'info@samsungesp.com'
        ]);

        Proveidor::create([
            'nom' => 'HP',
            'telefon' => '922344172',
            'direccio' => 'Calle Vicente Aleixandre, 1, Madrid, Madrid',
            'email' => 'info@hpesp.com'
        ]);

        Proveidor::create([
            'nom' => 'HUAWEI',
            'telefon' => '922433121',
            'direccio' => 'Calle de Isabel Colbrand, 22, 28050 Madrid',
            'email' => 'info@huaweiesp.com'
        ]);

        Proveidor::create([
            'nom' => 'ACER',
            'telefon' => '927821198',
            'direccio' => 'Camí Antic de Barcelona a València, 08850 Gavà, Barcelona',
            'email' => 'info@aceresp.com'
        ]);

        Proveidor::create([
            'nom' => 'XIAOMI',
            'telefon' => '933828714',
            'direccio' => 'Calle Orense, 70, Madrid, Madrid',
            'email' => 'info@xiaomiesp.com'
        ]);
    }
}

