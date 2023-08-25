<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatatableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $data = [];

        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'name' => $faker->word,
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('datatables')->insert($data);
    }
}
