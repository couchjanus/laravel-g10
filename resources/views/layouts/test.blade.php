<!-- Stored in resources/views/layouts/test.blade.php -->

<html>
    <head>
        <title>App Name - @yield('title')</title>
    </head>
    <body>

    {{-- start & end with --}}

    {{--
        ...
        -- Here's a big long comment block --
        ...
    --}

    {{-- of course, you can have single line comments too --}}

        <div class="container">
            @php
                // code php
                echo "Hello PHP!";
            @endphp

            @yield('content')
        </div>
    </body>
</html>
