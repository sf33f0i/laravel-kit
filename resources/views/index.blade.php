@extends('layouts.main')

@section('title')
    Geocoder
@endsection

@section('content')
    <form action="{{route('address.store')}}" method="POST">
        @csrf
        <input type="text" name="address">
        <input type="submit">
    </form>
@endsection
