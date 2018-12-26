<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

use App\Http\Requests\PostStoreFormRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(5);
        return view('admin.posts.index',compact('posts'))->with('i', (request()->input('page', 1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = \App\Tag::all();//get()->pluck('name', 'id');
        return view('admin.posts.create')->withCategories(Category::all())->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreFormRequest $request)
    {
        // $request->validate(['title' => 'required|unique:posts|max:255|min:3','content' => 'required',]);
        
        $post = Post::create($request->all());
        $post->tags()->sync((array)$request->input('tag'));

        // Post::create(['title' => $request->title, 'content' => $request->content, 'category_id' => $request->category_id, is_active' => $request->is_active!= '' ?$request->get('is_active') : True]);

        return redirect()->route('posts.index')->with('success','Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = \App\Tag::get()->pluck('name', 'id');
        return view('admin.posts.edit')->withPost($post)->withCategories(Category::pluck('name', 'id'))->withTags($tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate(
            $request,
            [
               'title' => 'required|max:255|min:3',
               'content' => 'required',
            ]
        );
        $post->update($request->all());

        $post->tags()->sync((array)$request->input('tag'));
     
        return redirect()->route('posts.index')
            ->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('posts.index')
            ->with('success','Post deleted successfully');
    }
}
