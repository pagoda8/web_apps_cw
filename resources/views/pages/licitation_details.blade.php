@extends('layouts.page_layout')

@section('title')
  <title>Licitation Details</title>
@endsection

@section('header')
  <h1>Licitation Details</h1>
@endsection

@section('content')
  <br>
  <h3>{{$licitation->manufacturer}} {{$licitation->model}} &lpar;{{$licitation->year}}&rpar;</h3>
  <p><img src="{{asset($licitation->photo_path)}}" width="500px"></p>
  <p>Author: <a href="/user_profile/{{$user->id}}">{{$user->name}}</a> &emsp; Ends: {{$licitation->end}} &emsp; Views: {{$licitation->views}}</p>
  <p>Starting bid: £{{$licitation->min_bid}}</p>
  @if($current_bid)
    <p>Current bid: £{{$current_bid}}</p>
  @else
    <p>Current bid: None</p>
  @endif
  @if($licitation->buy_price)
    <p>Buy price: £{{$licitation->buy_price}}</p>
  @else
    <p>Buy price: None</p>
  @endif
  <br>
  <p><u>Car info:</u></p>
  <p>Description: {{$licitation->description}}</p>
  <p>Mileage: {{$licitation->mileage}} miles</p>
  <p>Fuel: {{$licitation->fuel}}</p>
  <p>Transmission: {{$licitation->transmission}}</p>
  <p>Engine size: {{$licitation->engine_size}} litres</p>
  <p>Horse power: {{$licitation->horse_power}} hp</p>
  <br>
  <p><u>Bids:</u></p>
  <ul>
    @foreach($bids as $bid)
      <p><a href="/user_profile/{{$bid->user_id}}">{{$all_users->where('id', '==', $bid->user_id)->first()->name}}</a> &lsqb;{{$bid->created_at}}&rsqb;: £{{$bid->bid}}</p>
    @endforeach
    @if($bids->first() == null)
      <p>None</p>
    @endif
    <form method="POST" action="{{route('place_bid', ['licitation_id' => $licitation->id])}}">
      @csrf
      <p>
        £<input type="text" name="bid" value="{{old('bid')}}">
        <input type="submit" value="Place bid">
      </p>
    </form>
  </ul>
  <br>
  <p><u>Comments:</u></p>
  <ul>
    @foreach($comments as $comment)
      <p>
        @if($comment->user_id == auth()->user()->id || $is_user_author)
          <form method="POST" action="{{route('delete_comment', ['id' => $comment->id, 'licitation_id' => $licitation->id])}}">
            @csrf
            @method('DELETE')
            <a href="/user_profile/{{$comment->user_id}}">{{$all_users->where('id', '==', $comment->user_id)->first()->name}}</a> &lsqb;{{$comment->created_at}}&rsqb;: {{$comment->comment}}
            &ensp;
            <button class="delete-button" type="submit">Delete comment</button>
          </form>
        @else
          <a href="/user_profile/{{$comment->user_id}}">{{$all_users->where('id', '==', $comment->user_id)->first()->name}}</a> &lsqb;{{$comment->created_at}}&rsqb;: {{$comment->comment}}
        @endif
      </p>
    @endforeach
    @if($comments->first() == null)
      <p>None</p>
    @endif
    <form method="POST" action="{{route('add_comment', ['id' => $licitation->id])}}">
      @csrf
      <p>
        <input type="text" name="comment" size="50" value="{{old('comment')}}">
        <input type="submit" value="Add comment">
      </p>
    </form>
  </ul>
  @if($is_user_author)
    <form method="POST" action="{{route('delete_licitation', ['id' => $licitation->id])}}">
      @csrf
      @method('DELETE')
      <br>
      <button class="delete-button" type="submit">Delete licitation</button>
    </form>
  @endif
  <br><br>
@endsection