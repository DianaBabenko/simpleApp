<?php

namespace App\Http\Controllers\Blog;
use App\Models\BlogPost;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $posts = BlogPost::all();

        return view('blog.posts.index', [
            'posts' => $posts,
        ]);
    }
}
