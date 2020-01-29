<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogPostCreateRequest;
use App\Jobs\BlogPostAfterCreateJob;
use App\Jobs\BlogPostAfterDeleteJob;
use App\Models\BlogPost;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class PostController
 * @package App\Http\Controllers\Blog\Admin
 */
class PostController extends BaseController
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
     */
    public function __construct()
    {
        parent::__construct();

        $this->blogPostRepository = app(BlogPostRepository::class);//create object
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $paginator = $this->blogPostRepository->getAllWithPaginate();
        //dd($this->blogPostRepository->getMarkers()->first());

        //$post = BlogPost::find(1);
        //$tags = $post->tagsToMany;
        //dd($tags);
        return view('blog.admin.posts.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $item = BlogPost::query()->make();
        $categoryList
            = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.posts.edit',
        compact('item','categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BlogPostCreateRequest  $request
     * @return RedirectResponse
     */
    public function store(BlogPostCreateRequest $request): RedirectResponse
    {
        $data = $request->input();
        $item = BlogPost::query()->create($data);

        if ($item === true) {
            $job = new BlogPostAfterCreateJob($item);
            $this->dispatch($job);

            return redirect()->route('blog.admin.posts.edit', [$item->id])
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
        $item = $this->blogPostRepository->getEdit($id);

        if ($item === null) {
            abort(404);
        }

        $categoryList
            = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.posts.edit', compact('item','categoryList'));
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
        $item = $this->blogPostRepository->getEdit($id);

        if ($item === null) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }

        $data = $request->all();

        $result = $item->update($data);

        if ($result === true) {
            return redirect()
                ->route('blog.admin.posts.edit', $item->id)
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
        //soft delete, stay at db
        $result = BlogPost::destroy($id);

        //full delete from db
        //$result = BlogPost::find($id)->forceDelete();

        if ($result === 1) {
            BlogPostAfterDeleteJob::dispatch($id)->delay(20);

            return redirect()
                ->route('blog.admin.posts.index')
                ->with(['success' => "Запись id[$id] удалена"]);
        }

        return back()
            ->withErrors(['msg' => 'Ошибка удаления']);
    }
}
