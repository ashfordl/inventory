@extends('layouts.master')

@section('content')
    <h1>Register</h1>

    <form method="post" action="{{ url('auth/register') }}">
        {{ $errors->first() === null ? "no errors" : $errors->first() }}

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        Name
        <input type="text" name="name" />

        Email
        <input type="email" name="email" />

        Password
        <input type="password" name="password" />

        Confirm Password
        <input type="password" name="password_confirmation" />

        <input type="submit" value="Submit" />
    </form>
@stop