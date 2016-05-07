@extends('layouts.master-advance')
@section('container')
<style>
    .img{width: 100%}
    .pl0{padding-left: 0px}
</style>
    <h1 class="col-xs-10 pl0">{{$objava->naslov}}</h1>
        @if($admin)
            <h2 class="col-xs-2">
                <a href="/administracija/objava/{{$objava->slug}}" class="btn btn-default atr">
                    <i class="glyphicon glyphicon-pencil"></i>
                </a>
                <button data-href="/administracija/objava/{{$objava->slug}}/ukloni" class="btn btn-danger ukloniObjavu" data-toggle="tooltip" title="Ukloni objavu">
                    <i class="glyphicon glyphicon-trash"></i>
                </button>
            </h2>
            <br clear="all">
        @endif
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