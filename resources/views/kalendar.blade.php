@extends('layouts.master')
@section('body')
    {!!Html::style('/responsive-calendar/responsive-calendar.css')!!}
    {!!Html::script('/responsive-calendar/responsive-calendar.js')!!}
    <div class="container">
        <div class="kalendar">
            <div class="responsive-calendar">
                <div class="controls">
                    <a class="pull-left" data-go="prev">
                        <div class="btn btn-primary">
                            <i class="glyphicon glyphicon-chevron-left"></i>
                        </div>
                    </a>
                    <h4>Kalendar takmičenja za <span data-head-month></span> <span data-head-year></span></h4>
                    <a class="pull-right" data-go="next">
                        <div class="btn btn-primary"><i class="glyphicon glyphicon-chevron-right"></i></div>
                    </a>
                </div><hr/>
                <div class="day-headers">
                    <div class="day header">Pon</div>
                    <div class="day header">Uto</div>
                    <div class="day header">Sre</div>
                    <div class="day header">Čet</div>
                    <div class="day header">Pet</div>
                    <div class="day header">Sub</div>
                    <div class="day header">Ned</div>
                </div>
                <div class="days" data-group="days">
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                var datum=new Date();
                $(".responsive-calendar").responsiveCalendar({
                    time: datum.getFullYear()+'-'+(datum.getMonth()+1),
                    events: {!!$kalendar!!}
                })
            })
        </script>
        </div>

        <div class="col-xs-12">
            @foreach($takmicenja as $takmicenje)
                <hr>
                <h3 id="{{$takmicenje->slug}}">
                    <a href="/{{$takmicenje->slug}}">{{$takmicenje->naslov}}</a>
                    @if($admin)
                        <a href="/administracija/objava/{{$takmicenje->slug}}" class="btn btn-default">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                    @endif
                </h3>
                <div class="row">
                    <div class="col-xs-3">
                        <a  href="/{{$takmicenje->slug}}">
                            <img src="{{$takmicenje->foto?$takmicenje->foto:'/img/default/foto-objave.jpg'}}" alt="{{$takmicenje->naziv}}" class="img-responsiveimg-thumbnail">
                        </a>
                    </div>
                    <div class="col-xs-8">
                        <b>
                            <i class="glyphicon glyphicon-time"></i> {{$takmicenje->datum}}<br>
                            <span><i class="glyphicon glyphicon-map-marker"></i> {{$takmicenje->mesto}}</span>
                        </b>
                        {!!$takmicenje->sadrzaj!!}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <style>
        .active-danger{background-color: #FFD89D}
        .responsive-calendar .active-danger a{color:#fff;font-weight: bold}
        .responsive-calendar .active-danger a:hover{color:#000;font-weight: bold}
        .col-xs-3>a>img{width: 100%}
        .col-sm-7 b span{cursor: pointer}
        .col-sm-7 p{text-align: justify}
    </style>
@endsection