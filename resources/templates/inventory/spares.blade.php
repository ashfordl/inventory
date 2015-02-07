@extends('layouts.master')

@section('content')
    <h1>Spare Components</h1>
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
@stop