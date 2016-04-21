@extends('layouts.master')
@section('body')
<style>
    .img{width: 100%}
    .pl0{padding-left: 0px}
</style>
<div class="container">
    <h1 class="col-xs-10">{{$objava->naslov}}</h1>
    @if(isset($admin))
        <div class="col-xs-1">
            <a href="/administracija/objava/{{$objava->slug}}" class="btn btn-lg btn-default atr">
                <i class="glyphicon glyphicon-pencil"></i>
            </a>
        </div>
    @endif
    <p>{{$objava->datum}}</p>
    <div class="col-xs-4 pl0"><img class="img" src="{{$objava->foto}}" alt="{{$objava->naslov}}"></div>
    {!!$objava->sadrzaj!!}
    @if($objava->dodaci)
        <p>Dodaci:</p>
        <ul>
            @foreach($objava->dodaci as $dodatak)
                <li><a href="http://localhost:8000/img/objava/{{$dodatak}}" target="_blank">{{$dodatak}}</a></li>
            @endforeach
        </ul>
    @endif
</div>
@endsection