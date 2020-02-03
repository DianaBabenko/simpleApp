<?php

namespace App\Console\Commands;

use App\Repositories\BlogCategoryRepositoryInterface;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var BlogCategoryRepositoryInterface
     */
    private $blogCategoryRepository;

    /**
     * TestCommand constructor.
     * @param BlogCategoryRepositoryInterface $blogCategoryRepository
     */
    public function __construct(BlogCategoryRepositoryInterface $blogCategoryRepository)
    {
        parent::__construct();
        $this->blogCategoryRepository = $blogCategoryRepository;
    }


    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Hello');

        while (true) {
            $id = (int) $this->ask('category');

            $category = $this->blogCategoryRepository->find($id);

            if ($category === null) {
                $this->error('Not found');
            } else {
                $this->info($category->title);
            }
        }
    }
}
