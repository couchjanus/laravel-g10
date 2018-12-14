@extends('layouts.blog')
<main role="main" class="container">
  <div class="row">
    @section('content')
    <!-- Blog Entries Column -->

          <div class="col-md-8 blog-main">
            <h3 class="pb-3 mb-4 font-italic border-bottom">
              From the Firehose
            </h3>

            @each('blog.partials._post',
                $posts,
                'post',
                'blog.partials._post-none'
            )
            <nav class="blog-pagination">
                {{ $posts->links() }}
                {{-- $posts->onEachSide(1)->links() --}}
            </nav>

          </div>
          <!-- /.blog-main -->

    @endsection

    @section('sidebar')
      @includeIf('blog.partials._sidebar', ['some' => 'data'])
      <!-- /.blog-sidebar -->
    @endsection
  </div><!-- /.row -->

</main>
<!-- /.container -->
<!-- /.row -->
