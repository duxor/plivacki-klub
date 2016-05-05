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



@endsection

