<?php

namespace App\Providers;

use App\Repositories\{BlogCategoryRepository, BlogCategoryRepositoryInterface};
use App\Repositories\{BlogPostMarkerRepository, BlogPostMarkerRepositoryInterface};
use App\Repositories\{BlogPostRepository, BlogPostRepositoryInterface};
use App\Repositories\{BlogTagRepository, BlogTagRepositoryInterface};
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            BlogCategoryRepositoryInterface::class,
            BlogCategoryRepository::class
        );

        $this->app->bind(
            BlogPostRepositoryInterface::class,
            BlogPostRepository::class
        );

        $this->app->bind(
            BlogPostMarkerRepositoryInterface::class,
            BlogPostMarkerRepository::class
        );

        $this->app->bind(
            BlogTagRepositoryInterface::class,
            BlogTagRepository::class
        );
    }
}
