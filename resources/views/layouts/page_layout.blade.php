<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @yield('title')
    </head>
    <body class="antialiased">
		@include('elements.navbar')
    @yield('header')
    @if(session('message'))
      <p><b>{{session('message')}}</b></p>
    @endif
    @if($errors->any())
      <ul>
        <u>Errors:</u>
        <ul>
          @foreach($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
      </ul>
    @endif
		@yield('content')
    </body>
</html>
