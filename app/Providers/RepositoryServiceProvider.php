<?php

namespace App\Providers;

use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogCategoryRepositoryInterface;
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
    }
}
