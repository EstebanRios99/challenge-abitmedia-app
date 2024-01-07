<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Vaciar la tabla
        Product::truncate();

        $faker = Factory::create();

        //Crear Licencias

        //Antivirus Windows
        for ($i = 0; $i < 10; $i++) {
            Product::create([
                'name' => 'Antivirus W' . $i + 1,
                'price' =>  5,
                'so' => 'Windows',
                'license' => $faker->unique()->regexify('[A-Za-z0-9]{100}'),
                'sku' => $faker->unique()->ean8() . 1 . $i,
                'type' => 1,
                'is_delete' => "0"
            ]);
        }

        //Antivirus MAC
        for ($i = 0; $i < 10; $i++) {
            Product::create([
                'name' => 'Antivirus M' . $i + 1,
                'price' =>  7,
                'so' => 'Mac',
                'license' => $faker->unique()->regexify('[A-Za-z0-9]{100}'),
                'sku' => $faker->unique()->ean8() . 1 . $i,
                'type' => 1,
                'is_delete' => "0"
            ]);
        }

        //Ofimatica Windows
        for ($i = 0; $i < 20; $i++) {
            $num = $i < 10 ? 1 . $i : $i;
            Product::create([
                'name' => 'Ofimatica W' . $i + 1,
                'price' =>  10,
                'so' => 'Windows',
                'license' => $faker->unique()->regexify('[A-Za-z0-9]{100}'),
                'sku' => $faker->unique()->ean8() . $num,
                'type' => 1,
                'is_delete' => "0"
            ]);
        }

        //Ofimatica Mac
        for ($i = 0; $i < 20; $i++) {
            $num = $i < 10 ? 1 . $i : $i;
            Product::create([
                'name' => 'Ofimatica M' . $i + 1,
                'price' =>  12,
                'so' => 'Mac',
                'license' => $faker->unique()->regexify('[A-Za-z0-9]{100}'),
                'sku' => $faker->unique()->ean8() . $num,
                'type' => 1,
                'is_delete' => "0"
            ]);
        }

        //Editor de video Windows
        for ($i = 0; $i < 30; $i++) {
            $num = $i < 10 ? 1 . $i : $i;
            Product::create([
                'name' => 'Editor de Video W' . $i + 1,
                'price' =>  20,
                'so' => 'Windows',
                'license' => $faker->unique()->regexify('[A-Za-z0-9]{100}'),
                'sku' => $faker->unique()->ean8() . $num,
                'type' => 1,
                'is_delete' => "0"
            ]);
        }

        //Editor de video Mac
        for ($i = 0; $i < 30; $i++) {
            $num = $i < 10 ? 1 . $i : $i;
            Product::create([
                'name' => 'Editor de Video W' . $i + 1,
                'price' =>  22,
                'so' => 'Mac',
                'license' => $faker->unique()->regexify('[A-Za-z0-9]{100}'),
                'sku' => $faker->unique()->ean8() . $num,
                'type' => 1,
                'is_delete' => "0"
            ]);
        }

        //Servicios
        Product::create([
            'name' => 'Formateo de computadores',
            'price' =>  25,
            'sku' => $faker->unique()->ean8() . 97,
            'type' => 2,
            'is_delete' => "0"
        ]);

        Product::create([
            'name' => 'Mantenimiento',
            'price' =>  30,
            'sku' => $faker->unique()->ean8() . 98,
            'type' => 2,
            'is_delete' => "0"
        ]);

        Product::create([
            'name' => 'Hora de soporte en software',
            'price' =>  50,
            'sku' => $faker->unique()->ean8() . 99,
            'type' => 2,
            'is_delete' => "0"
        ]);
    }
}
