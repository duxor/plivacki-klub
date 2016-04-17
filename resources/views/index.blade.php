@extends('layouts.master')
@section('body')
    <script type="text/javascript" src="js/slider/jssor.slider.mini.js"></script>
    <script type="text/javascript" src="js/slider/custom.js"></script>
    <link rel="stylesheet" href="css/slider.css">
    <style>
        .jssora02l, .jssora02r {
            display: block;
            position: absolute;
            width: 55px;
            height: 55px;
            cursor: pointer;
            background: url('img/a02.png') no-repeat;
            overflow: hidden;
        }
        .jssora02l { background-position: -3px -33px; }
        .jssora02r { background-position: -63px -33px; }
        .jssora02l:hover { background-position: -123px -33px; }
        .jssora02r:hover { background-position: -183px -33px; }
        .jssora02l.jssora02ldn { background-position: -3px -33px; }
        .jssora02r.jssora02rdn { background-position: -63px -33px; }
        .jssort11 .p {    position: absolute;    top: 0;    left: 0;    width: 300px;    height: 100px;    background: #181818;}.jssort11 .tp {    position: absolute;    top: 0;    left: 0;    width: 100%;    height: 100%;    border: none;}.jssort11 .i, .jssort11 .pav:hover .i {    position: absolute;    top: 3px;    left: 3px;    width: 80px;    height: 50px;    border: white 1px dashed;}* html .jssort11 .i {    width /**/: 62px;    height /**/: 32px;}.jssort11 .pav .i {    border: white 1px solid;}.jssort11 .t, .jssort11 .pav:hover .t {    position: absolute;    top: 3px;    left: 68px;    width: 129px;    height: 32px;    line-height: 32px;    text-align: center;    color: #fc9835;    font-size: 13px;    font-weight: 700;}.jssort11 .pav .t, .jssort11 .p:hover .t {    color: #fff;}.jssort11 .c, .jssort11 .pav:hover .c {    position: absolute;    top: 48px;    left: 3px;    width: 197px;    height: 31px;    line-height: 31px;    color: #fff;    font-size: 14px;    font-weight: 400;    overflow: hidden;}.jssort11 .pav .c, .jssort11 .p:hover .c {    color: #fc9835;}.jssort11 .t, .jssort11 .c {    transition: color 2s;    -moz-transition: color 2s;    -webkit-transition: color 2s;    -o-transition: color 2s;}.jssort11 .p:hover .t, .jssort11 .pav:hover .t, .jssort11 .p:hover .c, .jssort11 .pav:hover .c {    transition: none;    -moz-transition: none;    -webkit-transition: none;    -o-transition: none;}.jssort11 .p:hover, .jssort11 .pav:hover {    background: #333;}.jssort11 .pav, .jssort11 .p.pdn {    background: #462300;}

    </style>
 {{-- SLIDER START--}}
    <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1510px; height: 400px; overflow: hidden; visibility: hidden; background-color: #000000;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>
        <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 1200px; height: 400px; overflow: hidden;">
            <div data-p="112.50" style="display: none;">
                <img data-u="image" src="img/002.jpg" />
                <div data-u="thumb">
                    <img class="i" src="img/thumb-002.jpg" />
                    <div class="t">Banner Rotator</div>
                    <div class="c">360+ touch swipe slideshow effects</div>
                </div>
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="image" src="img/003.jpg" />
                <div data-u="thumb">
                    <img class="i" src="img/thumb-003.jpg" />
                    <div class="t">Image Gallery</div>
                    <div class="c">Image gallery with thumbnail navigation</div>
                </div>
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="image" src="img/004.jpg" />
                <div data-u="thumb">
                    <img class="i" src="img/thumb-004.jpg" />
                    <div class="t">Carousel</div>
                    <div class="c">Touch swipe, mobile device optimized</div>
                </div>
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="image" src="img/005.jpg" />
                <div data-u="thumb">
                    <img class="i" src="img/thumb-005.jpg" />
                    <div class="t">Themes</div>
                    <div class="c">30+ professional themems + growing</div>
                </div>
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="image" src="img/006.jpg" />
                <div data-u="thumb">
                    <img class="i" src="img/thumb-006.jpg" />
                    <div class="t">Tab Slider</div>
                    <div class="c">Tab slider with auto play options</div>
                </div>
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="image" src="img/006.jpg" />
                <div data-u="thumb">
                    <img class="i" src="img/thumb-006.jpg" />
                    <div class="t">Tab Slider</div>
                    <div class="c">Tab slider with auto play options</div>
                </div>
            </div>
            <a data-u="ad" href="http://www.jssor.com" style="display:none">jQuery Slider</a>

        </div>
        <!-- Thumbnail Navigator -->
        <div data-u="thumbnavigator" class="jssort11" style="position:absolute;right:5px;top:0px;font-family:Arial, Helvetica, sans-serif;-moz-user-select:none;-webkit-user-select:none;-ms-user-select:none;user-select:none;width:300px;height:300px;" data-autocenter="2">
            <!-- Thumbnail Item Skin Begin -->
            <div data-u="slides" style="cursor: default;">
                <div data-u="prototype" class="p">
                    <div data-u="thumbnailtemplate" class="tp"></div>
                </div>
            </div>
            <!-- Thumbnail Item Skin End -->
        </div>
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora02l" style="top:0px;left:8px;width:55px;height:55px;" data-autocenter="2"></span>
        <span data-u="arrowright" class="jssora02r" style="top:0px;right:418px;width:55px;height:55px;" data-autocenter="2"></span>
    </div>
    {{-- SLIDER END--}}
    <br/>
<div class="container-fluid" >
    {{-- OBAVEŠTENJE START--}}
    <div style="background-color:#e8e8e8; padding: 5px;" class="col-sm-10">
        <div class="row">
            <div class="col-sm-2">
                <div class="row">
                    <a class="pull-left" href="#" target="_parent">
                        <img style="width: 100%;" alt="image" class="img-responsive" src="http://images.prd.mris.com/image/V2/1/Yu59d899Ocpyr_RnF0-8qNJX1oYibjwp9TiLy-bZvU9vRJ2iC1zSQgFwW-fTCs6tVkKrj99s7FFm5Ygwl88xIA.jpg">
                    </a>
                    <ul style="position: absolute; margin-right: 0px; width: 100%; background-color: #080808;top:0; right: 0; opacity: 0.6; ">
                        <li style="display: inline;" ><a href="#"><img class="twiter" src="img/twitter.png"></a></li>
                        <li style="display: inline;"><a href="#"><img class="face" src="img/facebook.png"></a></li>
                        <li style="display: inline;"><a href="#"><img class="link" src="img/linkedin.png"></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-10">
                <h2  class="media-heading">
                    <a style="color: #E9C126;" href="#">Naslov1</a>
                </h2>
                <p style="color: #00A3D8; font-size: 16px;" >
                    alsdfj aasdl ačsdflka ačsdlk asdl ačld ačsdf časdlf časd fčasldfk ačsdf časdf časd fčasldf časd fčalsdf č
                    ačsdlfk asčd asldkf ačsdfk a sdčalsd fč ačsldkf pčpasldfk čas dčflaskdf l ... >
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <div class="row">
                    <a class="pull-left" href="#" target="_parent">
                        <img style="width: 100%;" alt="image" class="img-responsive" src="http://images.prd.mris.com/image/V2/1/Yu59d899Ocpyr_RnF0-8qNJX1oYibjwp9TiLy-bZvU9vRJ2iC1zSQgFwW-fTCs6tVkKrj99s7FFm5Ygwl88xIA.jpg">
                    </a>
                    <ul style="position: absolute; margin-right: 0px; width: 100%; background-color: #080808;top:0; right: 0; opacity: 0.6; ">
                        <li style="display: inline;" ><a href="#"><img class="twiter" src="img/twitter.png"></a></li>
                        <li style="display: inline;"><a href="#"><img class="face" src="img/facebook.png"></a></li>
                        <li style="display: inline;"><a href="#"><img class="link" src="img/linkedin.png"></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-10">
                <h2  class="media-heading">
                    <a style="color: #E9C126;" href="#">Naslov2</a>
                </h2>
                <p style="color: #00A3D8; font-size: 16px;" >
                    alsdfj aasdl ačsdflka ačsdlk asdl ačld ačsdf časdlf časd fčasldfk ačsdf časdf časd fčasldf časd fčalsdf č
                    ačsdlfk asčd asldkf ačsdfk a sdčalsd fč ačsldkf pčpasldfk čas dčflaskdf l ... >
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <div class="row">
                    <a class="pull-left" href="#" target="_parent">
                        <img style="width: 100%;" alt="image" class="img-responsive" src="http://images.prd.mris.com/image/V2/1/Yu59d899Ocpyr_RnF0-8qNJX1oYibjwp9TiLy-bZvU9vRJ2iC1zSQgFwW-fTCs6tVkKrj99s7FFm5Ygwl88xIA.jpg">
                    </a>
                    <ul style="position: absolute; margin-right: 0px; width: 100%; background-color: #080808;top:0; right: 0; opacity: 0.6; ">
                        <li style="display: inline;" ><a href="#"><img class="twiter" src="img/twitter.png"></a></li>
                        <li style="display: inline;"><a href="#"><img class="face" src="img/facebook.png"></a></li>
                        <li style="display: inline;"><a href="#"><img class="link" src="img/linkedin.png"></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-10">
                <h2  class="media-heading">
                    <a style="color: #E9C126;" href="#">Naslov3</a>
                </h2>
                <p style="color: #00A3D8; font-size: 16px;" >
                    alsdfj aasdl ačsdflka ačsdlk asdl ačld ačsdf časdlf časd fčasldfk ačsdf časdf časd fčasldf časd fčalsdf č
                    ačsdlfk asčd asldkf ačsdfk a sdčalsd fč ačsldkf pčpasldfk čas dčflaskdf l ... >
                </p>
            </div>
        </div>
    </div>

    {{-- OBAVEŠTENJE END--}}
    <div class="col-sm-2">{{-- SPONZORI START--}}
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Sponzori</h3>
            </div>
            <div class="panel-body">
               <a href="#"><p>Zdravlje Leskovac</p></a>
            </div>
            <div class="panel-body">
                <a href="#"><p>Zdravlje Leskovac</p></a>
            </div>
            <div class="panel-body">
                <a href="#"><p>Zdravlje Leskovac</p></a>
            </div>
            <div class="panel-body">
                <a href="#"><p>Zdravlje Leskovac</p></a>
            </div>
        </div>
    </div>{{-- SPONZORI END--}}
</div>
@endsection
