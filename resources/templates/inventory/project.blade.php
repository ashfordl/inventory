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
    @foreach($references as $reference)
        <tr>
            <td>{{{ $reference->item->name }}}</td>
            <td>{{{ $reference->item->category->name }}}</td>
            <td>{{{ $reference->quantity }}}</td>
        </tr>
    @endforeach
</table>