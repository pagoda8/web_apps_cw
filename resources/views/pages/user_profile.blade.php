@extends('layouts.page_layout')

@section('title')
  <title>User Profile</title>
@endsection

@section('header')
  <h1>User Profile</h1>
@endsection

@section('content')
  <p>Name: {{$user->name}}</p>
  <p>E-mail: {{$user->email}}</p>
  <h2>Created Licitations</h2>
  <br>
  @if($licitations != null)
    @foreach($licitations as $licitation)
      <h3>{{$licitation->manufacturer}} {{$licitation->model}} &lpar;{{$licitation->year}}&rpar;</h3>
      <p><img src="{{asset($licitation->photo_path)}}" width="500px"></p>
      <p>Ends: {{$licitation->end}} &emsp; Views: {{$licitation->views}}</p>
      <p>Starting bid: £{{$licitation->min_bid}}</p>
      @if($bids->where('licitation_id', '==', $licitation->id)->first())
        <p>Current bid: £{{$bids->where('licitation_id', '==', $licitation->id)->sortByDesc('created_at')->first()->bid}}</p>
      @else
        <p>Current bid: None</p>
      @endif
      @if($licitation->buy_price)
        <p>Buy price: £{{$licitation->buy_price}}</p>
      @else
        <p>Buy price: None</p>
      @endif
      <a href="/licitation_details/{{$licitation->id}}">Show licitation details</a>
      <br><br><br>
    @endforeach
  @else
    <p>None</p>
  @endif
  <br><br>
@endsection