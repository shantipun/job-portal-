<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(6); // latest 6 blogs
        return view('blogs.index', compact('blogs'));
    }

 public function show($slug)
{
    $blog = Blog::where('slug', $slug)->first();
    if (!$blog) abort(404);

    return view('blog.show', compact('blog'));
}

}
