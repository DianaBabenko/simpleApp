<?php


namespace App\Repositories;

use App\Models\BlogTag;
use Illuminate\Support\Collection;

interface BlogTagRepositoryInterface
{
    /**
     * @param int $id
     * @return BlogTag|null|object
     */
    public function find(int $id): ?BlogTag;

    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param array $tag
     * @return BlogTag
     */
    public function create(array $tag): BlogTag;

    /**
     * @param BlogTag $blogTag
     * @param array $tag
     * @return BlogTag
     */
    public function update(BlogTag $blogTag, array $tag): BlogTag;

    /**
     * @param int $id
     */
    public function delete(int $id): void;
}
