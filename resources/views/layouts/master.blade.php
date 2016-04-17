<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    {!!Html::style('bootstrap-3.3.5-dist/css/bootstrap.min.css')!!}
    {!!HTML::style('css/style.css')!!}
    {!!Html::script('bootstrap-3.3.5-dist/js/jquery.min.js')!!}
    {!!Html::script('bootstrap-3.3.5-dist/js/bootstrap.min.js')!!}

</head>

<body>
    <nav style="margin-bottom: 0px;" class="navbar navbar-default">
        <ul class="nav navbar-nav">
            <li ><a class="navbar-brand" href="/"><img  id="logo" src="img/logo.png"/></a></li>
            <li><a id="sitemap" href="">Sitemap</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right collapse navbar-collapse">
            <li ><a href="#"><img class="twiter" src="img/twitter.png"></a></li>
            <li><a href="#"><img class="face" src="img/facebook.png"></a></li>
            <li><a href="#"><img class="link" src="img/linkedin.png"></a></li>
        </ul>
    </nav>
    <div id="header-img">
        <img src="img/header-img.png" class="img-responsive">
    </div>
    <div  style="background-image: url(img/nav-bg.png);background-repeat: repeat-x;height: 80px; width: 100%;">
        <nav class="navigation" class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul id="linkovi" class="nav navbar-nav">
                        <li><a  href="#">Početna </a></li>
                        <li><a href="#">O nama</a></li>
                        <li><a href="#">Vizija</a></li>
                        <li><a href="#">Takmičari</a></li>
                        <li><a href="#">Rekordi</a></li>
                        <li><a href="#">Kalendar</a></li>
                        <li><a href="#">Rezultati</a></li>
                        <li><a href="#">Galerija</a></li>
                        <li><a href="#">Norme</a></li>
                        <li><a href="/prijava">Prijava</a></li>
                        <li><a href="odjava">Odjava</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>
    @yield('body')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</body>
</html>