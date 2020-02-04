<?php

namespace App\Observers;

use App\Models\BlogPost;
use Carbon\Carbon;
use Str;

/**
 * Class BlogPostObserver
 * @package App\Observers
 */
class BlogPostObserver
{
    /**
     * @param BlogPost $blogPost
     */
    public function creating(BlogPost $blogPost): void
    {
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
        $this->setHtml($blogPost);
        $this->setUser($blogPost);
    }

    /**
     * Handle the blog post "updated" event.
     *
     * @param  BlogPost  $blogPost
     * @return void
     */
    public function updating(BlogPost $blogPost): void
    {
        $this->setPublishedAt($blogPost);

        $this->setSlug($blogPost);
    }

    /**
     * if date of published not set but check like published => set the time
     * @param BlogPost $blogPost
     */
    protected function setPublishedAt(BlogPost $blogPost): void
    {
        $needSetPublished = empty($blogPost->published_at) && $blogPost->is_published;
        if ($needSetPublished) {
            $blogPost->published_at = Carbon::now();
        }
    }

    /**
     * if slug is empty => generate by title
     * @param BlogPost $blogPost
     */
    protected function setSlug(BlogPost $blogPost): void
    {
        if (empty($blogPost->slug)) {
            $blogPost->slug = Str::slug($blogPost->title);
        }
    }

    /**
     * set value to field content_html by content_raw
     * @param BlogPost $blogPost
     */
    protected function setHtml(BlogPost $blogPost): void
    {
        if ($blogPost->isDirty('content_raw')) {
            //TODO: There are must be generating markdown -> html
            $blogPost->content_html = $blogPost->content_raw;
        }
    }

    /**
     * if don't exist user_id => set by default 1.
     * @param BlogPost $blogPost
     */
    protected function setUser(BlogPost $blogPost): void
    {
        $blogPost->user_id = auth()->user_id ?? BlogPost::UNKNOWN_USER;
    }
}
