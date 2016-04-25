@extends('admin.master')
@section('container')
    <style>
        img{width: 100%}
    </style>

    <h1 class="col-sm-12">Takmičari</h1>

    @foreach($takmicari as $takmicar)
        <div class="panel panel-default">
            <div class="panel-heading">

            <div class="row">
                <h2 class="col-sm-8">{{$takmicar->ime}} {{$takmicar->prezime}}</h2>
                <div class="col-sm-4" align="right">
                    <a  href="/takmicari/takmicar/{{$takmicar->slug}}" class="btn btn-lg btn-default atr">
                        <i class="glyphicon glyphicon-pencil"></i>
                    </a>
                </div>

            </div>

            </div>
            <div class="panel-body">
                <div class="col-sm-4"><img class="img-thumbnail" src="{{$takmicar->foto}}"></div>
                <h2 col-sm-4>{{$takmicar->datum_rodjenja}}</h2>
                <h2 col-sm-4>{!! $takmicar->opste_informacije !!}</h2>
            </div>
        </div>



    @endforeach
@endsection