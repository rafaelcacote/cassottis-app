<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cassottis - Transformação de Planilhas em Sistemas')</title>
    <!--<link rel="stylesheet" href="{{ asset('css/styles.css') }}">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body>
    <div class="animated-bg">
        <div class="gradient-blob gradient-blob-1"></div>
        <div class="gradient-blob gradient-blob-2"></div>
    </div>

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
    
    <script>
        // Mobile menu initialization
        function toggleMenuFunction(e) {
            if (e) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            const toggle = document.getElementById('mobile-menu-toggle');
            const menu = document.getElementById('navbar-links');
            const overlay = document.getElementById('mobile-menu-overlay');
            
            if (!toggle || !menu || !overlay) {
                console.error('Mobile menu elements not found');
                return;
            }
            
            const isActive = menu.classList.contains('active');
            
            toggle.classList.toggle('active');
            menu.classList.toggle('active');
            overlay.classList.toggle('active');
            
            if (!isActive) {
                document.body.classList.add('menu-open');
                document.body.style.overflow = 'hidden';
                document.documentElement.style.overflow = 'hidden';
            } else {
                document.body.classList.remove('menu-open');
                document.body.style.overflow = '';
                document.documentElement.style.overflow = '';
            }
        }
        
        function closeMenuFunction() {
            const toggle = document.getElementById('mobile-menu-toggle');
            const menu = document.getElementById('navbar-links');
            const overlay = document.getElementById('mobile-menu-overlay');
            
            if (toggle) toggle.classList.remove('active');
            if (menu) menu.classList.remove('active');
            if (overlay) overlay.classList.remove('active');
            document.body.classList.remove('menu-open');
            document.body.style.overflow = '';
            document.documentElement.style.overflow = '';
        }
        
        // Make function globally available for onclick
        window.toggleMobileMenu = toggleMenuFunction;
        
        function initMobileMenu() {
            const toggle = document.getElementById('mobile-menu-toggle');
            const menu = document.getElementById('navbar-links');
            const overlay = document.getElementById('mobile-menu-overlay');
            
            if (!toggle || !menu || !overlay) {
                console.error('Mobile menu elements not found');
                return;
            }
            
            // Add event listeners
            toggle.addEventListener('click', toggleMenuFunction);
            toggle.addEventListener('touchend', function(e) {
                e.preventDefault();
                toggleMenuFunction(e);
            });
            
            overlay.addEventListener('click', closeMenuFunction);
            
            // Close menu when clicking on a link
            const navLinks = menu.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 768) {
                        closeMenuFunction();
                    }
                });
            });
            
            // Close menu on window resize if it's desktop size
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    closeMenuFunction();
                }
            });
        }
        
        // Initialize when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initMobileMenu);
        } else {
            // DOM already loaded
            initMobileMenu();
        }
    </script>
</body>
</html>

