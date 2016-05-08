@extends('layouts.master-advance')
@section('container')


    <h1 class="col-sm-12"></h1>
    <h1>Takmičar</h1>
    <hr>

        <div class="row">

            <div class="col-xs-12">

                    <h2 class="col-xs-8">{{$takmicar->ime}} {{$takmicar->prezime}}</h2>

                @if(Auth::check())
                    <div class="col-xs-4" align="right">
                        <a href="/takmicari/izmeni/{{$takmicar->slug}}" class="btn btn-default">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                        <button data-href="/takmicari/ukloni/{{$takmicar->slug}}" class="btn btn-danger ukloniObjavu" data-toggle="tooltip" title="Ukloni takmičara">
                            <i class="glyphicon glyphicon-trash"></i>
                        </button>
                    </div>
                @endif
            </div>

            <div class="col-xs-12">
                <div class="col-xs-4"><img css="img-thumbnail" src="{{$takmicar->foto}}"></div>
                <h2 class="col-xs-8">Rodjen: {{date('d.m.Y ',strtotime($takmicar->datum_rodjenja))}}.godine</h2>
                <h2 class="col-xs-8">{!! $takmicar->opste_informacije !!}</h2>
            </div>

        </div>
    @if(Auth::check())
        <div class="modal fade" id="sigurniSte">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="alert alert-danger">Da li ste sigurni da želite da uklonite takmičara?</h3>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Otkaži</button>
                        <a id="ukloniObjavu" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Ukloni</a>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('.ukloniObjavu').click(function(){
                $('#ukloniObjavu').attr('href',$(this).data('href'));
                $('#sigurniSte').modal('show');
            })
        </script>
    @endif

@endsection

