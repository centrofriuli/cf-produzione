{{--<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-bottom">--}}
{{--    <div class="container-fluid">--}}
{{--        <a class="navbar-brand" href="#">Produzione Centrofriuli 2022</a>--}}
{{--        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"--}}
{{--                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--        </button>--}}
{{--    </div>--}}
{{--    <ul class="navbar-nav mr-auto">--}}
{{--        <li class="nav-item active">--}}
{{--            <a class="nav-link" href={{route('produzione.main')}}>Riepilogo Agenzia</a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href={{route('produzione.index')}}>Riepilogo Commerciali</a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href={{route('produzione.gare.garaPrimoTrimestre')}}>Gara 1° Trimestre</a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href={{route('produzione.gare.garaSecondoTrimestre')}}>Gara 2° Trimestre</a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href={{route('produzione.gare.garaTerzoTrimestre')}}>Gara 3° Trimestre</a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href={{route('produzione.gare.garaQuartoTrimestre')}}>Gara 4° Trimestre</a>--}}
{{--        </li>--}}
{{--    </ul>--}}
{{--</nav>--}}
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img src="{{URL::asset('/image/cf-logo.png')}}" height="50px" alt="logo CF">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li style="padding-left: 20px" class="nav-item active">
                <a class="nav-link" href={{route('produzione.main')}}>Riepilogo Agenzia</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href={{route('produzione.index')}}>Riepilogo Commerciali</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href={{route('produzione.gare.garaPrimoTrimestre')}}>Gara 1° Trimestre</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href={{route('produzione.gare.garaSecondoTrimestre')}}>Gara 2° Trimestre</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href={{route('produzione.gare.garaTerzoTrimestre')}}>Gara 3° Trimestre</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href={{route('produzione.gare.garaQuartoTrimestre')}}>Gara 4° Trimestre</a>
            </li>
        </ul>
        <span class="nav-item dropdown show">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Dropdown
            </a>
            <div class="dropdown-menu show" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </span>
    </div>
</nav>
