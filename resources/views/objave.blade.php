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
                        <button data-href="/administracija/objava/{{$objava->slug}}/ukloni" class="btn btn-danger ukloniObjavu" data-toggle="tooltip" title="Ukloni objavu">
                            <i class="glyphicon glyphicon-trash"></i>
                        </button>
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
    @if($admin)
        {!!Html::script('/js/objave-admin.js')!!}
        <div class="modal fade" id="sigurniSte">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="alert alert-danger">Da li ste sigurni da želite da uklonite <span id="naslovObjave"></span>? Nakon toga nećetze biti u mogućnosti da je vratite.</h3>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Otkaži</button>
                        <a id="ukloniObjavu" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Ukloni</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection