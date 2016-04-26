@extends('layouts.master')
@section('body')
    <table class="table table-condensed ">
        <thead>
        <tr><th>Naziv takmičenja</th><th>Mesto</th><th>Datum</th><th>Klupski rezultati</th><th>Sumarni rezultat</th><th></th></tr>
        </thead>
        <tbody>
            @foreach($rezultati as $rezultat)
                <tr >
                    <td  id="rezultat-'+rezultati[i]['id']+'">{{$rezultat['takmicenje_naziv']}}</td>
                    <td >{{$rezultat['mesto']}}</td>
                    <td >{{$rezultat['datum']}}</td>
                    <td><a href="{{$rezultat['klupski_rezultati']}}"><img style="width: 19px; height: 18px;" src="../img/pdf.png"></a></td>
                    <td><a href="{{$rezultat['sumarni_rezultati']}}"><img style="width: 19px; height: 18px;" src="../img/html.png"></a></td>
                </tr>
            @endforeach
        </tbody></table>
@endsection