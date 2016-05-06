<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    {!!Html::style('bootstrap-3.3.5-dist/css/bootstrap.min.css')!!}
    {!!Html::script('bootstrap-3.3.5-dist/js/jquery.min.js')!!}
    {!!Html::script('bootstrap-3.3.5-dist/js/bootstrap.min.js')!!}

</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button  type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#admin-navbar" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="/" class="navbar-brand">Povratak na sajt</a>
            </div>
            <div class="collapse navbar-collapse" id="admin-navbar">
                <ul id="linkovi" class="nav navbar-nav">
                    <li><a href="/administracija">Administracija</a></li>
                    <li><a href="/administracija/dodaj-objavu">Dodaj objavu</a></li>
                    <li><a href="/administracija/objava/o-nama">Izmeni o nama</a></li>
                    <li><a href="/rezultati/dodaj-rezultate">Dodaj rezultate</a></li>
                    <li><a href="/norme/dodaj-norme">Dodaj norme</a></li>
                    <li><a href="/odjava">Odjava</a></li>
                    <li><a href="/takmicari/dodaj-takmicara">Dodaj takmičara</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container">@yield('container')</div>
    @yield('body')
</body>
</html>