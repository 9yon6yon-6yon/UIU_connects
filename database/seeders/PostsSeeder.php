<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 20; $i++) {
            DB::table('posts')->insert(
                [
                    'user_id' => '1',
                    'post_title' => $faker->name(),
                    'content' => $faker->text(),
                    'files' => $faker->filePath(),
                    'upvotes' => '0',
                    'downvotes' => '0',
                    'created_at' => $faker->date(),
                    'updated_at' => $faker->date(),
                ]
            );
        }
    }
}
