<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $posts = DB::select('select * from posts');
        // $posts = DB::table('posts')->orderBy('id', 'desc')->get();
        

        // $posts = DB::table('posts')->where([['is_active', '=', '1'],['id', '>', '60'],])->get();
 
        // $posts = DB::table('posts')->where('id', '>', 90)->orWhere('is_active', true)->get();

        // $posts = DB::table('posts')->whereBetween('id', [1, 10])->get();
        // $posts = DB::table('posts')->whereNotBetween('id', [10, 100])->get();

        // $posts = DB::table('posts')->whereIn('category_id', [1, 2, 3])->get();

        // $posts = DB::table('posts')->whereNotIn('category_id', [1, 2, 3])->get();

        // $posts = DB::table('posts')->whereNull('updated_at')->get();

        // $posts = DB::table('posts')->whereNotNull('updated_at')->get();

        // $posts = DB::table('posts')->whereDate('created_at', '2018-05-17')->get();

        // $posts = DB::table('posts')->whereMonth('created_at', '12')->get();

        // $posts = DB::table('posts')->whereDay('created_at', '12')->get();

        // $posts = DB::table('posts')->whereYear('created_at', '2018')->get();

        // $posts = DB::table('posts')->whereColumn('updated_at', '>', 'created_at')->get();

        // $posts = DB::table('posts')->orderBy('id', 'desc')->take(5)->get();
        // $posts = DB::table('posts')->orderBy('id', 'desc')->skip(10)->take(5)->get();
        // $posts = DB::table('posts')->offset(10)->limit(5)->get();

        
        // $posts = DB::table('posts')->paginate(7);
        // $posts = DB::table('posts')->paginate(7)->onEachSide(1);
        return view('blog.index', ['posts' => $posts]);
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
        // $post = DB::table('posts')->latest()->first();
        // $post = DB::table('posts')->oldest()->first();
        return view('blog.show', ['post' => $post]);
    }

}
