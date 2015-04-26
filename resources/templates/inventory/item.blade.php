@extends('layouts.master')

@section('title') @parent -
    {{ $item->name or "New Item" }}
@stop

@section('content')
    <h1>{{ $item->name or "New Item" }}</h1>

    <form id="form-item" method="post" action="{{ route('item_post', isset($item) ? $item->id : -1) }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

        {{ $errors->first() === null ? "" : $errors->first() }}

        Name
        <input type="text" name="item" id="item-name" value="{{{ $item->name or "" }}}" />

        Category
        <select id="item-category">
            @foreach ($categories as $category)
                <option @if (isset($item->category->id) && $category->id == $item->category->id) {{ 'selected' }} @endif
                 value="{{ $category->id }}">{{{ $category->name }}}</option>
            @endforeach
        </select>

        @if (!empty($references))
            <table id="item-references">
                <tr>
                    <td><h4>Project</h4></td>
                    <td><h4>Quantity</h4></td>
                </tr>

                @foreach ($references as $reference)
                    <tr class="item-reference">
                        <td class="hidden reference-id">{{ $reference->project->id or -1 }}</td>
                        <td>{{ $reference->project->name or "Spares" }}</td>
                        <td><input type="number" min="0" class="reference-quantity" value="{{ $reference->quantity or 0 }}" /></td>
                    </tr>
                @endforeach
            </table>
        @endif

        @if (!empty($projects) || $hasSpares)
        <div id="reference-new-div">
            <select id="reference-new-select">
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}">{{{ $project->name }}}</option>
                @endforeach

                @if ($hasSpares)
                    <option value="-1">Spares</option>
                @endif
            </select>
            <input id="reference-new-quantity" type="number" min="0" value="0" />

            <button id="reference-new-add" type="button">Add reference</button>
        </div>
        @endif

        <input type="submit" value="Submit" />
    </form>
@stop

@section('javascript')
     <script>
        var itemId = {{ $item->id or -1 }};
     </script>
     <script src="javascript/item.js"></script>
@stop
