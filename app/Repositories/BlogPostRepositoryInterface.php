<?php


namespace App\Repositories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


interface BlogPostRepositoryInterface
{
    /**
     * @param int $id
     * @return BlogPost|null|object
     */
    public function find(int $id): ?BlogPost;

    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param array $post
     * @return BlogPost
     */
    public function create(array $post): BlogPost;

    /**
     * @param BlogPost $blogPost
     * @param array $post
     * @return BlogPost
     */
    public function update(BlogPost $blogPost, array $post): BlogPost;

    /**
     * @param int $id
     */
    public function delete(int $id): void;

    /**
     * @param int|null $countOfPosts
     * @return LengthAwarePaginator
     */
    public function getPostsWithPaginate(int $countOfPosts = null): LengthAwarePaginator;
}
