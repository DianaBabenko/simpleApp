<?php

namespace App\Http\Controllers\Blog\Admin;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Repositories\BlogCategoryRepository;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = BlogCategory::paginate(15);

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
        $categoryList = BlogCategory::all();

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
        if (empty($data['slug'])) {
            $data['slug'] = str_slug($data['title']);
        }

        //Create object but don't create it in db
        /*$item = new BlogCategory($data);
        $item->save();*/

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
        /*$item = BlogCategory::findOrFail($id);
        $categoryList = BlogCategory::all();*/

        $item = $categoryRepository->getEdit($id);
        if(empty($item)) {
            abort(404);
        }
        $categoryList = $categoryRepository->getForComboBox();//get elements for combobox list

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
        /*$rules = [
            'title'         => 'required|min:5|max:200',
            'slug'          => 'max:200',
            'description'   => 'string|max:500|min:3',
            'parent_id'     => 'required|integer|exists:blog_categories,id',
        ];*/

        //$validatedData = $this->validate($request, $rules); // handle to controller ValidatesRequests

        //$validatedData = $request->validate($rules);// if errors -> redirect to back with description of error

        //dd($validatedData);

        $item = BlogCategory::find($id);
        if (empty($item)) {
            return back() //redirect back
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"]) //situated in errors array (back())
                ->withInput(); //return info which was wrote
        }

        $data = $request->all();
        if (empty($data['slug'])) {
            $data['slug'] = str_slug($data['title']);
        }

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
