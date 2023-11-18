<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $tagIds = DB::table('tags')->pluck('id')->toArray();

        foreach (range(1, 100) as $index) {
            $bookId = DB::table('books')->insertGetId([
                'title' => $faker->sentence(3, true),
                'author' => $faker->name,
                'comments' => $faker->text(200),
                'rating' => $faker->randomFloat(1, 1, 10),
                'publication_year' => $faker->year('now')
            ]);

            DB::table('book_tag')->insert([
                'book_id' => $bookId,
                'tag_id' => $faker->randomElement($tagIds)
            ]);
        }
    }
}
