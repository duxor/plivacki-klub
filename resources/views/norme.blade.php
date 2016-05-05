@extends('layouts.master-advance')
@section('container')
    <div class="col-md-8">
        <div id="lista_normi"></div>
        <div id="info"></div>
        <table id="prva_norma" class="table table-condensed table-hover ">
            <thead>
                <tr><th>Godište</th><th>Muškarci</th><th>Disciplina</th><th>Žene</th></tr>
            </thead>
            <tbody>
                @foreach($norme as $norma)
                    <tr >
                        <td >{{$norma['godiste']}}</td>
                        <td >{{$norma['norme_muski']}}</td>
                        <td >{{$norma['naziv']}}</td>
                        <td >{{$norma['norme_zenski']}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-condensed ">
                    <thead><tr><th><h3>Naziv takmičenja</h3></th></tr></thead>
                    <tbody>
                        @foreach($naziv_takmicenja as $n)
                            <tr>
                                <td ><a href="#" class="btn3d btn btn-xs btn-info"  onclick="ucitajRezultate({{$n['id']}})">{{$n['naslov']}}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>

        function ucitajRezultate(id){
            $('#prva_norma').hide();
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
                                '<tr><th>Godište</th><th>Muškarci</th><th>Disciplina</th><th>Žene</th></tr>' +
                                '</thead>' +
                                '<tbody>';
                        for(var i=0;i<norme.length;i++){
                            ispis+='<tr >' +
                            '<td >'+norme[i]['godiste']+'</td>' +
                            '<td >'+norme[i]['norme_muski']+'</td>' +
                            '<td >'+norme[i]['naziv']+'</td>' +
                            '<td >'+norme[i]['norme_zenski']+'</td>' +
                            '</tr>';

                        }

                        $('#lista_normi').html(ispis+'</tbody></table>');
                        $('#lista_normi').fadeIn();
                        ispis2=norme[0]['sadrzaj'];
                        $('#info').html(ispis2);
                        $('#info').fadeIn();

                    })}

    </script>
@endsection