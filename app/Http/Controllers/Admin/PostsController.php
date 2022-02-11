<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);

        return view("admin.post.index", compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view("admin.post.add", compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           "title" => "required",
           "content" => "required|min:10",
           "category_id" => "required",
           "image" => "required|mimes:jpeg,jpg,png,gif"
        ]);

        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->category_id = $request->input('category_id');

        $image = $request->file("image");
        $filename = md5(uniqid()) . "." . $image->getClientOriginalExtension();
        $image->move(public_path("uploads"), $filename);

        $post->image = $filename;
        $post->save();

        return redirect(route('post.index'))->with("message", "Post created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $post = Post::find($id);

        return view("admin.post.edit", compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "title" => "required",
            "content" => "required|min:10",
            "category_id" => "required",
            "image" => "mimes:jpeg,jpg,png,gif"
        ]);

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->category_id = $request->input('category_id');

        if($request->hasFile("image")) {
            $image = $request->file("image");
            $filename = md5(uniqid()) . "." . $image->getClientOriginalExtension();
            $image->move(public_path("uploads"), $filename);

            $post->image = $filename;
        }

        $post->save();

        return redirect(route('post.index'))->with("message", "Post updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();

        return redirect(route('post.index'))->with("message", "Post deleted successfully");
    }
}
