@extends('layouts.master-advance')
@section('container')
    {!!Html::style('/css/objave.css')!!}

    <h1 class="col-sm-12"></h1>
    <h1>Takmičari</h1>
    <hr>

    @foreach($takmicari as $takmicar)

            <div class="row">

                <div class="col-xs-12">
                    <a href="/takmicari/profil/{{$takmicar->slug}}">
                        <h2 class="col-xs-8">{{$takmicar->ime}} {{$takmicar->prezime}}</h2>
                    </a>
                    @if(Auth::check())
                    <div class="col-xs-4" align="right">
                        <a  href="/takmicari/izmeni/{{$takmicar->slug}}" class="btn btn-lg btn-default atr">
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
                    <h2 class="col-xs-8">Rodjen: {{date('d.m.Y ',strtotime($takmicar->datum_rodjenja))}}</h2>
                    <h2 class="col-xs-8">{!! $takmicar->opste_informacije !!}</h2>
                </div>

            </div>

            <hr>
    @endforeach
    <div class="col-sm-12" align="center">{!! $takmicari->links() !!}</div>
@endsection


