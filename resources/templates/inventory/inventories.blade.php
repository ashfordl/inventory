@extends('layouts.master')

@section('content')
    <h1>Home</h1>

    <h3>Projects</h3>
    <ul>
        <li><a href="{{ action('InventoryController@getSpares') }}">Spare components</a></li>
        @foreach($user->projects as $project)
            <li><a href="{{ action('InventoryController@getProject', $project->id) }}">{{{ $project->name }}}</a></li>
        @endforeach
    </ul>

    <h3>Your Inventory</h3>
    <a href="{{ route('item_new') }}">Add new item</a>
    @if (isset($items) && !empty($items))
    <table>
        <tr>
            <th>Item</th>
            <th>Category</th>
            <th>Quantity</th>
        </tr>
        @foreach($items as $item)
            <tr>
                <td><a href="{{ action('InventoryController@getItem', $item->id) }}">{{{ $item->name }}}</a></td>
                <td>{{{ $item->category }}}</td>
                <td>{{{ $item->quantity }}}</td>
            </tr>
        @endforeach
    </table>
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
                <td><a href="{{ action('InventoryController@getItem', $item->id) }}">{{{ $item->name }}}</a></td>
                <td>{{{ $item->category }}}</td>
            </tr>
        @endforeach
    </table>
    @else
    <p>No items out of stock</p>
    @endif
@stop