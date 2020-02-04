<?php

namespace App\Repositories;

use App\Models\BlogPostMarker;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BlogPostMarkerRepository
 * @package App\Repositories
 */
class BlogPostMarkerRepository implements BlogPostMarkerRepositoryInterface
{
    /**
     * @inheritDoc
     * @return BlogPostMarker|null|object
     */
    public function find(int $id): ?BlogPostMarker
    {
        return BlogPostMarker::query()->find($id);
    }

    /**
     * @inheritDoc
     */
    public function all(): Collection
    {
        return BlogPostMarker::all();
    }

    /**
     * @inheritDoc
     */
    public function create(array $marker): BlogPostMarker
    {
        $blogMarker = new BlogPostMarker();

        return $this->update($blogMarker, $marker);
    }

    /**
     * @inheritDoc
     */
    public function update(BlogPostMarker $blogPostMarker, array $marker): BlogPostMarker
    {
        $blogPostMarker->title = $marker['title'];

        $blogPostMarker->save();

        return $blogPostMarker;
    }

    public function delete(int $id): void
    {
        BlogPostMarker::query()
            ->where('id', '=', $id)
            ->forceDelete();
    }
}
