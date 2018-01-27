<?php

use App\Orders;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Orders::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 20; $i++) {
            Orders::create([
                'orderdate' => $faker->dateTimeThisMonth('now'),
                'totalamount' => $faker->randomFloat(2,9,300),
                'discount' => $faker->randomFloat(2,1,30),
                'productid' => $faker->numberBetween(1,50),
                'quantity' => $faker->numberBetween(1,5),
                'customerid' => $faker->numberBetween(1,10),
            ]);
        }
    }
}
