<?php
    if(!isset($objava)) $objava=null;
    if(!isset($slugEdit)) $slugEdit=null;
    ?>
@extends('admin.master')
@section('container')
    {!!Html::style('/datepicker/datetimepicker.css')!!}
    {!!Html::script('/datepicker/moment.js')!!}
    {!!Html::script('/datepicker/datetimepicker.js')!!}
    {!!Html::style('/trumbowyg/ui/trumbowyg.min.css')!!}
    {!!Html::script('/trumbowyg/trumbowyg.min.js')!!}
    @if(isset($uspesnoDodavanje))
        <div class="alert alert-success">
            <h2>{{$uspesnoDodavanje}}</h2>
        </div>
    @endif
    @if($slugEdit)
        <div class="col-sm-12">
            Izmenili ste naslov objave, a samim tim i adresu. Možete da <a href="/administracija/objava/{{$objava['slug']}}" class="btn btn-lg btn-default">nastavite</a> ažuriranje.
        </div>
    @else
        @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
        </div>
        @endif
        <style>
            .btn-file{
                position: relative;
                overflow: hidden;
            }
            .btn-file input[type=file] {
                position: absolute;
                top: 0;
                right: 0;
                min-width: 100%;
                min-height: 100%;
                font-size: 100px;
                text-align: right;
                filter: alpha(opacity=0);
                opacity: 0;
                outline: none;
                background: white;
                cursor: inherit;
                display: block;
            }
            .trumbowyg-box, .trumbowyg-editor{
                width: 100%;
            }
            img{width: 100%;}
            .mt20{margin-top: 20px}
        </style>
        <script>
            function prikaziDodatke(dodaciElement){
                if (dodaciElement.files && dodaciElement.files[0]) {
                    $('#izabraniDodaci').html('');
                    for(var i=0;i<dodaciElement.files.length;i++){
                        var reader = new FileReader();
                        reader.onload = (function(file){return function(e){
                            $('#izabraniDodaci').append('<li>'+escape(file.name)+'</li>')}})(dodaciElement.files[i]);
                        reader.readAsDataURL(dodaciElement.files[i]);
                    }
                }
            }
            function unesiFoto(){$('[name=foto]').click()}
            function prikaziFoto(fotoFajl){
                if (fotoFajl.files && fotoFajl.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#naslovnaFoto').attr('src',e.target.result);
                    }
                    reader.readAsDataURL(fotoFajl.files[0]);
                }
            }
            $(function () {
                $('textarea').trumbowyg();
                $('#datetimepicker').datetimepicker();
                $('#datetimepicker').data('DateTimePicker').locale('sr').format('DD.MM.Y. HH:mm:ss');
                $('[data-toggle=tooltip]').tooltip();
                @if(isset($objava['datum'])) $('#datetimepicker').val('{{$objava['datum']}}'); @endif
            });
        </script>
        {!!Form::model($objava,['files'=>true, 'class'=>'form-horizontal'])!!}
            <h1 class="col-sm-12">Dodaj objavu</h1>
            <div class="col-sm-4">
                <img id="naslovnaFoto" alt="Naslovna fotografija"
                @if(isset($objava['foto'])) src="{{$objava['foto']}}"
                @else src="/img/default/foto-objave.jpg" @endif onclick="unesiFoto()">
                {!!Form::file('foto',['onchange'=>'prikaziFoto(this)','style'=>'display:none'])!!}
            </div>
            <div class="col-sm-8">
                @if(isset($objava['slug']))
                    @if($objava['slug'])
                        {{$objava['naslov']}}
                        {!!Form::hidden('naslov',$objava['naslov'])!!}
                    @else
                        {!!Form::text('naslov',null,['class'=>'form-control col-sm-6','placeholder'=>'Naslov'])!!}
                    @endif
                @else
                    {!!Form::text('naslov',null,['class'=>'form-control col-sm-6','placeholder'=>'Naslov'])!!}
                @endif
            </div>
            <div class="col-sm-8 mt20">{!!Form::text('datum',null,['class'=>'form-control','id'=>'datetimepicker','placeholder'=>'Datum događaja'])!!}</div>
            <div class="col-sm-8 mt20">{!!Form::checkbox('prioritet',1,null,['class'=>''])!!} Prikaži na slajderu</div>

            <div class="col-sm-8 mt20">
                <span class="btn btn-c btn-file">
                    <i class="glyphicon glyphicon-cloud-upload"></i> Приложи додатке
                    {!!Form::file('dodaci[]',['class'=>'','multiple','onchange'=>'prikaziDodatke(this);'])!!}
                </span>
                <p><ul id="izabraniDodaci">
                @if($objava['dodaci'])
                    @foreach(json_decode($objava['dodaci']) as $dodatak)
                        <li>{{$dodatak}}</li>
                    @endforeach
                @endif
                </ul></p>
            </div>
            <div class="col-sm-8 mt20">{!!Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Sačuvaj',['type'=>'submit','class'=>'btn btn-lg btn-primary','data-toggle'=>'tooltip','title'=>'Preporuka: proverite da li ste uneli sve podatke.'])!!}</div>
            <div class="col-sm-12 mt20">{!!Form::textarea('sadrzaj',null,['class'=>'','placeholder'=>'Sadržaj'])!!}</div>

        {!!Form::close()!!}
    @endif
@endsection