<?php


use Illuminate\Database\Seeder;
use App\Models\{BlogPost, BlogPostComment, BlogPostMarker, BlogTag, BlogTaggable};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(BlogCategoriesTableSeeder::class);
        factory(BlogPost::class, 100)->create();
        factory(BlogPostComment::class, 10)->create();
        factory(BlogPostMarker::class, 5)->create();
        factory(BlogTag::class, 10)->create();
        factory(BlogTaggable::class, 10)->create();
    }
}
