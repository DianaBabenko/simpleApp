<?php

namespace App\Http\Controllers\Blog\Admin;

use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Models\BlogCategory;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Repositories\BlogCategoryRepository;
use Illuminate\View\View;


/**
 * Class CategoryController
 * @package App\Http\Controllers\Blog\Admin
 */
class CategoryController extends BaseController
{
    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();

        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(25);
        //dd($this->blogCategoryRepository->getPosts());

        $category = BlogCategory::find(1);
        $tag = $category->tag;
        dd($category, $tag);

        return view('blog.admin.categories.index', compact('paginator'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $item = BlogCategory::make();
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.categories.edit',
            compact('item', 'categoryList'));
    }


    /**
     * Store a newly created resource in storage.
     * @param BlogCategoryCreateRequest $request
     * @return RedirectResponse
     */
    public function store(BlogCategoryCreateRequest $request): RedirectResponse
    {
        $data = $request->input();

        //Create object and save in db
        $item = BlogCategory::query()->create($data);

        if($item === true) {
            return redirect()
                ->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Успешно сохранено']);
        }
        return back()
            ->withErrors(['msg' => 'Ошибка сохранения'])
            ->withInput();
    }


    /**
     * @param $id
     * @param BlogCategoryRepository $categoryRepository
     * @return View
     */
    public function edit($id, BlogCategoryRepository $categoryRepository): View
    {
        $item = $this->blogCategoryRepository->getEdit($id);

        if ($item === null) {
            abort(404);
        }

        $categoryList
            = $this->blogCategoryRepository->getForComboBox();//get elements for combobox list

        return view('blog.admin.categories.edit',
        compact('item', 'categoryList'));
    }


    /**
     * @param BlogCategoryUpdateRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(BlogCategoryUpdateRequest $request, $id): RedirectResponse
    {
        $item = $this->blogCategoryRepository->getEdit($id);

        if ($item === null) {
            return back() //redirect back
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"]) //situated in errors array (back())
                ->withInput(); //return info which was wrote
        }

        $data = $request->all();

        $result = $item->update($data);

        if ($result === true) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id) //should id variable in route
                ->with(['success' => 'Успешно сохранено']); //message
        }
        return back() // return to early route
            ->withErrors(['msg' => 'Ошибка сохранения'])
            ->withInput();
    }
}
