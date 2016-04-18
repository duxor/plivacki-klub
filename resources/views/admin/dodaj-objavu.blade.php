@extends('admin.master')
@section('container')
    {!!Form::open()!!}
        <h1>Dodaj objavu</h1>
        {!!Form::text('naslov',null,['class'=>'form-control','placeholder'=>'Naslov'])!!}
        {!!Form::text('slug',null,['class'=>'form-control','placeholder'=>'Slug'])!!}
        <img alt="Naslovna fotografija" src="#">
        {!!Form::textarea('sadrzaj',null,['class'=>'form-control','placeholder'=>'Sadržaj'])!!}
        <p>Attach</p>
        <p>Date picker</p>
        {!!Form::text('datum',null,['style'=>'display:none'])!!}
        {!!Form::button('Sačuvaj',['type'=>'submit','class'=>'btn btn-primary'])!!}
    {!!Form::close()!!}
@endsection