<?php


namespace App\Repositories;

use App\Models\BlogPostMarker;
use Illuminate\Database\Eloquent\Collection;

interface BlogPostMarkerRepositoryInterface
{
    /**
     * @param int $id
     * @return BlogPostMarker|null|object
     */
    public function find(int $id): ?BlogPostMarker;

    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param array $marker
     * @return BlogPostMarker
     */
    public function create(array $marker): BlogPostMarker;

    /**
     * @param BlogPostMarker $blogPostMarker
     * @param array $marker
     * @return BlogPostMarker
     */
    public function update(BlogPostMarker $blogPostMarker, array $marker): BlogPostMarker;

    /**
     * @param int $id
     */
    public function delete(int $id): void;
}
