@extends('layouts.page_layout')

@section('title')
  <title>User Profile</title>
@endsection

@section('header')
  <h1>User Profile</h1>
@endsection

@section('content')
  <ul>
    <p>Name: {{$user->name}}</p>
    <p>E-mail: {{$user->email}}</p>
  </ul>
  <h2>Created Licitations</h2>
  <br>
  <ul>
    @if($licitations != null)
      @foreach($licitations as $licitation)
        <h3>{{$licitation->manufacturer}} {{$licitation->model}} &lpar;{{$licitation->year}}&rpar;</h3>
        <p><img src="{{asset($licitation->photo_path)}}" width="500px"></p>
        <p>Ends: {{$licitation->end}} &emsp; Views: {{$licitation->views}}</p>
        <ul>
          <li>Starting bid: £{{$licitation->min_bid}}</li>
          @if($bids->where('licitation_id', '==', $licitation->id)->first())
            <li>Current bid: £{{$bids->where('licitation_id', '==', $licitation->id)->sortByDesc('created_at')->first()->bid}}</li>
          @else
            <li>Current bid: None</li>
          @endif
          @if($licitation->buy_price)
            <li>Buy price: £{{$licitation->buy_price}}</li>
          @else
            <li>Buy price: None</li>
          @endif
        </ul>
        <br>
        <a href="/licitation_details/{{$licitation->id}}">Show licitation details</a>
        <br><br><br>
      @endforeach
    @else
      <p>None</p>
    @endif
  </ul>
  <br><br>
@endsection