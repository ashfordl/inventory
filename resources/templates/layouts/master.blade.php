<html>
    <head>
        <title>
            @section('title')
                Inventory
            @show
        </title>
    </head>
    <body>
    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')
    </body>
</html>