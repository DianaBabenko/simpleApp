<?php

use Illuminate\Database\Seeder;

class BlogCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $categories = [];
        $cName = 'Без категории';
        $categories[] = [
            'title' => $cName,
            'slug' => Str::slug($cName),
            'description' => str_random(20),
        ];

        for ($i = 2; $i <=11; $i++) {
            $cName = 'Категория #'.$i;

            $categories[] = [
                'title' => $cName,
                'slug' => Str::slug($cName),
                'description' => str_random(20),
            ];
        }
        DB::table('blog_categories')->insert($categories);
    }
}
