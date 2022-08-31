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
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <img src="{{URL::asset('/image/cf-logo.png')}}" height="50px" alt="logo CF">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li style="padding-left: 20px" class="nav-item {{ (request()->is('produzione')) ? 'active' : '' }}">
                <a class="nav-link" href={{route('produzione.main')}}>Riepilogo Agenzia</a>
            </li>
            <li class="nav-item {{ (request()->is('produzione-tab')) ? 'active' : '' }}">
                <a class="nav-link" href={{route('produzione.index')}}>Riepilogo Commerciali</a>
            </li>
            <li class="nav-item {{ (request()->is('produzione/gara-1-trimestre')) ? 'active' : '' }}">
                <a class="nav-link" href={{url('produzione/gara-1-trimestre')}}>Gara 1° Trimestre</a>
            </li>
            <li class="nav-item {{ (request()->is('produzione/gara-2-trimestre')) ? 'active' : '' }}">
                <a class="nav-link" href={{url('produzione/gara-2-trimestre')}}>Gara 2° Trimestre</a>
            </li>
            <li class="nav-item {{ (request()->is('produzione/gara-3-trimestre')) ? 'active' : '' }}">
                <a class="nav-link" href={{url('produzione/gara-3-trimestre')}}>Gara 3° Trimestre</a>
            </li>
            <li class="nav-item {{ (request()->is('produzione/gara-4-trimestre')) ? 'active' : '' }}">
                <a class="nav-link" href={{url('produzione/gara-4-trimestre')}}>Gara 4° Trimestre</a>
            </li>
        </ul>
    </div>
</nav>
