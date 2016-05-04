@extends('layouts.master-advance')
@section('container')
<style>
    .img{width: 100%}
    .pl0{padding-left: 0px}
</style>
    <h1 class="col-xs-10 pl0">{{$objava->naslov}}</h1>
        <div class="col-xs-1">
            @if($admin)
                <a href="/administracija/objava/{{$objava->slug}}" class="btn btn-lg btn-default atr">
                    <i class="glyphicon glyphicon-pencil"></i>
                </a>
            @endif
        </div>
        <br clear="all">
    <p>{{$objava->datum}}</p>
    <div class="col-xs-4 pl0"><img class="img" src="{{$objava->foto?$objava->foto:'/img/default/foto-objave.jpg'}}" alt="{{$objava->naslov}}"></div>
    {!!$objava->sadrzaj!!}
    @if($objava->dodaci)
        <p>Dodaci:</p>
        <ul>
            @foreach($objava->dodaci as $dodatak)
                <li><a href="http://localhost:8000/img/objava/{{$dodatak}}" target="_blank">{{$dodatak}}</a></li>
            @endforeach
        </ul>
    @endif
@endsection