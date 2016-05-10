<?php
if(!isset($norme)) $norme=null;
if(!isset($norme_takmicenja)) $norme_takmicenja=null;

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
    @if (Session::has('poruka'))
        <h3 class="alert alert-success alert-autocloseable-success" align="center">{{ Session::get('poruka') }}</h3>
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
        {{--Forma za unos normi --}}
            @if (isset($izmene[0]['takmicenje_naziv']))
                <h1 class="col-sm-12">Dodaj norme</h1>
                {!!Form::model($norme,['files'=>true, 'class'=>'form-horizontal'])!!}
                {!!Form::hidden("update_norme",1)!!}
                {!!Form::hidden("norme_id",$izmene[0]['takmicenje_naziv'])!!}
                <div class="col-sm-12  mt20">
                    {!!Form::select('takmicenje_naziv',$naziv_takmicenjalists,  $izmene[0]['takmicenje_naziv'], ['id'=>'takmicenje_naziv','class'=>'form-control col-sm-6','placeholder'=>'Naziv takmicenja'])!!}
                </div>
                <div class="col-sm-6  mt20">
                    {!!Form::text('norme_muski',null,['class'=>'form-control','id'=>'datetimepicker','placeholder'=>'Norme muškarci'])!!}
                </div>
                <div class="col-sm-6  mt20">
                    {!!Form::text('norme_zenski',null,['class'=>'form-control','id'=>'datetimepicker2','placeholder'=>'Norme zenski'])!!}
                </div>
                <div class="col-sm-12  mt20">
                    {!!Form::select('godiste',array_combine(range(1985,$poslednja_godina),range(1985,$poslednja_godina)),null, ['id'=>'godiste','class'=>'form-control col-sm-6','placeholder'=>'Godiste'])!!}
                </div>
                <div class="col-sm-12 mt20">
                    {!!Form::select('stil',$stil,null,['id'=>'disciplina','class'=>'form-control col-sm-6','placeholder'=>'Disciplina'])!!}
                </div>
                <div class="col-sm-12 mt20">
                    <div id="info" ></div>
                </div>
                <div class="col-sm-12 mt20"></div>
                <div class="col-sm-12 mt20">{!!Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Sačuvaj',['id'=>'btn_sacuvaj','type'=>'submit','class'=>'btn btn-lg btn-primary','data-toggle'=>'tooltip','title'=>'Preporuka: proverite da li ste uneli sve podatke.'])!!}</div>
                {!!Form::close()!!}
            @else
                <h1 class="col-sm-12">Dodaj norme</h1>
                {!!Form::model($norme,['files'=>true, 'class'=>'form-horizontal'])!!}
                {!!Form::hidden("update_norme",false)!!}
                {!!Form::hidden("norme_id",false)!!}
                <div class="col-sm-12  mt20">
                    {!!Form::select('takmicenje_naziv',$naziv_takmicenjalists,  (Session::has('old'))?Session::get('old'):null, ['id'=>'takmicenje_naziv','class'=>'form-control col-sm-6','placeholder'=>'Naziv takmicenja'])!!}
                </div>
                <div class="col-sm-6  mt20">
                    {!!Form::text('norme_muski',null,['class'=>'form-control','id'=>'datetimepicker','placeholder'=>'Norme muškarci'])!!}
                </div>
                <div class="col-sm-6  mt20">
                    {!!Form::text('norme_zenski',null,['class'=>'form-control','id'=>'datetimepicker2','placeholder'=>'Norme zenski'])!!}
                </div>
                <div class="col-sm-12  mt20">
                    {!!Form::select('godiste',array_combine(range(1985,$poslednja_godina),range(1985,$poslednja_godina)),null, ['id'=>'godiste','class'=>'form-control col-sm-6','placeholder'=>'Godiste'])!!}
                </div>
                <div class="col-sm-12 mt20">
                    {!!Form::select('stil',$stil,null,['id'=>'disciplina','class'=>'form-control col-sm-6','placeholder'=>'Disciplina'])!!}
                </div>
                <div class="col-sm-12 mt20">
                    <div id="info" ></div>
                </div>
                <div class="col-sm-12 mt20"></div>
                <div class="col-sm-12 mt20">{!!Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Sačuvaj',['id'=>'btn_sacuvaj','type'=>'submit','class'=>'btn btn-lg btn-primary','data-toggle'=>'tooltip','title'=>'Preporuka: proverite da li ste uneli sve podatke.'])!!}</div>
                {!!Form::close()!!}
            @endif
        </div>
        <script>
            $('#takmicenje_naziv').change(function() {
                var id =$('#takmicenje_naziv').val();
                console.log(id);
                $.post('/norme/ucitaj-objavu',
                        {
                            _token:'{{csrf_token()}}',
                            id: id
                        },function(data){
                            var info=JSON.parse(data);
                            console.log(info);
                            if(info.length == 0){
                                $('#info').empty();
                            }else{
                                $('#info').html(info[0]['sadrzaj']);
                            }
                        });
            });
        </script>
        <div class="col-sm-6">
        PRIKAZ NORMI
	        <div class="panel panel-default">
			  <div class="panel-body">
			  <table class="table table-condensed ">
			  <thead><tr><th>Naziv takmičenja</th></tr></thead>
			  <tbody>
				  @foreach($naziv_takmicenja as $n)
				  	<tr >
				  		<td ><a href="#" class="btn3d btn btn-xs btn-info"  onclick="ucitajRezultate({{$n['id']}})">{{$n['naslov']}}</a>&nbsp &nbsp<a data-href="/norme/obrisi-normu/{{$n['id']}}" class="btn3d btn btn-xs btn-danger"  data-toggle="confirmation" data-togglee="tooltip"><span class="glyphicon glyphicon-minus"></span></a></td>
                        </tr>
				  @endforeach

				  </tbody>
				</table>
			  </div>
			</div>
	        <div class="panel panel-default">
				  <div class="panel-body">
                      <div id="lista_normi"></div>
				</div>
	        </div>
	    </div>
        <script> $(function() {
                $('[data-togglee=tooltip]').tooltip();
                $('[data-toggle="confirmation"]').confirmation({placement: 'left',singleton: true,popout: true,title: 'Da li ste sigurni?',btnCancelLabel: '<i class="icon-remove-sign"></i> Otkaži',btnOkLabel: ' &nbsp<i class="icon-ok-sign icon-white"></i> Obriši'});
            });
        </script>
    @endif
    <br>
    <script>
        function ucitajRezultate(id){
            $.post('/norme/ucitaj-rezultate',
                    {
                        _token:'{{csrf_token()}}',
                        id: id
                    },
                    function(data){
                        var norme=JSON.parse(data);
                        if(norme.length<1){
                            $('#lista_normi').html('<h3>Ne postoji ni jedan rezultat.');
                            return;
                        }
                        var ispis='' +
                                '<table class="table table-condensed ">' +
                                '<thead>' +
                                '<tr><th>Godište</th><th>Muškarci</th><th>Disciplina</th><th>Žene</th></tr>' +
                                '</thead>' +
                                '<tbody>';
                        for(var i=0;i<norme.length;i++){
                            ispis+='<tr >' +
                            '<td >'+norme[i]['godiste']+'</td>' +
                            '<td >'+norme[i]['norme_muski']+'</td>' +
                            '<td >'+norme[i]['naziv']+'</td>' +
                            '<td >'+norme[i]['norme_zenski']+'&nbsp&nbsp<a href="#" class="btn3d btn btn-xs btn-info"  onclick="editNorme(\''+norme[i]['id']+'\',\''+norme[i]['takmicenje_naziv']+'\',\''+norme[i]['norme_muski']+'\',\''+norme[i]['norme_zenski']+'\',\''+norme[i]['stil_id']+'\',\''+norme[i]['godiste']+'\')"><span class="glyphicon glyphicon-edit"></span></a></td>' +
                            '</tr>';
                        }
                        $('#lista_normi').html(ispis+'</tbody></table>');
                        $('#lista_normi').fadeIn();
                        $('[data-togglee=tooltip]').tooltip();
                        $('[data-toggle="confirmation"]').confirmation({placement: 'left',singleton: true,popout: true,title: 'Da li ste sigurni?',btnCancelLabel: '<i class="icon-remove-sign"></i> Otkaži',btnOkLabel: ' &nbsp<i class="icon-ok-sign icon-white"></i> Obriši'});
                    })};

        function editNorme(id, takmicenjenaziv, normemuski, normezenski,disciplina, godiste){
            $("#btn_sacuvaj").html("<span class='glyphicon glyphicon-pencil'></span> Ažuriraj podatke");
            $('input[name=update_norme]').val(1);
            $('input[name=norme_id]').val(id);
            $('select[name=takmicenje_naziv]').val(takmicenjenaziv);
            $('#datetimepicker').val(normemuski);
            $('#datetimepicker2').val(normezenski);
            $('select[name=stil]').val(disciplina);
            $('select[name=godiste]').val(godiste);
        }
          $(function () {
                         $('textarea').trumbowyg();
            $('#datetimepicker').datetimepicker();
            $('[data-toggle=tooltip]').tooltip();
            @if(isset($takmicar['datum_rodjenja'])) $('#datetimepicker').val('{{$takmicar['datum_rodjenja']}}'); @endif
        });
        window.onload = function() {
            @if(isset($izmene[0]['takmicenje_naziv']))ucitajRezultate({{$izmene[0]['takmicenje_naziv']}})@endif;
        };

    </script>
    {!! HTML::script('js/bootstrap-confirmation.js') !!}
@endsection