@extends('layouts.master-advance')
@section('container')
    <style>
        img{width: 100%}
    </style>

    <h1 class="col-sm-12"></h1>
    <h1>Takmičar</h1>
    <hr>

        <div class="row">

            <div class="col-xs-12">
                <a href="/takmicari/{{$takmicar->slug}}">
                    <h2 class="col-xs-8">{{$takmicar->ime}} {{$takmicar->prezime}}</h2>
                </a>
                @if(Auth::check())
                <div class="col-xs-4" align="right">
                    <a  href="/takmicari/takmicar/{{$takmicar->slug}}" class="btn btn-lg btn-default atr">
                        <i class="glyphicon glyphicon-pencil"></i>
                    </a>
                    <a  href="/takmicari/ukloni/{{$takmicar->slug}}" class="btn btn-lg btn-default atr">
                        <i class="glyphicon glyphicon-remove"></i>
                    </a>
                </div>
                @endif
            </div>

            <div class="col-xs-12">
                <div class="col-xs-4"><img css="img-thumbnail" src="{{$takmicar->foto}}"></div>
                <h2 class="col-xs-8">Rodjen: {{$takmicar->datum_rodjenja}}</h2>
                <h2 class="col-xs-8">{!! $takmicar->opste_informacije !!}</h2>
            </div>

        </div>


@endsection

