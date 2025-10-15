<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">

        <a class="navbar-brand" href="{{ route('home') }}">
            CardM
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="main-navbar">
            <ul class="navbar-nav ms-auto mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tab1') ? 'active' : '' }}" href="">Tab1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tab2') ? 'active' : '' }}" href="">Tab2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tab3') ? 'active' : '' }}" href="">Tab3</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Opções
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Adicionar Cartão</a></li>
                        <li><a class="dropdown-item" href="#">Ação 2</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Sair</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
