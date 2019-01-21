<!-- Date/Time -->
<p>Posted on {{ date('d F Y', strtotime($post->created_at)) }}</p>
<hr>

<img class="img-fluid rounded" src="/images/{{ $post->pictures[0]->file_name }}" alt="">

<!-- Post Content -->
<p class="lead">{{ $post->content }}</p>
<hr>
<p>Category: <a href="{{ route('blog.category', $post->category->id) }}">{{ $post->category->name }}</a></p>