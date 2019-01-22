<!-- Date/Time -->
<p>Posted on {{ date('d F Y', strtotime($post->created_at)) }}</p>
<hr>

@isset($post->pictures->file_name)
    // $records is defined and is not null...

<img class="img-fluid rounded" src="/images/{{ $post->pictures->file_name }}" alt="">
@endisset
<!-- Post Content -->
<p class="lead">{{ $post->content }}</p>
<hr>
<p>Category: <a href="{{ route('blog.category', $post->category->id) }}">{{ $post->category->name }}</a></p>