@extends('layouts.page_layout')

@section('title')
  <title>Create Licitation</title>
@endsection

@section('header')
  <h1>Create Licitation</h1>
@endsection

@section('content')
  <br>
  <ul class="create-form">
    <form method="POST" enctype="multipart/form-data" action="/">
      @csrf
      <p>Licitation duration: <input type="text" name="duration" value="{{old('duration')}}"> day&lpar;s&rpar;</p>
      <p>Starting bid: £<input type="text" name="min_bid" value="{{old('min_bid')}}"></p>
      <p>Buy price &lpar;optional&rpar;: £<input type="text" name="buy_price" value="{{old('buy_price')}}"></p>
      <br>
      <p>Car's photo: <input type="file" name="photo"></p>
      <p>Car's manufacturer: <input type="text" name="manufacturer" value="{{old('manufacturer')}}"></p>
      <p>Car's model: <input type="text" name="model" value="{{old('model')}}"></p>
      <p>Year of production: <input type="text" name="year" value="{{old('year')}}"></p>
      <p>Car's mileage: <input type="text" name="mileage" value="{{old('mileage')}}"> miles</p>
      <p>
        Car's fuel type: 
        <input type="radio" id="petrol" name="fuel" value="Petrol" @if(old('fuel') == "Petrol") checked @endif>
        <label for="petrol">Petrol</label>
        <input type="radio" id="diesel" name="fuel" value="Diesel" @if(old('fuel') == "Diesel") checked @endif>
        <label for="diesel">Diesel</label>
      </p>
      <p>
        Car's transmission: 
        <input type="radio" id="manual" name="transmission" value="Manual" @if(old('transmission') == "Manual") checked @endif>
        <label for="manual">Manual</label>
        <input type="radio" id="automatic" name="transmission" value="Automatic" @if(old('transmission') == "Automatic") checked @endif>
        <label for="automatic">Automatic</label>
      </p>
      <p>Engine size: <input type="text" name="engine_size" value="{{old('engine_size')}}"> litres</p>
      <p>Horse power: <input type="text" name="horse_power" value="{{old('horse_power')}}"> hp</p>
      <p>Car's description: <input type="text" name="description" size="25" value="{{old('description')}}"></p>
      <br>
      <div class="create-form-buttons">
        <input type="submit" value="Submit">
        <a class="cancel-button" href="/">Cancel</a>
      </div>
    </form>
  </ul>
  <br><br>
@endsection