<?php
if(!isset($rezultati)) $rezultati=null;
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
        <div class="alert alert-success alert-autocloseable-success">
            <h2>{{$uspesnoDodavanje}}</h2>
        </div>
    @endif
    @if(count($errors)>0)
        <div class="alert alert-danger alert-autocloseable-success">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <script>
        $(".alert-autocloseable-success").fadeTo(5000, 500).slideUp(500, function(){
            $(".alert-autocloseable-success").alert('close');
        });
        function prikaziDodatke(dodaciElement,id){
            console.log(dodaciElement);
            if (dodaciElement.files && dodaciElement.files[0]) {
                for(var i=0;i<dodaciElement.files.length;i++){
                   if(id==1){
                       $('#klupski_rez').html('');
                       var reader = new FileReader();
                       reader.onload = (function(file){return function(e){
                           $('#klupski_rez').append('<li>'+encodeURIComponent(file.name)+'</li>')}})(dodaciElement.files[i]);
                       reader.readAsDataURL(dodaciElement.files[i]);
                   }
                    if(id==2){
                        $('#sum_rez').html('');
                        var reader = new FileReader();
                        reader.onload = (function(file){return function(e){
                            $('#sum_rez').append('<li>'+encodeURIComponent(file.name)+'</li>')}})(dodaciElement.files[i]);
                        reader.readAsDataURL(dodaciElement.files[i]);
                    }
                }
            }
        }
    </script>
@if($rezultati)
    <div class="col-sm-12">
        Izmenili ste naslov objave, a samim tim i adresu. Možete da <a href="/administracija/objava/{{$rezultati['slug']}}" class="btn btn-lg btn-default">nastavite</a> ažuriranje.
    </div>
    @else
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
        {!!Form::model($rezultati,['files'=>true, 'class'=>'form-horizontal'])!!}
        {!!Form::hidden("update_rezultati",false)!!}
        {!!Form::hidden("rezultati_id",false)!!}
        <h1 class="col-sm-12">Dodaj rezultate</h1>
        <div class="col-sm-8">
            {!!Form::select('takmicenje_naziv',$naziv_takmicenjalists, null, ['id'=>'takmicenje_naziv','class'=>'form-control col-sm-6','placeholder'=>'Naziv takmicenja'])!!}
        </div>
         <div class="col-sm-5 mt20">
                <span class="btn btn-file">
                    <i class="glyphicon glyphicon-cloud-upload"></i> Klupski rezultati
                    {!!Form::file('klupski_rezultati',['id'=>'klupski_rezultati','onchange'=>'prikaziDodatke(this,1);'])!!}
                </span>
            <p><ul id="klupski_rez">
                @if($rezultati['dodaci'])
                    @foreach(json_decode($rezultati['dodaci']) as $dodatak)
                            <li>{{$dodatak}}</li>
                    @endforeach
                @endif
            </ul></p>
        </div>
        <div class="col-sm-5 mt20">
                <span class="btn btn-file">
                    <i class="glyphicon glyphicon-cloud-upload"></i> Sumarni rezultati
                    {!!Form::file('sumarni_rezultati',['id'=>'sumarni_rez','onchange'=>'prikaziDodatke(this,2);'])!!}
                </span>
            <p><ul id="sum_rez">
                @if($rezultati['dodaci'])
                    $dodatak=json_decode($rezultati['dodaci'])
                    <li>{{$dodatak}}</li>
                @endif 
                </ul>
            </p>
        </div>
        <div class="col-sm-8 mt20">{!!Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Sačuvaj',['id'=>'btn_sacuvaj','type'=>'submit','class'=>'btn btn-lg btn-primary','data-toggle'=>'tooltip','title'=>'Preporuka: proverite da li ste uneli sve podatke.'])!!}</div>

        {!!Form::close()!!}
    @endif

    <div id="lista_rezultata"></div>
    <br>
    <script>
        $(function(){ucitajRezultate();})
        function ucitajRezultate(){
            $('#lista_predmeta').hide();
            $('#lista_predmeta').html('<div style="text-align:center"><i class="icon-spin5 animate-spin" style="font-size: 100%;margin-top:80px"></i></div>');
            $.post('/rezultati/ucitaj-rezultate',
                    {
                        _token:'{{csrf_token()}}'
                    },
                    function(data){
                        var rezultati=JSON.parse(data);
                        console.log(rezultati);
                        if(rezultati.length<1){
                            $('#lista_predmeta').html('<h3>Ne postoji ni jedan rezultat.');
                            return;
                        }
                        var ispis='' +
                                '<table class="table table-condensed ">' +
                                '<thead>' +
                                '<tr><th>Naziv takmičenja</th><th>Mesto</th><th>Datum</th><th>Klupski rezultati</th><th>Sumarni rezultat</th><th></th></tr>' +
                                '</thead>' +
                                '<tbody>';
                        for(var i=0;i<rezultati.length;i++){
                            ispis+='<tr >' +
                            '<td  id="rezultat-'+rezultati[i]['id']+'">'+rezultati[i]['naslov']+'</td>' +
                            '<td >'+rezultati[i]['mesto']+'</td>' +
                            '<td >'+rezultati[i]['datum'].substring(0,10)+'</td>' +
                            '<td><a href="'+rezultati[i]['klupski_rezultati']+'"><img style="width: 19px; height: 18px;" src="../img/default/pdf.png"></a></td>' +
                            '<td><a href="'+rezultati[i]['sumarni_rezultati']+'"><img style="width: 19px; height: 18px;" src="../img/default/html.png"></a></td>' +
                            '<td>' +
                            '<a href="#" class="btn3d btn btn-xs btn-info" data-toggle="tooltip" title="Ažuriraj" onclick="editRezultata(\''+rezultati[i]['id']+'\',\''+rezultati[i]['objava_id']+'\',\''+rezultati[i]['klupski_rezultati']+'\',\''+rezultati[i]['sumarni_rezultati']+'\')"><span style="font-size: 14px;" class="glyphicon glyphicon-pencil"></span></a> &nbsp' +
                            '<a data-href="/rezultati/obrisi-rezultat/'+rezultati[i]['id']+'" class=" btn btn-xs btn-danger" data-toggle="confirmation" data-togglee="tooltip"><span style="" class="glyphicon glyphicon-trash"></span></a>' +
                            '</td>' +
                            '</tr>';
                        }
                        $('#lista_rezultata').html(ispis+'</tbody></table>');
                        $('#lista_rezultata').fadeIn();
                        $('[data-togglee=tooltip]').tooltip();
                        $('[data-toggle="confirmation"]').confirmation({placement: 'left',singleton: true,popout: true,title: 'Da li ste sigurni?',btnCancelLabel: '<i class="icon-remove-sign"></i> Otkaži',btnOkLabel: ' &nbsp<i class="icon-ok-sign icon-white"></i> Obriši'});
                    })};

        function editRezultata(id,objava_id, klupski_rezultati, sumarni_rezultati){

            $('select[name=takmicenje_naziv]').val(objava_id);
            $('#klupski_rez').append('<li>'+encodeURIComponent(klupski_rezultati)+'</li>');
            $('#sum_rez').append('<li>'+encodeURIComponent(sumarni_rezultati)+'</li>')
            $("#btn_sacuvaj").html("<span class='glyphicon glyphicon-pencil'></span> Ažuriraj podatke");

            $('input[name=update_rezultati]').val(1);
            $('input[name=rezultati_id]').val(id);
            $('[data-toggle=tooltip]').tooltip();
        }
        function emptyfunction(){
            $('#takmicenje_naziv').empty();
            $('#mesto').empty();
            $('datetimepicker').empty();
            $('#klupski_rez').empty();

            $('#sum_rez').empty();

        }

    </script>
    {!! HTML::script('js/bootstrap-confirmation.js') !!}
@endsection