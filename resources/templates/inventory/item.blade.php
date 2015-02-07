@extends('layouts.master')

@section('title') @parent -
    {{ $item->name or "New Item" }}
@stop

@section('content')
    <h1>{{ $item->name or "New Item" }}</h1>

    <form method="post" action="{{ action('InventoryController@postItem', isset($item) ? $item->id : -1) }}">
        {{ $errors->first() === null ? "no errors" : $errors->first() }}

        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

        Name
        <input type="text" name="item" value="{{{ $item->name or "" }}}" />

        Category
        <select>
            @foreach ($categories as $category)
                <option @if (isset($item->category->id) && $category->id == $item->category->id) {{ 'selected' }} @endif
                 value="{{ $category->id }}">{{{ $category->name }}}</option>
            @endforeach
        </select>

        @if (!empty($references))
            <table>
                <tr>
                    <td><h4>Project</h4></td>
                    <td><h4>Quantity</h4></td>
                </tr>

                @foreach ($references as $reference)
                    <tr>
                        <td>{{{ $reference->project->name or "Spares" }}}</td>
                        <td><input type="number" min="0" value="{{ $reference->quantity or 0 }}" /></td>
                    </tr>
                @endforeach
            </table>
        @endif

        @if (!empty($projects) || $hasSpares)
            <select>
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}">{{{ $project->name }}}</option>
                @endforeach

                @if ($hasSpares)
                    <option value="-1">Spares</option>
                @endif
            </select>
            <input type="number" min="0" value="0" />
        @endif

        <input type="submit" value="Submit" />
    </form>
@stop