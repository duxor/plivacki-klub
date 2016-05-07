<?php if(!isset($takmicar)) $takmicar=null; ?>
@extends('admin.master-admin')
@section('body')
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
    <div class="col-sm-8 mt20"><h4>Pol: Muški {!! Form::radio('pol_id','1',1)!!} Ženski {!! Form::radio('pol_id','2')!!}</h4></div>
    <div class="col-sm-8 mt20">{!!Form::text('datum_rodjenja',null,['class'=>'form-control','id'=>'datetimepicker','placeholder'=>'Datum rodjenja'])!!}</div>
    <div class="col-sm-8 mt20">{!!Form::text('registracioni_broj',null,['class'=>'form-control','placeholder'=>'Registracioni broj'])!!}</div>
    <div class="col-sm-12 mt20">{!!Form::textarea('opste_informacije',null,['class'=>'','placeholder'=>'Opšte informacije'])!!}</div>
    <div class="col-sm-12 mt20 " align="center">{!!Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Sačuvaj',['type'=>'submit', 'class'=>'btn btn-lg btn-primary ','data-toggle'=>'tooltip','title'=>'Preporuka: proverite da li ste uneli sve podatke.'])!!}</div>
    {!! Form::close() !!}

    <div class="col-sm-6" id="prikazi_formu">
    </div>

    <div class="col-sm-6" id="prikazi_rekorde">
    </div>

    <div class="col-sm-12 mt20" id="prikazi_poruku" align="center">
    </div>

    <script>
        $( document ).ready(function() {

            //Provera takmicara
                @if($takmicar){
                prikazi_rekorde("{{$takmicar->id}}");

                //Prikaz forme za unos rekorda
                $('#prikazi_formu').append(
                        '{!!Form::open([ "id"=>"forma_podaci"])!!}' +
                        '<div class="col-sm-4 mt20">{!! Form::label("stil","Stil*", ["data-toggle"=>"tooltip","title"=>"Polje je obavezno za unos"]) !!}</div>' +
                        '<div class="col-sm-8 mt20">{!!Form::select("stil",$stilovi,1,["class"=>"form-control","id"=>"stil_id"])!!}</div>' +
                        '<div class="col-sm-4 mt20">{!! Form::label("vreme","Vreme*", ["data-toggle"=>"tooltip","title"=>"Polje je obavezno za unos"]) !!}</div>' +
                        '<div class="col-sm-8 mt20">{!!Form::text("vreme",null,["class"=>"form-control","id"=>"vreme_id"])!!}</div>' +
                        '<div class="col-sm-4 mt20">{!! Form::label("stil","Dužina bazena*", ["data-toggle"=>"tooltip","title"=>"Polje je obavezno za unos"]) !!}</div>' +
                        '<div class="col-sm-8 mt20">{!!Form::select("duzina_bazena",$duzina_bazena,1,["class"=>"form-control","id"=>"duzina_bazena_id"])!!}</div>' +
                        '{!! Form::close() !!}'+
                        '<div class="col-sm-12 mt20 " align="center">{!!Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Sačuvaj',["class"=>"btn btn-lg btn-primary", "id"=>"btn","data-toggle"=>"tooltip"])!!}</div>'
                )

                //Cuvanje rekorda
                $("#btn").click(function() {
                    var takmicar_id = "{{$takmicar->id}}";
                    var stil_id = $('#stil_id').val();
                    var vreme = $('#vreme_id').val();
                    var duzina_bazena_id = $('#duzina_bazena_id').val();
                    $.post('/takmicari/rekord', {takmicar_id: takmicar_id, stil_id: stil_id, vreme: vreme,duzina_bazena_id: duzina_bazena_id,  _token: '{{csrf_token()}}'});
                    prikazi_rekorde("{{$takmicar->id}}");
                });


                //Ne postoji takmicar
            }@else{
                //Prikazivanje greske
                $('#prikazi_poruku').append(
                        '<div class="alert alert-danger">'+
                        '<strong><h2>Ukolko želite da dodate rekord, morate prvo dodati takmičara</h2></strong>'+
                        '</div>')
            }@endif
            //Kraj provera takmicara


        });
        //Kraj ready funkcije



        //F U N K C I J E

        //FUNKCIJA ZA PRIKAZIVANJE REKORDA
        function prikazi_rekorde(takmicar_id){
            $.post('/takmicari/rekordi', {takmicar_id: takmicar_id,  _token: '{{csrf_token()}}'}, function (data) {
                var rezultati = JSON.parse(data);
                var txt = '<table class="table table-condensed ">' +
                        '<thead>' +
                        '<tr>' +
                        '   <th>Stil</th>' +
                        '   <th>Najbolje vreme</th>' +
                        '   <th>Dužina Bazena</th>' +
                        '</th><th>'+
                        '</thead>' +
                        '<tbody>'
                for(var i=0;i<rezultati.length;i++)
                {
                    txt +=  '<tr>' +
                            '<td>' + rezultati[i]['stil'] + '</td>' +
                            '<td>' + rezultati[i]['najbolje_vreme'] + '</td>' +
                            '<td>' + rezultati[i]['duzina_bazena'] + '</td>' +
                            '<td>'+
                            '<a data-href="#"   onclick="obrisiRezultat(\''+rezultati[i]['id']+'\')" class=" btn btn-xs btn-danger" data-toggle="confirmation" data-togglee="tooltip"><span style="" class="glyphicon glyphicon-trash"></span></a>' +
                            '</td>'
                    '</tr>'
                }
                $('#prikazi_rekorde').html(txt+'</tbody></table>')

            });
        }
        //KRAJ FUNKCIJE ZA PRIKAZIVANJE REKORDA

        //FUNKCIJA ZA BRISANJE REKORDA
        @if($takmicar)
        function obrisiRezultat(rekord_id) {
            $.post('/takmicari/obrisi-rekord', {rekord_id: rekord_id, _token: '{{csrf_token()}}'});
            prikazi_rekorde("{{$takmicar->id}}");
        }@endif
        //KRAJ FUNKCIJE ZA BRISANJE REKORDA

        //FUNKCIJA ZA PRIKAZIVANJE SLIKE
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
        //KRAJ FUNKCIJE ZA PRIKAZIVANJE SLIKE

        //FUNKCIJE ZA EDITOVANJE TEKSTA I VREMENA
        $(function () {
            $('textarea').trumbowyg();
            $('#datetimepicker').datetimepicker();
            $('#datetimepicker').data('DateTimePicker').locale('sr').format('DD.MM.Y. HH:mm:ss');
            $('#vreme_id').datetimepicker();
            $('#vreme_id').data('DateTimePicker').locale('sr').format('HH:mm:ss');
            $('[data-toggle=tooltip]').tooltip();
            @if(isset($takmicar['datum_rodjenja'])) $('#datetimepicker').val('{{$takmicar['datum_rodjenja']}}'); @endif
        });
        //KRAJ FUNKCIJE ZA EDITOVANJE TEKSTA I VREMENA

    </script>

@endsection


