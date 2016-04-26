@extends('layouts.master')
@section('body')
    <div class="container">
        @if(!sizeof($galerije))
            <h3>Ni jedna galerija ne postoji u evidenciji.</h3>
        @else
            <style>
                .col-xs-12 img{width: 100%}
            </style>
            @foreach($galerije as $galerija)
                <div class="col-xs-4">
                    <div class="col-xs-12">
                        <a href="{{$galerija['galerija']}}"><img src="{{$galerija->foto?$galerija->foto:'/img/default/foto-objave.jpg'}}"></a>
                    </div>
                    <div class="col-xs-12">
                        <h2><a href="{{$galerija['galerija']}}">{{$galerija['naslov']}}</a></h2>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection