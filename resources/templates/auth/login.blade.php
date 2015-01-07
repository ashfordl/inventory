<h1>Login</h1>

<form method="post" action="{{ url('auth/login') }}">

{{ $errors->first() === null ? "no errors" : $errors->first() }}

<input type="hidden" name="_token" value="{{ csrf_token() }}" />

Email
<input type="email" name="email" />

Password
<input type="password" name="password" />

<input type="submit" value="Submit" />

</form>