@extends('admin.master')
@section('container')
    <style>
        img{width: 100%}
    </style>
    <h1>Objave</h1>
    @foreach($objave as $objava)
        <div class="row">
            <div class="col-xs-4">
                <img src="{{$objava->foto}}" alt="{{$objava->naslov}}">
            </div>
            <div class="col-xs-8">
                <h2></h2>
            </div>
        </div>
    @endforeach
@endsection