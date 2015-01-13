<h1>Welcome {{{ $user->name }}}</h1>

<h3>Components</h3>
<ul>
    <li><a href="{{ action('InventoryController@getInventory') }}">All components</a></li>
    <li><a href="{{ action('InventoryController@getSpares') }}">Spare components</a></li>
</ul>

<h3>Projects</h3>
<ul>
    @foreach($user->projects as $project)
        <li><a href="{{ action('InventoryController@getProject', $project->id) }}">{{{ $project->name }}}</a></li>
    @endforeach
</ul>
