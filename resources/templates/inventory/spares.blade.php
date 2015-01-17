<h1>Welcome {{{ $user->name }}}</h1>

<a href="{{ action('InventoryController@getIndex') }}">Home</a>
<a href="{{ action('Auth\AuthController@getLogout') }}">Logout</a>

<h3>Spares</h3>
<table>
    <tr>
        <th>Item</th>
        <th>Category</th>
        <th>Quantity</th>
    </tr>
    @foreach($items as $item)
        <tr>
            <td>{{{ $item->name }}}</td>
            <td>{{{ $item->category }}}</td>
            <td>{{{ $item->quantity }}}</td>
        </tr>
    @endforeach
</table>