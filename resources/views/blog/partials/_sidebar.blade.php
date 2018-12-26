<aside class="col-md-4 blog-sidebar">
        <div class="p-3 mb-3 bg-light rounded">
          <h4 class="font-italic">About</h4>
          <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
        </div>

        <div class="p-3">
          <h4 class="font-italic">Archives</h4>
          <ol class="list-unstyled mb-0">
            <li><a href="#">March 2019</a></li>
            <li><a href="#">February 2019</a></li>
            <li><a href="#">January 2019</a></li>
            <li><a href="#">December 2019</a></li>
            <li><a href="#">November 2019</a></li>
            <li><a href="#">October 2019</a></li>
            <li><a href="#">September 2019</a></li>
            <li><a href="#">August 2019</a></li>
            <li><a href="#">July 2019</a></li>
            <li><a href="#">June 2019</a></li>
            <li><a href="#">May 2019</a></li>
            <li><a href="#">April 2019</a></li>
          </ol>
        </div>

        <div class="p-3">
          <h4 class="font-italic">Categories</h4>
          <ol class="list-unstyled">

            @foreach(\App\Category::all() as $category)
            <li><a href="{{ route('blog.category', $category->id) }}">{{ $category->name }}</a></li>
            @endforeach
          </ol>
        </div>


        <!-- Categories Widget -->
        @widget('categories')


        <div class="p-3">
          <h4 class="font-italic">Elsewhere</h4>
          <ol class="list-unstyled">
            <li><a href="#">GitHub</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Facebook</a></li>
          </ol>
        </div>
    </aside><!-- /.blog-sidebar -->
