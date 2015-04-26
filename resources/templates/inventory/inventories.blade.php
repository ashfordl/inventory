@extends('layouts.master')

@section('content')
    <h1>Home</h1>

    <h2>Projects</h2>
        @if ($user->hasSpares())
            <ul>
            <li><a href="{{ route('spares') }}">Spare components</a></li>
        @elseif (empty($user->projects))
            <p>No projects</p>
        @else
            <ul>
        @endif

        @foreach($user->projects as $project)
            <li><a href="{{ route('project_get', $project->id) }}">{{{ $project->name }}}</a></li>
        @endforeach
        </ul>

    @include('inventory.homepage.project-form')

    <h2>Your Inventory</h2>
    <a href="{{ route('item_new') }}">Add new item</a>
    @if (isset($items) && !empty($items))
    <div id="items-searchable">
        <input class="search" placeholder="Search..." />
        <h4>Sort by</h4>
        <button class="sort" data-sort="name">Name</button>
        <button class="sort" data-sort="category">Category</button>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Category</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody class="list">
                @foreach($items as $item)
                    <tr>
                        <td class="name"><a href="{{ route('item_get', $item->id) }}">{{{ $item->name }}}</a></td>
                        <td class="category">{{{ $item->category }}}</td>
                        <td class="quantity">{{{ $item->quantity }}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p>No items in inventory</p>
    @endif

    <h3>Out of Stock</h3>
    @if (isset($nostock) && !empty($nostock))
    <table>
        <tr>
            <th>Item</th>
            <th>Category</th>
        </tr>
        @foreach($nostock as $item)
            <tr>
                <td><a href="{{ route('item_get', $item->id) }}">{{{ $item->name }}}</a></td>
                <td>{{{ $item->category }}}</td>
            </tr>
        @endforeach
    </table>
    @else
    <p>No items out of stock</p>
    @endif
@stop

@section('javascript')
    <script src="javascript/lib/list.js"></script>
    <script>
        var searchOptions = { valueNames: ['name', 'category' ]};
        var itemsList = new List('items-searchable', searchOptions);
        itemsList.sort('name', { order: "asc" });
    </script
@stop
