@extends('layouts.master')

@section('content')
    {{ $errors->first() === null ? "" : $errors->first() }}
    <h1 id="project-name-header">{{{ $project->name }}}</h1>

    <button id="project-edit">Edit</button>

    <table>
        <tr>
            <th>Item</th>
            <th>Category</th>
            <th>Quantity</th>
        </tr>
        @foreach($references as $reference)
            <tr>
                <td><a href="{{ route('item_get', $reference->item->id) }}">{{{ $reference->item->name }}}</a></td>
                <td>{{{ $reference->item->category->name }}}</td>
                <td>{{{ $reference->quantity }}}</td>
            </tr>
        @endforeach
    </table>
@stop

@section('javascript')
     <script>
        var projectId = {{ $project->id }};
        var postRoute = "{{ route('project_post', $project->id) }}";
     </script>
     <script src="javascript/project.js"></script>
@stop
