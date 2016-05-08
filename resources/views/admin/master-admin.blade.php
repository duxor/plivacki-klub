<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administracija</title>
    {!!Html::style('/bootstrap-3.3.5-dist/css/bootstrap.min.css')!!}
    {!!Html::style('/css/basic-admin.css')!!}
    {!!Html::script('/bootstrap-3.3.5-dist/js/jquery.min.js')!!}
    {!!Html::script('/bootstrap-3.3.5-dist/js/bootstrap.min.js')!!}
</head>
<body data-target=".vertikalni-nav">
<div class="col-sm-2 vertikalni-nav">
    <div class="panel-group">
        <div class="panel panel-default panel-title">
            <a class="collapsed" data-toggle="collapse" href="#profilNav">
                <div class="panel-heading" style="padding: 1px">
                    <h3 class="text-center">Dobro došli!</h3>
                </div>
            </a>
        </div>
    </div>
    <div class="panel-group">
        <div class="panel panel-default panel-title">
            <a href="/">
                <div class="panel-heading" id="headingOne">
                    <h4><i class="glyphicon glyphicon-chevron-left"></i> Na sajt</h4>
                </div>
            </a>
        </div>
    </div>
    <div class="panel-group">
        <div class="panel panel-default panel-title">
            <a href="/administracija">
                <div class="panel-heading" id="headingOne">
                    <h4><i class="glyphicon glyphicon-home"></i> Administracija</h4>
                </div>
            </a>
        </div>
    </div>
    <div class="panel-group">
        <div class="panel panel-default panel-title">
            <a href="/administracija/dodaj-objavu">
                <div class="panel-heading" id="headingOne">
                    <h4><i class="glyphicon glyphicon-plus"></i><i class="glyphicon glyphicon-bell"></i> Dodaj objavu</h4>
                </div>
            </a>
        </div>
    </div>
        <div class="panel-group">
            <div class="panel panel-default panel-title">
                <a href="/administracija/objava/o-nama">
                    <div class="panel-heading" id="headingOne">
                        <h4><i class="glyphicon glyphicon-pencil"></i> Izmeni o nama </h4>
                    </div>
                </a>
            </div>
        </div>
    <div class="panel-group">
        <div class="panel panel-default panel-title">
            <a href="/administracija/objava/vizija-kluba">
                <div class="panel-heading" id="headingOne">
                    <h4><i class="glyphicon glyphicon-pencil"></i> Izmeni viziju kluba</h4>
                </div>
            </a>
        </div>
    </div>
    <div class="panel-group">
        <div class="panel panel-default panel-title">
            <a href="/rezultati/dodaj-rezultate">
                <div class="panel-heading" id="headingOne">
                    <h4><i class="glyphicon glyphicon-plus"></i> <i class="glyphicon glyphicon-indent-right"></i> Dodaj rezultate</h4>
                </div>
            </a>
        </div>
    </div>
    <div class="panel-group">
        <div class="panel panel-default panel-title">
            <a href="/norme/dodaj-norme">
                <div class="panel-heading" id="headingOne">
                    <h4><i class="glyphicon glyphicon-plus"></i><i class="glyphicon glyphicon-time"></i> Dodaj norme</h4>
                </div>
            </a>
        </div>
    </div>
    <div class="panel-group">
        <div class="panel panel-default panel-title">
            <a href="/takmicari/dodaj-takmicara">
                <div class="panel-heading" id="headingOne">
                    <h4><i class="glyphicon glyphicon-plus"></i><i class="glyphicon glyphicon-user"></i> Dodaj takmičara</h4>
                </div>
            </a>
        </div>
    </div>
    <div class="panel-group">
        <div class="panel panel-default panel-title">
            <a href="/odjava">
                <div class="panel-heading" id="headingOne">
                    <h4><i class="glyphicon glyphicon-off"></i> Odjava</h4>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="col-sm-10 bw">
    @yield('body')
    <br clear="all">
    <br clear="all">
    <br clear="all">
    <div class="text-center col-sm-11 copy">
        <p>Copyright © {{date('Y')}} PK Dubočica. Zadržavamo sva prava.</p>
    </div>
</div>
{!!Html::script('/js/funkcije-admin.js')!!}
</body>
</html>