<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/" wire:navigate>ICSS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                @if (auth()->user()->rol == 'Administracion' || auth()->user()->rol == "Instalacion")
                    <li class="nav-item">
                        <a class="nav-link" href="/servicios">Instalacion</a>
                    </li>
                    @if (auth()->user()->rol == 'Administracion')
                        <li class="nav-item">
                            <a class="nav-link" href="/serviciodatas">Autorizacion</a>
                        </li>
                        <li><a class="nav-link" href="/pagos" wire:navigate>Pago</a></li>
                    @endif

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Registros
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="/clientes" wire:navigate>Clientes</a></li>
                            <li><a class="dropdown-item" href="/codigoclientes" wire:navigate>Codigo de Cliente</a></li>
                            <li><a class="dropdown-item" href="/equipos" wire:navigate>Equipos</a></li>
                            @if (auth()->user()->rol == 'Administracion')
                                <li><a class="dropdown-item" href="/velocidads" wire:navigate>Velocidad Megas</a></li>
                                <li><a class="dropdown-item" href="/plans" wire:navigate>Planes de Internet</a></li>
                                <li><a class="dropdown-item" href="/usuarios" wire:navigate>Usuarios</a></li>
                            @endif

                        </ul>
                    </li>
                @endif
            </ul>
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @endif

                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<br>
