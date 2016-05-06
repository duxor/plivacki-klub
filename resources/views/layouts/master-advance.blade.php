<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PK Dubočica</title>
    {!!Html::style('bootstrap-3.3.5-dist/css/bootstrap.min.css')!!}
    {!!Html::style('/css/basic.css')!!}
    {!!Html::style('/css/advance.css')!!}
    {!!Html::script('bootstrap-3.3.5-dist/js/jquery-3.0.js')!!}
    {!!Html::script('bootstrap-3.3.5-dist/js/bootstrap.min.js')!!}
    {!!Html::script('/js/funkcije.js')!!}
</head>

<body>
    @include('layouts.navbar')
    @yield('body')
    <div class="container">
        <div class="col-xs-10">@yield('container')</div>
        <div id="sponzori" class="col-xs-2">
            <a href="#"><img src="/img/default/baner-sponzori.jpg"></a>
            <a href="#"><img src="/img/default/baner-sponzori.jpg"></a>
            <a href="#"><img src="/img/default/baner-sponzori.jpg"></a>
            <a href="#"><img src="/img/default/baner-sponzori.jpg"></a>
            <a href="#"><img src="/img/default/baner-sponzori.jpg"></a>
        </div>
    </div>
    <footer>
        <div class="col-sm-4">
            <img src="/img/logo.png">
            <p>Ulica i broj</p>
            <p>poštanski broj i Grad</p>
            <p><a href="mailto:email@adresa.domen">email@adresa.domen</a></p>
            <p>Broj telefona <span class="kontakt-osoba">(kontakt osoba: Ime)</span></p>
        </div>
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <a href="#"><img src="/img/mreze/facebook.png"></a>
            <a href="#"><img src="/img/mreze/twitter.png"></a>
            <a href="#"><img src="/img/mreze/instagram.png"></a>
            <a href="#"><img src="/img/mreze/g+.png"></a>
            <a href="#"><img src="/img/mreze/linkedin.png"></a>
            <a href="#"><img src="/img/mreze/youtube.png"></a>
            <a href="#"><img src="/img/mreze/skype.png"></a>
            <br clear="all">
            <div class="link-tag">
                <a href="#">#o-nama</a>
                <a href="#">#vizija</a>
                <a href="#">#upis</a>
                <a href="#">#takmičenja</a>
                <a href="#">#takmičari</a>
                <a href="#">#vesti</a>
            </div>
        </div>
        <br clear="all">
    </footer>
</body>
</html>