<?php
    if(!isset($objava)) $objava=null;
    if(!isset($slugEdit)) $slugEdit=null;
    ?>
@extends('admin.master-admin')
@section('body')
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
        <script>
            $(function(){
                $('textarea').trumbowyg();
                $('#datetimepicker').datetimepicker();
                $('#datetimepicker').data('DateTimePicker').locale('sr').format('DD.MM.Y. HH:mm:ss');
                @if(isset($objava['datum'])) $('#datetimepicker').val('{{$objava['datum']}}'); @endif
    $('#dodajemTakmicenjeBtn').click(function(){
                    if($(this).html()=='Dodajem takmičenje'){
                        $('#objavu').html('takmičenje');
                        $('input[name=naslov]').attr('placeholder','Naziv takmičenja');
                        $('input[name=datum]').attr('placeholder','Datum takmičenja');
                        $('input[name=datum]').closest('div').after('<div class="col-sm-12 mt20"><input type="text" name="mesto" class="form-control" placeholder="Mesto takmičenja"></div>');
                        $(this).html('Dodajem objavu');
                    }else{
                        $('#objavu').html('objavu');
                        $('input[name=naslov]').attr('placeholder','Naslov');
                        $('input[name=datum]').attr('placeholder','Datum događaja');
                        $('input[name=mesto]').closest('div').remove();
                        $(this).html('Dodajem takmičenje');
                    }
                });
            });
        </script>
        {!!Form::model($objava,['files'=>true, 'class'=>'form-horizontal'])!!}
            <h1 class="col-sm-12">
                @if(isset($objava['naslov']))
                    Uredi podatke
                @else
                    Dodaj <span id="objavu">objavu</span>
                    <button id="dodajemTakmicenjeBtn" class="btn btn-default" type="button">Dodajem takmičenje</button>
                @endif
            </h1>
            <div class="col-sm-4 mt20">
                <img id="naslovnaFoto" alt="Naslovna fotografija"
                @if(isset($objava['foto'])) src="{{$objava['foto']}}"
                @else src="/img/default/foto-objave.jpg" @endif onclick="unesiFoto()">
                {!!Form::file('foto',['onchange'=>'prikaziFoto(this)','style'=>'display:none'])!!}
            </div>
            <div class="col-sm-8 mt20">
                <div class="col-sm-12">
                    @if(isset($objava['slug']))
                        @if($objava['slug']=='o-nama')
                            {{$objava['naslov']}}
                            {!!Form::hidden('naslov',$objava['naslov'])!!}
                        @else
                            {!!Form::text('naslov',null,['class'=>'form-control col-sm-6','placeholder'=>'Naslov'])!!}
                        @endif
                    @else
                        {!!Form::text('naslov',null,['class'=>'form-control col-sm-6','placeholder'=>'Naslov'])!!}
                    @endif
                </div>
                <div class="col-sm-12 mt20">{!!Form::text('datum',null,['class'=>'form-control','id'=>'datetimepicker','placeholder'=>'Datum događaja'])!!}</div>
                @if(isset($objava['mesto']))
                    <div class="col-sm-12 mt20">
                        {!!Form::text('mesto',null,['class'=>'form-control col-sm-6','placeholder'=>'Mesto takmičenja'])!!}
                    </div>
                @endif
                <div class="col-sm-12 mt20">{!!Form::text('galerija',null,['class'=>'form-control col-sm-6','placeholder'=>'Galerija fotografija'])!!}</div>
                <div class="col-sm-12 mt20">{!!Form::checkbox('prioritet',1,null,['class'=>''])!!} Prikaži na slajderu</div>
                <div class="col-sm-12 mt20">
                    <span class="btn btn-file">
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
                <div class="col-sm-12 mt20">{!!Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Sačuvaj',['type'=>'submit','class'=>'btn btn-lg btn-primary btn-c','data-toggle'=>'tooltip','title'=>'Preporuka: proverite da li ste uneli sve podatke.'])!!}</div>
            </div>
            <div class="col-sm-12 mt20">{!!Form::textarea('sadrzaj',null,['class'=>'','placeholder'=>'Sadržaj'])!!}</div>
        {!!Form::close()!!}
    @endif
@endsection