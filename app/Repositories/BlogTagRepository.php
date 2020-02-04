<?php


namespace App\Repositories;

use App\Models\BlogTag;
use Illuminate\Support\Collection;

class BlogTagRepository implements BlogTagRepositoryInterface
{
    /**
     * @inheritDoc
     * @return BlogTag|null|object
     */
    public function find(int $id): ?BlogTag
    {
        return BlogTag::query()->find($id);
    }

    /**
     * @inheritDoc
     */
    public function all(): Collection
    {
        return BlogTag::all();
    }

    /**
     * @inheritDoc
     */
    public function create(array $tag): BlogTag
    {
        $blogTag = new BlogTag();

        return $this->update($blogTag, $tag);
    }

    /**
     * @inheritDoc
     */
    public function update(BlogTag $blogTag, array $tag): BlogTag
    {
        $blogTag->title = $tag['title'];

        $blogTag->save();

        return $blogTag;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): void
    {
        BlogTag::query()
            ->where('id', '=', $id)
            ->forceDelete();
    }
}
