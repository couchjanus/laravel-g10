<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;

use Gate;

class PostsController extends Controller
{

  public function view()
  {
    
    // get current logged in user
    $user = Auth::user();
    // dd($user);
    
    // load post
    $post = Post::find(2);
    
    if ($this->authorize('view', $post)) {
      echo "Current logged in user is allowed to update the Post: {$post->id}";
    } else {
      echo 'Not Authorized.';
    }

    // if ($user->can('view', $post)) {
    //   echo "Current logged in user is allowed to update the Post: {$post->id}";
    // } else {
    //   echo 'Not Authorized.';
    // }
  }
  
  public function create()
  {
    // get current logged in user
    $user = Auth::user();
    if ($user->can('create', Post::class)) {
      echo 'Current logged in user is allowed to create new posts.';
    } else {
      echo 'Not Authorized';
    }
    exit;
  }

  /* Make sure you don't user Gate and Policy altogether for the same Model/Resource */
  
  public function edit()
  {
    $post = Post::find(93);
 
    if (Gate::allows('update-post', $post)) {
      echo 'Allowed Edit Post';
    } else {
      echo 'Not Allowed Edit Post ';
    }
    exit;
  }
  
  public function update()
  {
    // get current logged in user
    $user = Auth::user();
    // load post
    $post = Post::find(1);
    if ($user->can('update', $post)) {
      echo "Current logged in user is allowed to update the Post: {$post->id}";
    } else {
      echo 'Not Authorized.';
    }
  }
  
  public function delete()
  {
    // get current logged in user
    $user = Auth::user();
    // load post
    $post = Post::find(1);
    if ($user->can('delete', $post)) {
      echo "Current logged in user is allowed to delete the Post: {$post->id}";
    } else {
      echo 'Not Authorized.';
    }
  }
}
