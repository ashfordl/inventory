@extends('layouts.master')

@section('content')
    <h1>{{{ $project->name }}}</h1>
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
@stop