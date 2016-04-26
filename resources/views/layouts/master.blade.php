<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    {!!Html::style('bootstrap-3.3.5-dist/css/bootstrap.min.css')!!}
    {!!HTML::style('css/style.css')!!}
    {!!Html::script('bootstrap-3.3.5-dist/js/jquery-3.0.js')!!}
    {!!Html::script('bootstrap-3.3.5-dist/js/bootstrap.min.js')!!}
</head>

<body>

    <div id="header-img">
        <img src="img/header-img.png" class="img-responsive">
    </div>
    <nav  class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <a class="navbar-brand" href="/"><img  id="logo" src="img/logo.png"/></a>
                <ul id="linkovi"  class="nav navbar-nav">
                    <li class="active1"><a href="/">Početna </a></li>
                    <li ><a href="/o-nama">O nama</a></li>
                    <li><a href="vizija-kluba">Vizija</a></li>
                    <li  class=" dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Takmičenja <span class="caret"></span></a>
                        <ul id="linkovi_dropdown" style="background-color: #003748" class=" dropdown-menu">
                            <li><a href="#">Takmičari</a></li>
                            <li><a href="#">Rekordi</a></li>
                            <li><a href="/rezultati">Rezultati</a></li>
                        </ul>
                    </li>
                    <li><a href="/kalendar">Kalendar</a></li>
                    <li><a href="/galerija">Galerija</a></li>
                    <li><a href="/norme">Norme</a></li>
                    @if (!Auth::check())
                        <li><a href="/prijava">Prijava</a></li>
                        @else<li><a href="/odjava">Odjava</a></li>
                    @endif
                </ul>





            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    @yield('body')

    <footer  style="background-image: url('img/footer.png'); background-color: #003748;" >
        <br/><br/>
        <div class="row">
            <div class="col-sm-3 col-xs-3">
                <ul class="footer_link" style="list-style-type: none">
                    <li class="active1"><a href="#">Početna </a></li>
                    <li ><a href="#">O nama</a></li>
                    <li><a href="#">Vizija</a></li>
                    <li><a href="#">Takmičari</a></li>
                    <li><a href="#">Rekordi</a></li>
                </ul>
            </div>
            <div class="col-sm-3 col-xs-3">
                <ul class="footer_link">
                    <li><a href="/kalendar">Kalendar</a></li>
                    <li><a href="#">Rezultati</a></li>
                    <li><a href="/galerija">Galerija</a></li>
                    <li><a href="#">Norme</a></li>
                </ul>
            </div>
            <div  class="col-sm-2 col-xs-3">
                <ul class="footer_link">
                    <li>Klub dubočica</li>
                    <li>Stojana LJuvića 23</li>
                    <li>Leskovac</li><br/>
                    <li>Pera Kojot</li>
                    <li>066/555/666/</li>
                    <li>email: asdf@gmail.com</li>
                </ul>
            </div>
            <div class="col-sm-4 col-xs-3">
                <ul style="margin-left: 40px;" class="nav navbar-nav navbar-right footer_links" >
                    <li style="display: inline;" ><a href="#"><img class="twiter" src="img/twitter.png"></a></li>
                    <li style="display: inline;"><a href="#"><img class="face" src="img/facebook.png"></a></li>
                    <li style="display: inline;"><a href="#"><img class="link" src="img/linkedin.png"></a></li>
                </ul>
            </div>
        </div><br/><br/>
    </footer>
</body>
</html>