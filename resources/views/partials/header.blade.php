<nav class="navbar">
    <div class="container">
        <div class="navbar-content">
            <a href="{{ url('/') }}" class="navbar-brand">
                <img src="{{ asset('images/logo_cassottis.svg') }}" alt="Cassottis" class="navbar-logo" style="height:28px;">
            </a>
            <button class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="Toggle menu" onclick="window.toggleMobileMenu && window.toggleMobileMenu(event)">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <div class="navbar-links" id="navbar-links">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'is-active' : '' }}">Início</a>
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'is-active' : '' }}">Sobre</a>
                <a href="{{ route('services') }}" class="nav-link {{ request()->routeIs('services') ? 'is-active' : '' }}">Serviços</a>
                <a href="{{ route('portfolio') }}" class="nav-link {{ request()->routeIs('portfolio') ? 'is-active' : '' }}">Portfólio</a>
                <!--<a href="{{ route('blog') }}" class="nav-link {{ request()->routeIs('blog') ? 'is-active' : '' }}">Blog</a>-->
                <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'is-active' : '' }}">Contato</a>
            </div>
        </div>
    </div>
    <div class="mobile-menu-overlay" id="mobile-menu-overlay"></div>
</nav>

