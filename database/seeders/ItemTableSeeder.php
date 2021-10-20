<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $key = array ('B', 'C', 'K');

        for ($i = 0; $i <= 100; $i++) {
            $money  = $faker->randomFloat();
            $timing = $faker->dateTimeThisDecade();
            DB::table('items')->insert([
                'name' => $faker->lastName(),
                'description' => $faker->text(),
                'meta_description' => $faker->text(),
                'sku' => "K-" . $faker->unique()->numberBetween(),
                'quantity' => 10,
                'price' => $money,
                'special_price' => $money,
                'is_enable' => true,
                'created_at' => $timing,
                'updated_at' => $timing,
            ]);
        }
    }
}
