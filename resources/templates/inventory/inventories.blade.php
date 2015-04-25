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
    <table>
        <tr>
            <th>Item</th>
            <th>Category</th>
            <th>Quantity</th>
        </tr>
        @foreach($items as $item)
            <tr>
                <td><a href="{{ route('item_get', $item->id) }}">{{{ $item->name }}}</a></td>
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
                <td><a href="{{ route('item_get', $item->id) }}">{{{ $item->name }}}</a></td>
                <td>{{{ $item->category }}}</td>
            </tr>
        @endforeach
    </table>
    @else
    <p>No items out of stock</p>
    @endif
@stop
