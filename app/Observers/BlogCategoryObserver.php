<?php

namespace App\Observers;

use App\Models\BlogCategory;
use Str;

class BlogCategoryObserver
{
    /**
     * @param BlogCategory $blogCategory
     */
    public function creating(BlogCategory $blogCategory): void
    {
        $this->setSlug($blogCategory);
    }

    /**
     * @param BlogCategory $blogCategory
     */
    private function setSlug(BlogCategory $blogCategory): void
    {
        if (empty($blogCategory->slug)) {
            $blogCategory->slug = Str::slug($blogCategory->title);
        }
    }

    /**
     * @param BlogCategory $blogCategory
     */
    public function updating(BlogCategory $blogCategory): void
    {
        $this->setSlug($blogCategory);
    }
}
