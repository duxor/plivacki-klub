@extends('layouts.master-advance')
@section('container')
    <style>
        img{width: 100%;}
        .mt20{margin-top: 20px}
    </style>
<h2>Najbolja vremena</h2>

<div class="col-sm-12" id="prikazi_formu">
        {!!Form::open([ "id"=>"forma_podaci"])!!}
            <div class="col-sm-3 mt20">{!!Form::select("stil",$stilovi,1,["class"=>"form-control","id"=>"stil_id"])!!}</div>
            <div class="col-sm-3 mt20">{!!Form::select("pol",$pol,1,["class"=>"form-control","id"=>"pol_id"])!!}</div>
            <div class="col-sm-3 mt20">{!!Form::select("duzina_bazena",$duzina_bazena,1,["class"=>"form-control","id"=>"duzina_bazena_id"])!!}</div>
        {!! Form::close() !!}
        <div class="col-sm-3 mt20" align="center">
            {!!Form::button('<i class="glyphicon glyphicon-search"></i> Prikazi',["class"=>"btn btn-lg btn-primary", "id"=>"btn","data-toggle"=>"tooltip"])!!}
        </div>
</div>
    <div class="col-sm-12" id="prikazi_rekorde">
    </div>

<script>
    $("#btn").click(function() {
        var stil_id = $('#stil_id').val();
        var pol_id = $('#pol_id').val();
        var duzina_bazena_id = $('#duzina_bazena_id').val();

        $.post('/rekordi/prikazi', {stil_id: stil_id, pol_id: pol_id, duzina_bazena_id: duzina_bazena_id,  _token: '{{csrf_token()}}'}, function (data) {
            var rezultati = JSON.parse(data);

                var txt = '<table class="table table-condensed ">' +
                        '<thead>' +
                        '<tr>' +
                        '   <th>Ime</th>' +
                        '   <th>Prezime</th>' +
                        '   <th>Godiste</th>' +
                        '   <th>Vreme</th>'+
                        '</tr>'+
                        '</thead>' +
                        '<tbody>'
                for(var i=0;i<rezultati.length;i++)
                {
                    txt +=  '<tr>' +
                            '<td>' + rezultati[i]['ime'] + '</td>' +
                            '<td>' + rezultati[i]['prezime'] + '</td>' +
                            '<td>' + rezultati[i]['godiste'] + '</td>' +
                            '<td>'+ rezultati[i]['najbolje_vreme'] +'</td>'+
                    '</tr>'
                }
                $('#prikazi_rekorde').html(txt+'</tbody></table>')

            });


    });
    </script>

@endsection

