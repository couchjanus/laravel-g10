<!-- Date/Time -->
<p>Posted on {{ date('d F Y', strtotime($post->created_at)) }}</p>
<hr>
<!-- Post Content -->
<p class="lead">{{ $post->content }}</p>
<hr>
<p>Category: <a href="{{ route('blog.category', $post->category->id) }}">{{ $post->category->name }}</a></p>