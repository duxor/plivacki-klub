<?php if(!isset($takmicar)) $takmicar=null; ?>
@extends('admin.master')
@section('container')
    {!!Html::style('/datepicker/datetimepicker.css')!!}
    {!!Html::script('/datepicker/moment.js')!!}
    {!!Html::script('/datepicker/datetimepicker.js')!!}
    {!!Html::style('/trumbowyg/ui/trumbowyg.min.css')!!}
    {!!Html::script('/trumbowyg/trumbowyg.min.js')!!}

    <style>
         img{width: 100%;}
        .mt20{margin-top: 20px}
    </style>

    @if (Session::has('poruka'))
        <h3 class="alert alert-success" align="center">{{ Session::get('poruka') }}</h3>
    @endif
    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!!Form::model($takmicar,['files'=>true, 'class'=>'form-horizontal'])!!}
        <h1 class="col-sm-12">Dodavanje takmičara</h1>
        <div class="col-sm-4">
            <img id="slikaTakmicara" alt="Slika takmicara" @if(isset($takmicar['foto'])) src="{{$takmicar['foto']}}" @else src="/img/default/foto-takmicari.jpg" @endif onclick="unesiFoto()">
            {!!Form::file('foto',['onchange'=>'prikaziFoto(this)','style'=>'display:none'])!!}
        </div>

        {!! Form::hidden('foto_pomocna',$takmicar ? $takmicar->foto : '') !!}
        <div class="col-sm-8 mt20">{!!Form::text('ime',null,['class'=>'form-control','placeholder'=>'Ime'])!!}</div>
        <div class="col-sm-8 mt20">{!!Form::text('prezime',null,['class'=>'form-control','placeholder'=>'Prezime'])!!}</div>
        <div class="col-sm-8 mt20">{!!Form::text('datum_rodjenja',null,['class'=>'form-control','id'=>'datetimepicker','placeholder'=>'Datum rodjenja'])!!}</div>
        <div class="col-sm-8 mt20">{!!Form::text('registracioni_broj',null,['class'=>'form-control','placeholder'=>'Registracioni broj'])!!}</div>
        <div class="col-sm-12 mt20">{!!Form::textarea('opste_informacije',null,['class'=>'','placeholder'=>'Opšte informacije'])!!}</div>
        <div class="col-sm-12 mt20 " align="center">{!!Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Sačuvaj',['type'=>'submit', 'class'=>'btn btn-lg btn-primary ','data-toggle'=>'tooltip','title'=>'Preporuka: proverite da li ste uneli sve podatke.'])!!}</div>
    {!! Form::close() !!}

    <script>
        function unesiFoto(){$('[name=foto]').click()}
        function prikaziFoto(fotoFajl){
            if (fotoFajl.files && fotoFajl.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#slikaTakmicara').attr('src',e.target.result);
                }
                reader.readAsDataURL(fotoFajl.files[0]);
            }
        }


        $(function () {
            $('textarea').trumbowyg();
            $('#datetimepicker').datetimepicker();
            $('#datetimepicker').data('DateTimePicker').locale('sr').format('DD.MM.Y. HH:mm:ss');
            $('[data-toggle=tooltip]').tooltip();
            @if(isset($takmicar['datum_rodjenja'])) $('#datetimepicker').val('{{$takmicar['datum_rodjenja']}}'); @endif
        });
    </script>

@endsection


