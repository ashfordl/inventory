<h1>Welcome {{{ $user->name }}}</h1>

<a href="{{ action('Auth\AuthController@getLogout') }}">Logout</a>

<h3>Projects</h3>
<ul>
    <li><a href="{{ action('InventoryController@getSpares') }}">Spare components</a></li>
    @foreach($user->projects as $project)
        <li><a href="{{ action('InventoryController@getProject', $project->id) }}">{{{ $project->name }}}</a></li>
    @endforeach
</ul>


<h3>Your Inventory</h3>
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