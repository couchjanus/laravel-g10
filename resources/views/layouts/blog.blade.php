@extends('layouts.master')

    @section('title')
        Blog Post Title
    @endsection

    {{--Styles--}}
    @section('styles')
        <!-- Custom styles for this template -->
        <link href="{{ asset('css/blog.css') }}" rel="stylesheet">
    @endsection

    @section('header')
        @include('layouts.partials.front-end._header')
    @endsection

    @section('navigation')
       @include('layouts.partials.front-end._navigation')
    @endsection

    @section('jumbotron')
        @include('layouts.partials.front-end._jumbotron')
    @endsection

    @section('breakingnews')
        @include('layouts.partials.front-end._breakingnews')
    @endsection

    {{--Page--}}

    @section('page')
       <div class="row" id="app">
          @yield('content')
          @yield('sidebar')
       </div>
    @endsection

    @section('footer')
        @include('layouts.partials.front-end._footer')
    @endsection

    {{--Scripts--}}

    @section('scripts')
        <!-- Custom JavaScript -->
    @endsection
