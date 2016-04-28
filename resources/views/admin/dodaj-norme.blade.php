<?php
if(!isset($norme)) $norme=null;
if(!isset($norme_takmicenja)) $norme_takmicenja=null;
?>
@extends('admin.master')
@section('container')
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
    </script>

@if($norme)
    <div class="col-sm-12">
   
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
        <script>
            $(function () {
                $('#datetimepicker').datetimepicker();
                $('#datetimepicker2').datetimepicker();
                $('#datetimepicker').data('DateTimePicker').locale('sr').format(' HH:mm:ss');
                $('#datetimepicker2').data('DateTimePicker').locale('sr').format(' HH:mm:ss');
                @if(isset($rezultati['datum'])) $('#datetimepicker').val('{{$rezultati['datum']}}'); @endif
            });
        </script>
        
        <div class="col-sm-6">
        {{--forma za unos takmičenja--}}
        	<h1 class="col-sm-12">Dodaj takmicenje</h1>
        	{!!Form::open(array('url' => 'norme/dodaj-takmicenje', 'method' => 'post'))!!}
        	{!!Form::token()!!}
        	<div class="col-sm-12 mt20">
        		{!!Form::text('takmicenje',null,['id'=>'takmicenje','class'=>'form-control col-sm-6','placeholder'=>'Takmicenje'])!!}
        	</div>
        	<div class="col-sm-12 mt20">
        		{!!Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Unesi Takmicenje',['id'=>'btn_sacuvaj_tkmicenje','type'=>'submit','class'=>'btn btn-lg btn-primary','data-toggle'=>'tooltip','title'=>''])!!}
        	</div>
	        <div class="col-sm-12 mt20">{!!Form::textarea('norme_informacije',null,['class'=>'form-control','placeholder'=>'Opšte informacije'])!!}</div>
        	{!!Form::close()!!}
        {{--Kraj forme za unos takmičenja--}}

        {{--Forma za unos normi za unos takmičenja--}}
        	<h1 class="col-sm-12">Dodaj norme</h1>
	        {!!Form::model($norme,['files'=>true, 'class'=>'form-horizontal'])!!}
	        {!!Form::hidden("update_norme",false)!!}
	        {!!Form::hidden("norme_id",false)!!}
	        <div class="col-sm-12  mt20">
	            {!!Form::select('takmicenje_naziv',$naziv_takmicenjalists, null, ['id'=>'takmicenje_naziv','class'=>'form-control col-sm-6','placeholder'=>'Naziv takmicenja'])!!}
	        </div>    
	        <div class="col-sm-6  mt20">
	        {!!Form::text('norme_muski',null,['class'=>'form-control','id'=>'datetimepicker','placeholder'=>'Norme muškarci'])!!}
	        </div> 
	        <div class="col-sm-6  mt20">
	             {!!Form::text('norme_zenski',null,['class'=>'form-control','id'=>'datetimepicker2','placeholder'=>'Norme zenski'])!!}
	        </div> 
	        <div class="col-sm-12  mt20">    
	            {!!Form::text('godiste',null,['id'=>'godiste','class'=>'form-control col-sm-6','placeholder'=>'Godište'])!!}
	        </div>
	         <div class="col-sm-12 mt20">
	            {!!Form::select('disciplina',$stil,null,['id'=>'disciplina','class'=>'form-control col-sm-6','placeholder'=>'Disciplina'])!!}
	        </div>

	        <div class="col-sm-12 mt20"></div>
	        
	        
	        <div class="col-sm-12 mt20">{!!Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Sačuvaj',['id'=>'btn_sacuvaj','type'=>'submit','class'=>'btn btn-lg btn-primary','data-toggle'=>'tooltip','title'=>'Preporuka: proverite da li ste uneli sve podatke.'])!!}</div>
	        {!!Form::close()!!}
        </div>
        <div class="col-sm-6">
        PRIKAZ NORMI
	        <div class="panel panel-default">
			  <div class="panel-body">
			  <table class="table table-condensed ">
			  <thead><tr><th>Naziv takmičenja</th></tr></thead>
			  <tbody>
				  @foreach($naziv_takmicenja as $n)
				  	<tr >
				  		<td ><a href="#" class="btn3d btn btn-xs btn-info"  onclick="ucitajRezultate({{$n['id']}})">{{$n['takmicenje']}}</a></td>
				  	</tr>
				  @endforeach

				  </tbody>
				</table>
			   
			  </div>
			</div>

	        <div class="panel panel-default">
				  <div class="panel-body">
					<table class="table table-condensed ">
					  	<thead><tr><th>Naziv takmičenja</th></tr></thead>
					  	<tbody>
						  
						</tbody>
					</table>
					    <div id="lista_normi"></div>
				</div>
	        </div>
	    </div>


        <div class="col-sm-6">
        
        </div>

    @endif
 	
    <br>
    <script>
        function ucitajRezultate(id){
            $('#lista_normi').hide();
            $('#lista_normi').html('<div style="text-align:center"><i class="icon-spin5 animate-spin" style="font-size: 100%;margin-top:80px"></i></div>');
            $.post('/norme/ucitaj-rezultate',
                    {
                        _token:'{{csrf_token()}}',
                        id: id
                    },
                    function(data){
                        var norme=JSON.parse(data);
                        console.log(norme);
                        if(norme.length<1){
                            $('#lista_normi').html('<h3>Ne postoji ni jedan rezultat.');
                            return;
                        }
                        var ispis='' +
                                '<table class="table table-condensed ">' +
                                '<thead>' +
                                '<tr>'+ norme[0]['takmicenje'] +' </tr>'+
                                '<tr><th>Godište</th><th>Muškarci</th><th>Disciplina</th><th>Žene</th></tr>' +
                                '</thead>' +
                                '<tbody>';
                        for(var i=0;i<norme.length;i++){
                            ispis+='<tr >' +
                            '<td >'+norme[i]['godiste']+'</td>' +
                            '<td >'+norme[i]['norme_muski']+'</td>' +
                            '<td >'+norme[i]['disciplina']+'</td>' +
                            '<td >'+norme[i]['norme_zenski']+'</td>' +
                            '</tr>';
                        }
                        ispis+='<tr>'+norme[0]['norme_informacije']+' </tr>';
                        $('#lista_normi').html(ispis+'</tbody></table>');
                        $('#lista_normi').fadeIn();
                        $('[data-togglee=tooltip]').tooltip();
                        $('[data-toggle="confirmation"]').confirmation({placement: 'left',singleton: true,popout: true,title: 'Da li ste sigurni?',btnCancelLabel: '<i class="icon-remove-sign"></i> Otkaži',btnOkLabel: ' &nbsp<i class="icon-ok-sign icon-white"></i> Obriši',});
                        //$('[data-toggle=tooltip]').tooltip();
                    })};

        function editRezultata(id,takmicenje_naziv, mesto,datum, klupski_rezultati, sumarni_rezultati){
            emptyfunction();
            $('#takmicenje_naziv').val(takmicenje_naziv);
            $('#mesto').val(mesto);
            $('datetimepicker'). val(datum);
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
          $(function () {
            $('textarea').trumbowyg();
            $('#datetimepicker').datetimepicker();
            $('[data-toggle=tooltip]').tooltip();
            @if(isset($takmicar['datum_rodjenja'])) $('#datetimepicker').val('{{$takmicar['datum_rodjenja']}}'); @endif
        });

    </script>
    {!! HTML::script('js/bootstrap-confirmation.js') !!}
@endsection