@extends('layouts.master')

@section('content')
    <h1>Inventory</h1>
    Please <a href="{{ url('auth/login') }}">log in</a> or <a href="{{ url('auth/register') }}">register</a> to use this site.
@stop