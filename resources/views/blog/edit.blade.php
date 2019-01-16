@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <h1 class="h2">Edit Post</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <a href="{{ route('blog.list') }}" title="All posts">
                            <button class="btn btn-sm btn-outline-success"><span data-feather="arrow-left"></span>
                                   Go Back</button>
                        </a>
                        <button class="btn btn-sm btn-outline-secondary">Export</button>
                    </div>
              
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <span data-feather="calendar"></span>
                         This week
                    </button>
                </div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <span class="badge badge-pill badge-success">Success</span> {!! $message !!}
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <form action="{{ route('blog.update',['id' => $post->id]) }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">
                <div class="card">
                    <div class="card-block">
                
                        <div class="form-group">
                                    <label for="title">Title</label>
                                    <input name="title" class="form-control" type="text" value="{{ $post->title }}" required>
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
            
            
                        <div class="form-group">
                            <label for="selectall-tag" class= 'control-label'>Select tags</label>
                            <button type="button" class="btn btn-primary btn-xs" id="selectbtn-tag">
                                        Select all
                            </button>
                            <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-tag">
                                        Deselect all
                            </button>
                                    <select name="tag[]" class="form-control select2" multiple='multiple' id='selectall-tag'>
                                        @foreach($tags as $key => $value)
                                            <option value="{{ $key }}"
                                               {{ ($post->tags->pluck('id')->contains($key)) ? 'selected':'' }}  />
                                               {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="help-block"></p>
                                    @if($errors->has('tag'))
                                        <p class="help-block">
                                            {{ $errors->first('tag') }}
                                        </p>
                                    @endif
                            </div>
            
                            <div class="form-group">
                                    <label for="is_active">Is Active</label>
                                    <input name="is_active" class="form-control" type="checkbox" checked="{{ $post->is_active }}">
                            </div>
                                
                        </div>
            
                        <div class="card-footer text-muted">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary"><span data-feather="save"></span> Save</button>
                                </div>
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @parent
    <script>
        $("#selectbtn-tag").click(function(){
            $("#selectall-tag > option").prop("selected","selected");
            $("#selectall-tag").trigger("change");
        });
        $("#deselectbtn-tag").click(function(){
            $("#selectall-tag > option").prop("selected","");
            $("#selectall-tag").trigger("change");
        });

        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection