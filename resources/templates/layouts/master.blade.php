<html>
    <head>
        <title>
            @section('title')
                Inventory
            @show
        </title>
        <base href="{{ URL::to('/') }}/public" />
    </head>
    <body>
    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')
    </body>
</html>