<?php

namespace App\Repositories;

use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BlogCategoryRepository
 *
 * @packege App\Repositories
 */
class BlogCategoryRepository implements BlogCategoryRepositoryInterface
{
    /**
     * @inheritDoc
     * @return BlogCategory|null|object
     */
    public function find(int $id): ?BlogCategory
    {
        return BlogCategory::query()->find($id);
    }

    /**
     * @inheritDoc
     */
    public function all(): Collection
    {
        return BlogCategory::all();
    }

    /**
     * @inheritDoc
     */
    public function create(array $category): BlogCategory
    {
        $blogCategory = new BlogCategory();
        return $this->update($blogCategory, $category);
    }

    /**
     * @inheritDoc
     */
    public function update(BlogCategory $blogCategory, array $category): BlogCategory
    {
        $blogCategory->title = $category['title'];
        $blogCategory->description = $category['description'];
        $blogCategory->slug = $category['slug'];
        $blogCategory->parent_id = $category['parent_id'];

        $blogCategory->save();

        return $blogCategory;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): void
    {
        BlogCategory::query()
            ->where('id','=', $id)
            ->forceDelete()
        ;
    }
}
