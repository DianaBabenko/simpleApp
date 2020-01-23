<?php

namespace App\Http\Controllers\Blog\Admin;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Requests\BlogCategoryUpdateRequest;

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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd(__METHOD__);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd(__METHOD__);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $item = BlogCategory::findOrFail($id);
        $categoryList = BlogCategory::all();

        return view('blog.admin.categories.edit',
        compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
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
        $result = $item
            ->fill($data) //fill fields
            ->save();//return bool (save to db)

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
