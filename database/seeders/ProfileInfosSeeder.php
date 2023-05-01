<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProfileInfosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        DB::table('personal_infos')->insert(
            [
                'user_id' => '1',
                'userName' => $faker->name(),
                'fathersName' => $faker->name(),
                'mothersName' => $faker->name(),
                'image_path' => $faker->filePath(),
                'dob' => $faker->date(),
                'nationality' => $faker->country(),
                'address' => $faker->address(),
                'status' => 'single',
                'created_at' => $faker->date(),
                'updated_at' => $faker->date(),
            ]
        );
    }
}
