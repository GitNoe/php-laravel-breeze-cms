<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(/*Request $request*/)
    {
        // $request = request();

        $categories = Category::all();
        $posts = Post::latest()->limit(20)->get();

        return view("home", compact('categories', 'posts'));
    }

    public function getCategory($id, $slug)
    {
        $category = Category::find($id);

        $posts = $category->posts()->paginate(20);

        return view("category", compact('category', 'posts'));
    }

    public function getPost($id, $slug)
    {
        $post = Post::find($id);

        return view("post", compact('posts'));
    }
}
