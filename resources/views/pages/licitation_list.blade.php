@extends('layouts.page_layout')

@section('title')
  <title>Car Licitations</title>
@endsection

@section('header')
  <h1>Car Licitations</h1>
@endsection

@section('content')
  <br>
  @foreach ($licitations as $licitation)
    <h3>{{$licitation->manufacturer}} {{$licitation->model}} &lpar;{{$licitation->year}}&rpar;</h3>
    <p><img src="{{asset($licitation->photo_path)}}" width="500px"></p>
    <p>Author: <a href="/user_profile/{{$licitation->user_id}}">{{$users->where('id', '==', $licitation->user_id)->first()->name}}</a> &emsp; Ends: {{$licitation->end}} &emsp; Views: {{$licitation->views}}</p>
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
  @if($licitations->first() == null)
    <p>None</p>
  @endif
  <br><br>
@endsection
