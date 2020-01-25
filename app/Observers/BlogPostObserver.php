<?php

namespace App\Observers;

use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BlogPostObserver
{
    /**
     * Handle the blog post "created" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function created(BlogPost $blogPost)
    {
        //
    }

    /**
     * @param BlogPost $blogPost
     */
    public function creating(BlogPost $blogPost)
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
    public function updating(BlogPost $blogPost)
    {
        $this->setPublishedAt($blogPost);

        $this->setSlug($blogPost);
    }

    /**
     * if date of published not set but check like published => set the time
     * @param BlogPost $blogPost
     */
    protected function setPublishedAt(BlogPost $blogPost)
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
    protected function setSlug(BlogPost $blogPost)
    {
        if (empty($blogPost->slug)) {
            $blogPost->slug = Str::slug($blogPost->title);
        }
    }

    /**
     * set value to field content_html by content_raw
     * @param BlogPost $blogPost
     */
    protected function setHtml(BlogPost $blogPost)
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
    protected function setUser(BlogPost $blogPost)
    {
        $blogPost->user_id = auth()->user_id ?? BlogPost::UNKNOWN_USER;
    }

    /**
     * Handle the blog post "deleted" event.
     *
     * @param  BlogPost  $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "restored" event.
     *
     * @param  BlogPost  $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "force deleted" event.
     *
     * @param  BlogPost  $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }
}
