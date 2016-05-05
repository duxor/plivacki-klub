<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#moj-meni">
                <span class="sr-only">Prikaži navigaciju</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand logo" href="/"><img id="logo" src="/img/logo.png"></a>
            <a id="spin-dalje" class="navbar-brand"><i class="glyphicon glyphicon-arrow-down"></i></a>
        </div>
        <div class="collapse navbar-collapse navbar-right" id="moj-meni">
            <ul class="nav navbar-nav">
                <li><a href="/"><i class="glyphicon glyphicon-home"></i> Početna </a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i> O nama <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/o-nama"><i class="glyphicon glyphicon-user"></i> O nama</a></li>
                        <li><a href="/vizija-kluba"><i class="glyphicon glyphicon-road"></i> Vizija</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-transfer"></i> Takmičenja <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/kalendar"><i class="glyphicon glyphicon-calendar"></i> Kalendar</a></li>
                        <li><a href="/takmicari"><i class="glyphicon glyphicon-user"></i> Takmičari</a></li>
                        <li><a href="/rekordi"><i class="glyphicon glyphicon-flag"></i> Rekordi</a></li>
                        <li><a href="/rezultati"><i class="glyphicon glyphicon-indent-right"></i> Rezultati</a></li>
                    </ul>
                </li>
                <li><a href="/galerija"><i class="glyphicon glyphicon-picture"></i> Galerija</a></li>
                <li><a href="/norme"><i class="glyphicon glyphicon-time"></i> Norme</a></li>
                @if (!Auth::check())
                    <li><a href="/prijava"><i class="glyphicon glyphicon-log-in"></i> Prijava</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-exclamation-sign"></i> AdminPanel <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/administracija"><i class="glyphicon glyphicon-blackboard"></i> Administracija</a></li>
                            <li><a href="/administracija/dodaj-objavu"><i class="glyphicon glyphicon-plus"></i><i class="glyphicon glyphicon-bell"></i>  Dodaj objavu</a></li>
                            <li><a href="/administracija/objava/o-nama"><i class="glyphicon glyphicon-pencil"></i>  Izmeni o nama</a></li>
                            <li><a href="/administracija/dodaj-rezultate"><i class="glyphicon glyphicon-plus"></i> <i class="glyphicon glyphicon-indent-right"></i> Dodaj rezultate</a></li>
                            <li><a href="/takmicari/dodaj-takmicara"><i class="glyphicon glyphicon-plus"></i><i class="glyphicon glyphicon-user"></i> Dodaj takmičara</a></li>
                            <li><a href="/odjava"><i class="glyphicon glyphicon-log-out"></i> Odjava</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>