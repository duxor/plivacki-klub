<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PK Dubočica</title>
    {!!Html::style('/bootstrap-3.3.5-dist/css/bootstrap.min.css')!!}
    {!!Html::style('/css/basic.css')!!}
    {!!Html::style('/css/advance.css')!!}
    {!!Html::script('/bootstrap-3.3.5-dist/js/jquery-3.0.js')!!}
    {!!Html::script('/bootstrap-3.3.5-dist/js/bootstrap.min.js')!!}
    {!!Html::script('/js/funkcije.js')!!}
</head>

<body>
    @include('layouts.navbar')
    @yield('body')
    <div class="container">
        <div class="col-sm-10">@yield('container')</div>
        <div id="sponzori" class="col-sm-2">
            <a href="#"><img src="/img/default/baner-sponzori.jpg"></a>
            <a href="#"><img src="/img/default/baner-sponzori.jpg"></a>
            <a href="#"><img src="/img/default/baner-sponzori.jpg"></a>
            <a href="#"><img src="/img/default/baner-sponzori.jpg"></a>
            <a href="#"><img src="/img/default/baner-sponzori.jpg"></a>
        </div>
    </div>
    @include('layouts.footer')
</body>
</html>