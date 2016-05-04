<?php
    if(!isset($admin)) $admin=null;
    if(!isset($brojStranica)) $brojStranica=null;
    if(!isset($aktivna)) $aktivna=0;
?>
@extends('layouts.master-advance')
@section('container')
    {!!Html::style('/css/objave.css')!!}

    <h1>Vesti</h1>
    <hr>
    @foreach($objave as $i=>$objava)
        <div class="row objava @if($i>3) slideanim @endif ">
            <div class="col-xs-3">
                <a href="/{{$objava->slug}}" target="_parent">
                    <div class="img">
                        <img alt="{{$objava->naslov}}" class="img-responsive" src="{{$objava->foto?$objava->foto:'/img/default/foto-objave.jpg'}}">
                    </div>
                </a>
            </div>
            <div class="col-xs-9">
                <h2>
                    <a href="/{{$objava->slug}}">{{$objava->naslov}}</a>
                    @if($admin)
                        <a href="/administracija/objava/{{$objava->slug}}" class="btn btn-default">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                    @endif
                </h2>
                {!!$objava->sadrzaj!!}
            </div>
        </div>
    @endforeach

    @if($brojStranica)
        <nav class="text-center">
            <ul class="pagination">
                <li @if($aktivna==0) class="disabled" @endif>
                     <a @if($aktivna>0) href="/vesti/{{$aktivna-1}}" @endif aria-label="Prethodna">&laquo;</a>
                </li>
                @for($i=0;$i<$brojStranica;$i++)
                    <li @if($i==$aktivna) class="active" @endif><a href="/vesti/{{$i!=0?$i:''}}">{{$i+1}}</a></li>
                @endfor
                <li @if($aktivna==$brojStranica-1) class="disabled" @endif><a @if($aktivna<$brojStranica-1) href="/vesti/{{$aktivna+1}}" @endif aria-label="Sledeća">&raquo;</a></li>
            </ul>
        </nav>
    @endif
@endsection