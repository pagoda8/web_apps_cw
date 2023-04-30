<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @yield('title')
    </head>
    <body class="antialiased">
		@include('elements.navbar')
		@yield('content')
    </body>
</html>
