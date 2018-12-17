@extends('layouts.admin')

@section('content')
    <div class="container">

        @if (Session::get('message') != Null)
        <div class="row">
            <div class="col-md-9">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ Session::get('message') }}
                </div>
            </div>
        </div>
        @endif
    
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit article</div>
                    <div class="panel-body">
                        <a href="{{ route('posts.index') }}" class="btn btn-success btn-sm" title="All Posts">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back
                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <form action="{{ route('posts.update',['id' => $post->id]) }}" method="post">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="card">
                                    
                                    <div class="card-block">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input name="title" class="form-control" type="text" value="{{ $post->title }}" placeholder="title of article">
                                        </div>

                                        <div class="form-group">
                                            <label for="content">Content</label>
                                            <textarea name="content" class="form-control" rows="10">{{ $post->content }}</textarea>
                                        </div>
                                        <div class="form-group">

                                            <label for="category_id">Select Category</label>
                                            
                                            <select name="category_id" class="form-control selectpicker">
                                            @foreach ($categories as $key => $value)
                                                <option value="{{ $key }}"
                                                @if ($key == old('category_id', $post->category_id))
                                                    selected="selected"
                                                @endif
                                                >{{ $value }}</option>
                                            @endforeach
                                            </select>
                                            
                                        </div>

                                    </div>
                                    <div class="card-footer text-muted">
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
@endsection