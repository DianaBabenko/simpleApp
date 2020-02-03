<?php

namespace App\Repositories;

use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Collection;

interface BlogCategoryRepositoryInterface
{
    /**
     * @param int $id
     * @return BlogCategory|null|object
     */
    public function find(int $id): ?BlogCategory;

    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param array $category
     * @return BlogCategory
     */
    public function create(array $category): BlogCategory;

    /**
     * @param BlogCategory $blogCategory
     * @param array $category
     * @return BlogCategory
     */
    public function update(BlogCategory $blogCategory, array $category): BlogCategory;

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;
}
