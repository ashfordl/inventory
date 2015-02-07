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

    @if (isset($items) && !empty($items))
    <h3>Your Inventory</h3>
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
    @endif

    @if (isset($nostock) && !empty($nostock))
    <h3>Out of Stock</h3>
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
    @endif
@stop