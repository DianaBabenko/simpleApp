<?php

namespace App\Http\Controllers\Blog\Admin;

use Illuminate\Support\Str;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Models\BlogCategory;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Repositories\BlogCategoryRepository;


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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        //$paginator = BlogCategory::paginate(15);
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(5);

        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $item = new BlogCategory();
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.categories.edit',
            compact('item', 'categoryList'));
    }


    /**
     * Store a newly created resource in storage.
     * @param BlogCategoryCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();

        //Create object and save in db
        $item = (new BlogCategory())->create($data);

        if($item) {
            return redirect()
                ->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }


    /**
     * @param int $id
     * @param BlogCategoryRepository $categoryRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, BlogCategoryRepository $categoryRepository)
    {
        $item = $this->blogCategoryRepository->getEdit($id);
        if(empty($item)) {
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        $item = $this->blogCategoryRepository->getEdit($id);

        if (empty($item)) {
            return back() //redirect back
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"]) //situated in errors array (back())
                ->withInput(); //return info which was wrote
        }

        $data = $request->all();

        $result = $item->update($data); //method update($data) includes fill and save methods
            /*->fill($data) //fill fields
            ->save();//return bool (save to db)*/

        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id) //should id variable in route
                ->with(['success' => 'Успешно сохранено']); //message
        } else {
            return back() // return to early route
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }
}
