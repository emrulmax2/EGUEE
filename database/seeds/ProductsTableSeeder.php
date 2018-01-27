<?php

use App\Products;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Products::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            Products::create([
                'productname' => $faker->word,
                'price' => $faker->randomFloat(2,9,300),
                'sku' => $faker->postcode,
                'description' => $faker->paragraph,
                'currency' => 'EUR',
            ]);
        }
    }
}
