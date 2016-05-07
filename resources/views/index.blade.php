@extends('layouts.master-basic')
@section('body')
    {!!Html::style('/css/fontello.css')!!}
    {!!Html::style('/css/animation.css')!!}
    {!!Html::style('/responsive-calendar/responsive-calendar.css')!!}
    {!!Html::script('/responsive-calendar/responsive-calendar.js')!!}
    {!!Html::script('/js/slider/jssor.slider.mini.js')!!}
    {!!Html::script('/js/slider/custom.js')!!}
    {!!Html::script('http://maps.google.com/maps/api/js')!!}

<div id="container-scroll" class="intro-effect-grid">

<div class="first-look-hide container">
    <div class="prioriteti col-sm-12 text-center">
        <h1>Plivački klub Dubočica</h1>
    </div>
    <div class="prioriteti col-sm-5">
        @foreach($slajder as $slajd)
            <div class="row">
                <a href="/{{$slajd->slug}}">
                    <div class="col-xs-2">
                        <img class="img-rounded" src="{{$slajd->foto?$slajd->foto:'/img/default/foto-objave.jpg'}}" alt="{{strtoupper($slajd->naslov)}}">
                    </div>
                    <div class="col-xs-10">
                        <div class="popover fade right in" style="position:relative;display: block">
                            <div class="arrow"></div>
                            <div class="popover-content">{{ucfirst($slajd->naslov)}}</div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <div class="col-sm-4"></div>
    <div class="col-sm-3 prioriteti">
        <div class="responsive-calendar">
            <div class="controls">
                <h4>
                    <b><span data-head-month></span> <span data-head-year></span></b>
                </h4>
            </div>
            <div class="day-headers">
                <div class="day header">Pon</div>
                <div class="day header">Uto</div>
                <div class="day header">Sre</div>
                <div class="day header">Čet</div>
                <div class="day header">Pet</div>
                <div class="day header">Sub</div>
                <div class="day header">Ned</div>
            </div>
            <div class="days" data-group="days"></div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                var datum=new Date();
                $(".responsive-calendar").responsiveCalendar({
                    time: datum.getFullYear()+'-'+(datum.getMonth()+1),
                    events: {!! $kalendar !!}
                })
            })
        </script>
    </div>
</div>
    <header id="header" class="header">
        <div class="img-menu row">
            <a href="#poslednje-objave" class="col-sm-3 scrol">
                <p>Vesti</p>
            </a>
            <a href="#takmicari" class="col-sm-3 scrol">
                <p>Takmičari</p>
            </a>
            <a href="#sponzori" class="col-sm-6 scrol">
                <p>Sponzori</p>
            </a>
            <a href="/kalendar" class="col-sm-3">
                <p>Kalendar</p>
            </a>
            <a href="/galerija" class="col-sm-3">
                <p>Galerija</p>
            </a>
            <a href="#kontakt" class="col-sm-3 scrol">
                <p>Kontakt</p>
            </a>
        </div>
    </header>
    {{--UDARNA START::--}}
    <div class="prioriteti">
        @include('layouts.navbar')
    </div>
    <div class="">
        {{--SLAJDER START::--}}
        <div id="jssor_1" style="position: relative; margin:0 auto; top: 0px; left: 0px; width: 1510px; height: 600px; overflow: hidden; visibility: hidden; background-color: #fff;">
                <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                    <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                    <div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                </div>
                <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 1200px; height: 600px; overflow: hidden;">
                    @foreach($slajder as $slajd)
                        <div data-p="112.50" style="display: none;">
                            <img data-u="image" src="{{$slajd->foto?$slajd->foto:'/img/default/foto-objave.jpg'}}" />
                            <div style="position: absolute; margin-right: 0px; width: 100%; height: 20%; background-color: rgba(201, 201, 201, 0.9);bottom:0; left: 0; ">
                                <a style="color: #131313; font-size: 18px; text-decoration: none;" href="/{{$slajd->slug}}">
                                    <h2 style="padding: 20px 60px;font-weight: bold">{{strtoupper($slajd->naslov)}}</h2>
                                </a>
                            </div>
                            <div data-u="thumb">
                                <img src="{{$slajd->foto}}" alt="{{$slajd->naslov}}">
                                <span>{{ucfirst($slajd->naslov)}}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div data-u="thumbnavigator" class="jssort11" style="position:absolute;right:5px;top:0px;font-family:Arial, Helvetica, sans-serif;-moz-user-select:none;-webkit-user-select:none;-ms-user-select:none;user-select:none;width:300px;" data-autocenter="2">
                    <div data-u="slides" style="cursor: pointer;" id="dsdasdasdas">
                        <div data-u="prototype" class="p">
                            <div data-u="thumbnailtemplate" class="tp"></div>
                        </div>
                    </div>
                </div>
                <span data-u="arrowleft" class="jssora02l" style="top:0px;left:8px;width:55px;height:55px;" data-autocenter="2"></span>
                <span data-u="arrowright" class="jssora02r" style="top:0px;right:418px;width:55px;height:55px;" data-autocenter="2"></span>
            </div><br>
        {{--slajder end::--}}
    </div>
    <div class="bg-img"><img src="/img/naslovna.jpg" alt="Naslovna fotografija"/></div>
    {{--udarna/bez-slajdera/ end::--}}

    {{--POSLEDJE-OBJAVE START::--}}
    <div id="poslednje-objave">
        <div class="container">
        <h2 class="text-center">Poslednje vesti</h2>
        <hr>
        @foreach($objave as $objava)
            <div class="row objava slideanim">
                <div class="col-xs-3">
                    <a href="/{{$objava->slug}}" target="_parent">
                        <div class="img">
                            <img alt="{{$objava->naslov}}" class="img-responsive" src="{{$objava->foto?$objava->foto:'/img/default/foto-objave.jpg'}}">
                        </div>
                    </a>
                </div>
                <div class="col-xs-9">
                    <h2>
                        <a href="/{{$objava->slug}}">{{$objava->naslov}}</a>
                        @if($admin)
                            <a href="/administracija/objava/{{$objava->slug}}" class="btn btn-default">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </a>
                            <button data-href="/administracija/objava/{{$objava->slug}}/ukloni" class="btn btn-danger ukloniObjavu" data-toggle="tooltip" title="Ukloni objavu">
                                <i class="glyphicon glyphicon-trash"></i>
                            </button>
                        @endif
                    </h2>
                    {!!$objava->sadrzaj!!}
                </div>
            </div>
        @endforeach
        @if($admin)
            <div class="modal fade" id="sigurniSte">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="alert alert-danger">Da li ste sigurni da želite da uklonite <span id="naslovObjave"></span>? Nakon toga nećetze biti u mogućnosti da je vratite.</h3>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Otkaži</button>
                                <a id="ukloniObjavu" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Ukloni</a>
                            </div>
                        </div>
                    </div>
            </div>
        @endif
        <hr>
        <div class="text-center"><a href="/vesti" class="btn btn-default"><i class="glyphicon glyphicon-sort-by-alphabet"></i> Pogledaj sve</a></div>
    </div>
    </div>
    {{--poslednje-objave end::--}}

    {{--TAKMICARI START::--}}
    <div id="takmicari">
        <div class="container">
            <h2 class="text-center">Naši takmičari</h2>
            <br>
            <div class="slideanim">
                @for($i=0;$i<5;$i++)
                    @if(isset($takmicari[$i]))
                        <div class="col-sm-2">
                            <a href="/takmicari/profil/{{$takmicari[$i]['slug']}}">
                                <img src="{{$takmicari[$i]['foto']?$takmicari[$i]['foto']:'/img/default/takmicar.jpg'}}" class="img-circle" alt="{{$takmicari[$i]['ime']}} {{$takmicari[$i]['prezime']}}">
                                <h4>{{$takmicari[$i]['ime']}} {{$takmicari[$i]['prezime']}}</h4>
                            </a>
                        </div>
                    @else
                        <div class="col-sm-2">
                            <a href="#">
                                <img src="/img/test/takmicar-{{$i}}.jpg" class="img-circle" alt="Test Takmičar">
                                <h4>Test Takmičar</h4>
                            </a>
                        </div>
                    @endif
                @endfor
                <div class="col-sm-2">
                    <a href="/takmicari" data-toggle="tooltip" title="Svi takmičari">
                        <img src="/img/default/takmicari-svi.jpg" class="img-circle" alt="Svi takmičari">
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{--takmicari end::--}}

    {{--SPONZORI START::--}}
    <div id="sponzori">
        <div class="container">
            <h2>Sponzori, partneri i saradnici</h2>
            <div class="col-sm-3 slideanim"><a href="#"><img src="/img/default/baner-sponzori.jpg"></a></div>
            <div class="col-sm-3 slideanim"><a href="#"><img src="/img/default/baner-sponzori.jpg"></a></div>
            <div class="col-sm-3 slideanim"><a href="#"><img src="/img/default/baner-sponzori.jpg"></a></div>
            <div class="col-sm-3 slideanim"><a href="#"><img src="/img/default/baner-sponzori.jpg"></a></div>
            <div class="col-sm-3 slideanim"><a href="#"><img src="/img/default/baner-sponzori.jpg"></a></div>
            <div class="col-sm-3 slideanim"><a href="#"><img src="/img/default/baner-sponzori.jpg"></a></div>
        </div>
    </div>
    {{--sponzori end::--}}

    {{--KONTAKT START::--}}
    <div id="kontakt">
        <div class="container">
            <div class="col-sm-6 mapa">
                <div id="googleMap"></div>
            </div>
            <div class="col-sm-6 form-horizontal">
                <h3><i class="glyphicon glyphicon-earphone"></i> Kontaktirajte nas putem e-maila</h3>
                <div id="poruka" class="alert alert-danger"></div>
                <div class="form-group slideanim">
                    {!! Form::label('lime','Ime',['class'=>'control-label col-sm-4']) !!}
                    <div class="col-sm-8">
                        {!! Form::text('ime',null,['class'=>'form-control form-control-c']) !!}
                    </div>
                </div>
                <div class="form-group slideanim">
                    {!! Form::label('lemail','E-mail',['class'=>'control-label col-sm-4']) !!}
                    <div class="col-sm-8">
                        {!! Form::email('email',null,['class'=>'form-control form-control-c']) !!}
                    </div>
                </div>
                <div class="form-group slideanim">
                    {!! Form::label('lporuka','Poruka',['class'=>'control-label col-sm-4']) !!}
                    <div class="col-sm-8">
                        {!! Form::textarea('poruka',null,['class'=>'form-control form-control-c']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-8">
                        {!! Form::button('<i class="glyphicon glyphicon-envelope"></i> Pošalji',['class'=>'btn btn-lg btn-success btn-success-c','onclick'=>'kontaktirajnas("'.csrf_token().'")']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--kontakt end::--}}

    <a id="to-top" class="scrol col-xs-1" href="#header" data-toggle="tooltip" title="Povratak na vrh"><img src="/img/to-top.png" alt="Na vrh"></a>
</div>
    <i class="icon-spin6 animate-spin" style="font-size: 1px;rgba(0,0,0,0)"></i>

    {!!Html::style('/scrolleffect/css/normalize.css')!!}
    {!!Html::script('/scrolleffect/js/classie.js')!!}
    {!!Html::style('/css/index.css')!!}
    {!!Html::script('/js/index.js')!!}
    @if($admin)
        {!!Html::script('/js/objave-admin.js')!!}
    @endif
@endsection
