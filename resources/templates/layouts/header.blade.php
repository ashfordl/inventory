<div>
    <h3>Inventory</h3>

    <ul>
        @if(\Auth::check())
            <li><a href="{{ action('InventoryController@getIndex') }}">Home</a></li>
            <li><a href="{{ action('Auth\AuthController@getLogout') }}">Logout</a></li>
        @else
            <li><a href="{{ action('Auth\AuthController@getLogin') }}">Login</a></li>
            <li><a href="{{ action('Auth\AuthController@getRegister') }}">Register</a></li>
        @endif
    </ul>
</div>
