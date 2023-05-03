@extends('layouts.page_layout')

@section('title')
  <title>Licitation Details</title>
@endsection

@section('header')
  <h1>Licitation Details</h1>
@endsection

@section('content')
  <br>
  <ul>
    <h3>{{$licitation->manufacturer}} {{$licitation->model}} &lpar;{{$licitation->year}}&rpar;</h3>
    <p><img src="{{asset($licitation->photo_path)}}" width="500px"></p>
    <p>Author: <a href="/user_profile/{{$user->id}}">{{$user->name}}</a> &emsp; Ends: {{$licitation->end}} &emsp; Views: {{$licitation->views}}</p>
    <ul>
      <li>Starting bid: £{{$licitation->min_bid}}</li>
      @if($current_bid)
        <li>Current bid: £{{$current_bid}}</li>
      @else
        <li>Current bid: None</li>
      @endif
      @if($licitation->buy_price)
        <li>Buy price: £{{$licitation->buy_price}}</li>
      @else
        <li>Buy price: None</li>
      @endif
    </ul>
    <p>Description: {{$licitation->description}}</p>
    <ul>
      <li>Mileage: {{$licitation->mileage}} miles</li>
      <li>Fuel: {{$licitation->fuel}}</li>
      <li>Transmission: {{$licitation->transmission}}</li>
      <li>Engine size: {{$licitation->engine_size}} litres</li>
      <li>Horse power: {{$licitation->horse_power}} hp</li>
    </ul>
    <p>Comments:</p>
    <ul>
      @foreach($comments as $comment)
        <li>
          @if($comment->user_id == auth()->user()->id || $is_user_author)
            <form method="POST" action="{{route('delete_comment', ['id' => $comment->id, 'licitation_id' => $licitation->id])}}">
              @csrf
              @method('DELETE')
              <a href="/user_profile/{{$comment->user_id}}">{{$all_users->where('id', '==', $comment->user_id)->first()->name}}</a> &lsqb;{{$comment->created_at}}&rsqb;: {{$comment->comment}}
              <button type="submit">Delete comment</button>
            </form>
          @else
            <a href="/user_profile/{{$comment->user_id}}">{{$all_users->where('id', '==', $comment->user_id)->first()->name}}</a> &lsqb;{{$comment->created_at}}&rsqb;: {{$comment->comment}}
          @endif
        </li>
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
        <button type="submit">Delete licitation</button>
      </form>
    @endif
    <br><br>
  </ul>
@endsection