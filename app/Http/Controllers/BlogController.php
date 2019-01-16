<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Post;
use Auth;
use Gate;
use App\Http\Requests\PostUpdateFormRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $posts = DB::table('posts')->where('is_active', true)->orderBy('updated_at', 'desc')->paginate(5);

        return view('blog.index', ['posts' => $posts]);
    }

    public function list()
    {
        $posts = Post::latest()->where('user_id', Auth::id())->paginate(5);
        $this->authorize('view', $post);
        return view('blog.list',compact('posts'));
    }

    public function view(Post $post)
    {
        $this->authorize('view', $post);
        // $posts = Post::latest()->where('user_id', Auth::id())->paginate(5);
        
        // return view('blog.list',compact('posts'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = \App\Category::pluck('name', 'id');
        
        $tags = \App\Tag::get()->pluck('name', 'id');
        if (Gate::allows('update-post', $post)) {
            // Текущий пользователь может редактировать статью...
            return view('blog.edit')
                ->withPost($post)->withCategories($categories)->withTags($tags);
        }
    }

    public function update(PostUpdateFormRequest $request, Post $post)
    {
        
        if ($request->user()->cannot('update-post', $post)) {
            abort(403);
        }
        // Обновление статьи...
        // $data = $request->only('title', 'body');
        // $post->fill($data)->save();

        $post->update($request->all());
        $post->tags()->sync((array)$request->input('tag'));
        
        return redirect()->route('blog.list')
            ->with('success','Post updated successfully');
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = DB::table("posts")->where("id", $id)->first();
        return view('blog.show', ['post' => $post]);
    }

    // PostsController, метод showBySlug:
    public function showBySlug($slug)
    {
        /**
            * Вначале мы проверяем, не является ли слаг числом.
            * Часто слаги внедряют в программу уже после того,
            * как был другой механизм построения пути.
            * Например, через числовые индексы.
            * Тогда может получится ситуация, что пользователь,
            * зайдя на сайт по старой ссылке, увидит 404 ошибку,
            * что такой страницы не существует.
        */
        if (is_numeric($slug)) {
            // Get post for slug.
            $post = \App\Post::findOrFail($slug);
            return Redirect::to(route('blog.show', $post->slug), 301);
            // 301 редирект со старой страницы, на новую.
        }

        // Get post for slug.
        $post = \App\Post::whereSlug($slug)->firstOrFail();

        // var_dump($post->category->name);

        return view(
            'blog.show',
            [
                'post' => $post,
                'hescomment' => true
            ]
        );
    }

    public function getPostsByCategory($categoryId)
    {
        $posts = \App\Category::find($categoryId)->posts()->where('is_active', true)->orderBy('updated_at', 'desc')->paginate(5);
        return view('blog.index', ['posts' => $posts]);
    }

}
