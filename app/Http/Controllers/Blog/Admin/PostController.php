<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogPostCreateRequest;
use App\Jobs\BlogPostAfterCreateJob;
use App\Jobs\BlogPostAfterDeleteJob;
use App\Models\BlogPost;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class PostController
 * @package App\Http\Controllers\Blog\Admin
 */
class PostController extends Controller
{
    /**
     * @var BlogPostRepository
     */
    private $blogPostRepository;

    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    /**
     * PostController constructor.
     * @param BlogPostRepository $blogPostRepository
     * @param BlogCategoryRepository $blogCategoryRepository
     */
    public function __construct(BlogPostRepository $blogPostRepository, BlogCategoryRepository $blogCategoryRepository)
    {
        $this->blogPostRepository = $blogPostRepository;
        $this->blogCategoryRepository = $blogCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $paginatorPosts = $this->blogPostRepository->getPostsWithPaginate(7);

        return view('blog.admin.posts.index', [
            'paginatorPosts' => $paginatorPosts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $post = BlogPost::query()->make();
        $categoryList = $this->blogCategoryRepository->getCategoriesWithPaginate();

        return view('blog.admin.posts.edit', [
            'post' => $post,
            'categoryList' => $categoryList,
        ]);
    }

    /**
     * @param  BlogPostCreateRequest $request
     * @return RedirectResponse
     */
    public function store(BlogPostCreateRequest $request): RedirectResponse
    {
        $newPost = $request->input();

        /** @var BlogPost $post */
        $post = BlogPost::query()->make($newPost);

        if ($post === true) {
            $job = new BlogPostAfterCreateJob($post);
            $this->dispatch($job);

            return redirect()->route('blog.admin.posts.edit', [$post->id])
                ->with(['success' => 'Успешно сохранено']);
        }
        return back()
            ->withErrors(['msg' => 'Ошибка сохранения'])
            ->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id): View
    {
        $post = $this->blogPostRepository->find($id);

        if ($post === null) {
            throw new NotFoundHttpException();
        }

        $categoryList = $this->blogCategoryRepository->getCategoriesWithPaginate();

        return view('blog.admin.posts.edit', [
                'post' => $post,
                'categoryList' => $categoryList
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BlogPostUpdateRequest  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(BlogPostUpdateRequest $request, $id): RedirectResponse
    {
        $post = $this->blogPostRepository->find($id);

        if ($post === null) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }

        $updatePost = $request->all();

        $result = $post->update($updatePost);

        if ($result === true) {
            return redirect()
                ->route('blog.admin.posts.edit', [$post->id])
                ->with(['success' => 'Успешно сохранено']);
        }
        return back()
            ->withErrors(['msg' => 'Ошибка обновления'])
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $result = $this->blogPostRepository->delete($id);

        if ($result === 1) {///void
            BlogPostAfterDeleteJob::dispatch($id)->delay(20);

            return redirect()
                ->route('blog.admin.posts.index')
                ->with(['success' => "Запись id[$id] удалена"]);
        }

        return back()
            ->withErrors(['msg' => 'Ошибка удаления']);
    }
}
