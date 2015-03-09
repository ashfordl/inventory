<!-- Google's CDN link to JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<!-- Additional boilerplate javascript needed on mulitple pages -->
<script src="javascript/boilerplate.js"></script>

<!-- The request's CSRF token -->
<script> var csrf = '{{ csrf_token() }}'; </script>

@yield('javascript')
