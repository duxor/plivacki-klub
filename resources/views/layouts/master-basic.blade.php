<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PK Dubočica</title>
    {!!Html::style('/bootstrap-3.3.5-dist/css/bootstrap.min.css')!!}
    {!!Html::style('/css/basic.css')!!}
    {!!Html::script('/bootstrap-3.3.5-dist/js/jquery-3.0.js')!!}
    {!!Html::script('/bootstrap-3.3.5-dist/js/bootstrap.min.js')!!}
    {!!Html::script('/js/funkcije.js')!!}
</head>

<body>
    <div class="container">@yield('container')</div>
    @yield('body')
    @include('layouts.footer')
</body>
</html>