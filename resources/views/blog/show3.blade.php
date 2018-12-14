@extends('layouts.blog')

<main role="main" class="container">
  <div class="row">
    @section('content')
    <!-- Blog Entries Column -->

          <div class="col-md-8 blog-main">
            <h3 class="pb-3 mb-4 font-italic border-bottom">
              {{ $post->title }}
            </h3>

            @alert(['type' => 'danger'])
                You are not allowed to access this resource now!
            @endalert


            @includeIf('blog.partials._single-post', ['post' => $post])
          </div>
          <!-- /.blog-main -->



    @endsection

    @section('sidebar')
        @include('blog.partials._sidebar')
    @endsection
  </div><!-- /.row -->

</main>
<!-- /.container -->

