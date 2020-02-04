<?php

namespace App\Repositories;

use App\Models\BlogPost;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BlogPostRepository
 *
 * @package App\Repositories
 */
class BlogPostRepository implements BlogPostRepositoryInterface
{
    /**
     * @inheritDoc
     * @return BlogPost|null|object
     */
    public function find(int $id): ?BlogPost
    {
        return BlogPost::query()->find($id);
    }

    /**
     * @inheritDoc
     */
    public function all(): Collection
    {
        return BlogPost::all();
    }

    /**
     * @inheritDoc
     */
    public function create(array $post): BlogPost
    {
       $blogPost = new BlogPost();

       return $this->update($blogPost, $post);
    }

    /**
     * @inheritDoc
     */
    public function update(BlogPost $blogPost, array $post): BlogPost
    {
        $blogPost->title = $post['title'];
        $blogPost->slug = $post['slug'];
        $blogPost->category_id = $post['category_id'];
        $blogPost->excerpt = $post['excerpt'];

        $blogPost->save();
        return $blogPost;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): void
    {
        BlogPost::query()
            ->where('id', '=', $id)
            ->forceDelete()
        ;
    }

    /**
     * @inheritDoc
     */
    public function getPostsWithPaginate(int $countOfPosts = null): LengthAwarePaginator
    {
        return BlogPost::query()
            ->with(['category'])
            ->paginate($countOfPosts);
    }
}
