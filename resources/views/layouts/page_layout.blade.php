<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"/>
        <link rel="stylesheet" href="{{asset('css/main.css')}}">
        @yield('title')
    </head>
    <body class="antialiased">
		@include('elements.navbar')
    @yield('header')
    @if(session('message'))
      <p><b>{{session('message')}}</b></p>
    @endif
    @if($errors->any())
      <p><u>Errors:</u></p>
      @foreach($errors->all() as $error)
        <p>{{$error}}</p>
      @endforeach
    @endif
		@yield('content')
    </body>
</html>
