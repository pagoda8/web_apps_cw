<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"/>
        <link rel="stylesheet" href="{{asset('css/main.css')}}">
        @if(auth()->check())
          <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
          <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
          <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
          <script>
            var pusher = new Pusher('a3986f2cb7850223506b', {
              cluster: 'eu'
            });

            var id = {{auth()->user()->id}};
            var channel = pusher.subscribe('user-channel-'.concat(id));

            channel.bind('bid-event', function(data) {
              toastr.info("A new bid of £" + data.bid + " was placed on " + data.name, "", {positionClass: 'toast-top-right'});
            });
            channel.bind('comment-event', function(data) {
              toastr.info("A new comment was posted on " + data.name, "", {positionClass: 'toast-top-right'});
            });
          </script>
        @endif
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
