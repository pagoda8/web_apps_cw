@extends('layouts.page_layout')

@section('title')
  <title>User Profile</title>
@endsection

@section('content')
  <h1>User Profile</h1>
  <p>User with ID: {{$id}}</p>
@endsection