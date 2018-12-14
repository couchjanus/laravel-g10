<!DOCTYPE html>
<!-- Stored in resources/views/layouts/master.blade.php -->
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="/favicon.ico">

        {{--CSRF Token--}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <script type="text/javascript">
            var _token = '{!! csrf_token() !!}';
            var _url = '{!! url("/") !!}';
            var _appTimeZone = '{!! config('app.timezone', 'UTC') !!}';
        </script>

        {{--Title and Meta--}}
        <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

        @include('layouts.partials._meta')

        @yield('meta')

        {{--Common App Styles--}}
        @include('layouts.partials._styles')

        {{--Styles--}}
        @yield('styles')

        {{--Head--}}
        @yield('head')

    </head>
    <body class="@yield('body_class')">

        {{--Page--}}
        <div class="container">
            @yield('header')
            @yield('navigation')
            @yield('jumbotron')
            @yield('breakingnews')
        </div>

        <!-- Page Content -->
        @yield('breadcrumb')

        <div class="container">
            @yield('page')
        </div>

        @yield('footer')
        {{--Common Scripts--}}

        @include('layouts.partials._scripts')
        {{--Laravel Js Variables--}}

        {{--Scripts--}}
        @yield('scripts')

    </body>
</html>
