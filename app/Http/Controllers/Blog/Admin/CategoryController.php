<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Models\BlogCategory;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Repositories\BlogCategoryRepository;
use Illuminate\View\View;
use Throwable;

/**
 * Class CategoriesController
 * @package App\Http\Controllers\Blog\Admin
 */
class CategoryController extends Controller
{
    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    /**
     * CategoriesController constructor.
     */
    public function __construct()
    {
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $paginator = $this->blogCategoryRepository->getCategoriesWithPaginate(5);

        return view('blog.admin.categories.index', [
            'paginator' => $paginator,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $category = BlogCategory::query()->make();

        return view('blog.admin.categories.edit', [
            'category' => $category,
        ]);
    }

    /**
     * @param BlogCategoryCreateRequest $request
     * @return RedirectResponse
     */
    public function store(BlogCategoryCreateRequest $request): RedirectResponse
    {
        $newCategory = $request->all();

        try {
            /** @var BlogCategory $category */
            $category = BlogCategory::query()->create($newCategory);

            return redirect()
                ->route('blog.admin.categories.edit', $category->id)
                ->with(['success' => 'Успешно сохранено'])
            ;
        } catch (Throwable $error) {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput()
            ;
        }
    }

    /**
     * @param $id
     * @return View
     */
    public function edit($id): View
    {
        $category = $this->blogCategoryRepository->find($id);

        if ($category === null) {
            abort(404);
        }

        return view('blog.admin.categories.edit', [
            'category' => $category,
        ]);
    }

    /**
     * @param BlogCategoryUpdateRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(BlogCategoryUpdateRequest $request, $id): RedirectResponse
    {
        $category = $this->blogCategoryRepository->find($id);

        if ($category === null) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }

        $updateCategory = $request->all();
        $result = $category->update($updateCategory);

        if ($result === true) {
            return redirect()
                ->route('blog.admin.categories.edit', [$category->id])
                ->with(['success' => 'Успешно сохранено']);
        }
        return back()
            ->withErrors(['msg' => 'Ошибка сохранения'])
            ->withInput();
    }
}
