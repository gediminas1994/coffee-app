<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoffeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coffeeItems = [];

        for ($i = 0; $i < 20; $i++){
            $coffeeItems[] = [
                'title' => 'Flat White',
                'price' => 2.99,
                'image' => 'https://st3.depositphotos.com/1648251/19140/i/1600/depositphotos_191403274-stock-photo-espresso-coffee-cup-top-view.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('coffees')->insert($coffeeItems);
    }
}
