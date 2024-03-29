<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
            integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
            crossorigin="anonymous"></script>
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <img src="{{URL::asset('/image/cf-logo.png')}}" height="50px" alt="logo CF">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            @if(request()->routeIs('produzione.*'))
                <li style="padding-left: 20px" class="nav-item {{ (request()->is('produzione')) ? 'active' : '' }}">
                    <a class="nav-link" href={{route('produzione.main')}}>Riepilogo Agenzia</a>
                </li>
                <li class="nav-item {{ (request()->is('produzione-tab')) ? 'active' : '' }}">
                    <a class="nav-link" href={{route('produzione.index')}}>Riepilogo Commerciali</a>
                </li>
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Gare
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="nav-item {{ (request()->is('produzione/gara-1-trimestre')) ? 'active' : '' }}">
                            <a class="dropdown-item" href={{url('produzione/gara-1-trimestre')}}>Gara 1° Trimestre</a>
                        </li>
                        <li class="nav-item {{ (request()->is('produzione/gara-2-trimestre')) ? 'active' : '' }}">
                            <a class="dropdown-item" href={{url('produzione/gara-2-trimestre')}}>Gara 2° Trimestre</a>
                        </li>
                        <li class="nav-item {{ (request()->is('produzione/gara-3-trimestre')) ? 'active' : '' }}">
                            <a class="dropdown-item" href={{url('produzione/gara-3-trimestre')}}>Gara 3° Trimestre</a>
                        </li>
                        <li class="nav-item {{ (request()->is('produzione/gara-4-trimestre')) ? 'active' : '' }}">
                            <a class="dropdown-item" href={{url('produzione/gara-4-trimestre')}}>Gara 4° Trimestre</a>
                        </li>
                        <li class="nav-item {{ (request()->is('produzione/obiettivo-2-semestre')) ? 'active' : '' }}">
                            <a class="dropdown-item" href={{url('produzione/obiettivo-2-semestre')}}>Obiettivo 2°
                                Semestre</a>
                        </li>
                    </ul>
                </div>
                @if(request()->routeIs('produzione.*'))
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Aggiornamento
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a class="dropdown-item" href="{{route('produzione.vita')}}">Vita</a></li>
                            <li><a class="dropdown-item" href="{{route('produzione.dna')}}">DNA</a></li>
                            <li><a class="dropdown-item" href="{{route('produzione.rca')}}">RCA</a></li>
                            <li><a class="dropdown-item" href="{{route('produzione.fondiPensione')}}">Fondi Pensione</a></li>
                        </ul>
                    </div>
                @endif
            @endif
            @if(request()->routeIs('trattativa.index'))
                <a class="nav-link" href={{route('produzione.main')}}><i class="bi-arrow-left-right"></i> Produzione</a>
                <a class="nav-link" href={{route('vivereDiRendita.index')}}><i class="bi-arrow-left-right"></i>
                    Vivere di Rendita</a>
            @elseif(request()->routeIs('produzione.*'))
                <a class="nav-link" href={{route('trattativa.index')}}><i class="bi-arrow-left-right"></i>
                    Trattativa</a>
                <a class="nav-link" href={{route('vivereDiRendita.index')}}><i class="bi-arrow-left-right"></i>
                    Vivere di Rendita</a>
            @endif
        </ul>
        <a href="{{route('produzione.opzioni')}}" type="button" class="bi bi-gear btn btn-outline-primary"></a>
        @if(Auth::user())
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{\Illuminate\Support\Facades\Auth::user()->email}}</a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <a style="margin-left: 10px" href="{{route('signout')}}" type="text">Logout</a>
                </ul>
            </div>
        @endif
    </div>
</nav>
