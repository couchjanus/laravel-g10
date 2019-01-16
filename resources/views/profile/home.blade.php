@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <span class="badge badge-pill badge-success">Success</span> {!! $message !!}
                        </div>
                    @endif
                    You are logged in!
                    <a href="{{ route('profile.edit', ['id'=> Auth::user()->profile]) }}">Edit profile</a>

                    <a href="{{ route('blog.list') }}">My Blog Posts</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
