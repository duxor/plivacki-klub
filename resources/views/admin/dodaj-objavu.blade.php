@extends('admin.master')
@section('container')
    {!!Html::style('/datepicker/datetimepicker.css')!!}
    {!!Html::script('/datepicker/moment.js')!!}
    {!!Html::script('/datepicker/datetimepicker.js')!!}
    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
    </div>
    @endif
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
    </style>
    <script>
        function prikaziDodatke(dodaciElement){
            if (dodaciElement.files && dodaciElement.files[0]) {
                $('#izabraniDodaci').html('');
                for(var i=0;i<dodaciElement.files.length;i++){
                    var reader = new FileReader();
                    reader.onload = (function(file){return function(e){
                        $('#izabraniDodaci').append('<li>'+escape(file.name)+'</li>')}})(dodaciElement.files[i]);
                    reader.readAsDataURL(dodaciElement.files[i]);
                }
            }
        }
        function unesiFoto(){$('[name=foto]').click()}
        function prikaziFoto(fotoFajl){
            if (fotoFajl.files && fotoFajl.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    $('#naslovnaFoto').attr('src',e.target.result);
                                }
                                reader.readAsDataURL(fotoFajl.files[0]);
                        }
        }
    </script>
    {!!Form::open(['files'=>true])!!}
        <h1>Dodaj objavu</h1>
        {!!Form::text('naslov',null,['class'=>'form-control','placeholder'=>'Naslov'])!!}
        <img id="naslovnaFoto" alt="Naslovna fotografija" src="#" onclick="unesiFoto()">
        {!!Form::file('foto',['onchange'=>'prikaziFoto(this)','style'=>'display:none'])!!}

        {!!Form::textarea('sadrzaj',null,['class'=>'form-control','placeholder'=>'Sadržaj'])!!}
        <span class="btn btn-c btn-file">
            <i class="glyphicon glyphicon-cloud-upload"></i> Приложи додатке
            {!!Form::file('dodaci[]',['class'=>'','multiple','onchange'=>'prikaziDodatke(this);'])!!}
        </span>
        <p><ul id="izabraniDodaci"></ul></p>

        <div class="row">
            <div class='col-sm-6'>
                {!!Form::text('datum',null,['class'=>'form-control','id'=>'datetimepicker'])!!}
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#datetimepicker').datetimepicker();
                    $('#datetimepicker').data('DateTimePicker').locale('sr').format('DD.MM.Y. HH:mm');
                });
            </script>
        </div>
        {!!Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Sačuvaj',['type'=>'submit','class'=>'btn btn-primary'])!!}
    {!!Form::close()!!}
@endsection