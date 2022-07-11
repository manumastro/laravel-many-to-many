<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Post;
use App\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        $categories = Category::all();
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'title' => 'required|max:255|min:10',
                'content' => 'required|min:10',
            ],
            [
                'title.required' => 'Il campo titolo è obbligatorio',
                'title.max' => 'Il campo titolo deve avere al massimo :max caratteri',
                'title.min' => 'Il campo titolo deve avere almeno :min caratteri',
                'content.required' => 'Il campo content è obbligatorio',
                'content.min' => 'Il campo titolo deve avere almeno :min caratteri',
            ]
        );
        
        $data = $request->all();
        $new_post = new Post();
        $data['slug'] = Post::slugGenerator($data['title']);
        //dd($data);
        $new_post->fill($data);
        $new_post->save();
        return redirect()->route('admin.posts.show', $new_post);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('admin.posts.show', compact('post'));
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
        if($post){
            return view('admin.posts.edit', compact('post', 'categories'));
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate(
            [
                'title' => 'required|max:255|min:10',
                'content' => 'required|min:10',
            ],
            [
                'title.required' => 'Il campo titolo è obbligatorio',
                'title.max' => 'Il campo titolo deve avere al massimo :max caratteri',
                'title.min' => 'Il campo titolo deve avere almeno :min caratteri',
                'content.required' => 'Il campo content è obbligatorio',
                'content.min' => 'Il campo titolo deve avere almeno :min caratteri',
            ]
        );

        $data = $request->all();
        $post->update($data);
        return redirect()->route('admin.posts.show', $post);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
