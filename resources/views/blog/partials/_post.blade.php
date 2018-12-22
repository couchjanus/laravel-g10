<div class="post-preview">
        <a href="/blog/{{$post->slug}}">
          <h2 class="post-title">{{$post->title}} </h2>
          </a>
          <p class="post-subtitle"> {{ str_limit($post->content, 50) }}</p>
        <p class="post-meta">Posted by  <a href="#">Janus </a> {{ $post->created_at }}</p>
        <a href="{!! route('post.show', $post->slug) !!}"
          class="btn btn-info">Continue reading</a>
     
</div>
<hr>
