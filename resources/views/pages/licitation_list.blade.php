@extends('layouts.page_layout')

@section('title')
  <title>Car Licitations</title>
@endsection

@section('content')
  <h1>Car Licitations</h1>
  <br>
  <ul>
    @foreach ($licitations as $licitation)
      <h3>{{$licitation->manufacturer}} {{$licitation->model}} &lpar;{{$licitation->year}}&rpar;</h3>
      <p><img src="{{asset($licitation->photo_path)}}" width="500px"></p>
      <p>Author: <a href="/user_profile/{{$licitation->user_id}}">{{$users->where('id', '==', $licitation->user_id)->first()->name}}</a> &emsp; Ends: {{$licitation->end}} &emsp; Views: {{$licitation->views}}</p>
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
    @if($licitations->first() == null)
      <p>None</p>
    @endif
  </ul>
@endsection
