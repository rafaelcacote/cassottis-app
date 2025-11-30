<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin') - Admin</title>
    <meta name="description" content="@yield('description', 'Área administrativa')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: #4b5563;
            border-radius: 0.5rem;
            transition: all 0.2s;
            text-decoration: none;
        }
        .nav-link:hover {
            background-color: #f9fafb;
            color: #111827;
        }
        .nav-link.active {
            background-color: #eff6ff;
            color: #2563eb;
            font-weight: 600;
        }
        .nav-group-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: #4b5563;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        .nav-group-header:hover {
            background-color: #f9fafb;
        }
        .nav-sublink {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding-left: 3rem;
            padding-right: 1rem;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            font-size: 0.875rem;
            color: #6b7280;
            border-radius: 0.5rem;
            transition: all 0.2s;
            text-decoration: none;
        }
        .nav-sublink:hover {
            background-color: #f9fafb;
            color: #111827;
        }
        .nav-sublink.active {
            background-color: #eff6ff;
            color: #2563eb;
            font-weight: 600;
        }
        .nav-group-items {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary {
            background-color: #2563eb;
            color: white;
        }
        .btn-primary:hover {
            background-color: #1d4ed8;
        }
        .btn-secondary {
            background-color: #e5e7eb;
            color: #1f2937;
        }
        .btn-secondary:hover {
            background-color: #d1d5db;
        }
        .btn-sm {
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
        }
        .btn-warning {
            background-color: #eab308;
            color: white;
        }
        .btn-warning:hover {
            background-color: #ca8a04;
        }
        .btn-info {
            background-color: #3b82f6;
            color: white;
        }
        .btn-info:hover {
            background-color: #2563eb;
        }
        .btn-danger {
            background-color: #ef4444;
            color: white;
        }
        .btn-danger:hover {
            background-color: #dc2626;
        }
        .form-input {
            width: 100%;
            padding: 0.5rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            transition: all 0.2s;
        }
        .form-input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            border-color: #2563eb;
        }
        .form-textarea {
            width: 100%;
            padding: 0.5rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            resize: none;
            transition: all 0.2s;
        }
        .form-textarea:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            border-color: #2563eb;
        }
        .form-select {
            width: 100%;
            padding: 0.5rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            transition: all 0.2s;
        }
        .form-select:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            border-color: #2563eb;
        }
        .badge {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 9999px;
        }
    </style>
    
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out" id="sidebar">
            <!-- Logo -->
            <div class="flex items-center justify-center h-16 border-b border-gray-200">
                <h1 class="text-xl font-bold text-gray-900">Admin</h1>
            </div>
            
            <!-- Navigation -->
            <nav class="mt-8">
                <div class="px-4 space-y-2">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" 
                       class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt w-5 h-5"></i>
                        <span>Dashboard</span>
                    </a>
                    
                    <!-- Projects -->
                    <div class="nav-group">
                        <div class="nav-group-header">
                            <i class="fas fa-laptop-code w-5 h-5"></i>
                            <span>Projetos</span>
                        </div>
                        <div class="nav-group-items">
                            <a href="{{ route('admin.projects.index') }}" 
                               class="nav-sublink {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                                <i class="fas fa-list w-4 h-4"></i>
                                <span>Todos os Projetos</span>
                            </a>
                            <a href="{{ route('admin.projects.create') }}" 
                               class="nav-sublink">
                                <i class="fas fa-plus w-4 h-4"></i>
                                <span>Novo Projeto</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Blog -->
                    <div class="nav-group">
                        <div class="nav-group-header">
                            <i class="fas fa-newspaper w-5 h-5"></i>
                            <span>Blog</span>
                        </div>
                        <div class="nav-group-items">
                            <a href="{{ route('admin.blog.index') }}" 
                               class="nav-sublink {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">
                                <i class="fas fa-list w-4 h-4"></i>
                                <span>Todos os Posts</span>
                            </a>
                            <a href="{{ route('admin.blog.create') }}" 
                               class="nav-sublink">
                                <i class="fas fa-plus w-4 h-4"></i>
                                <span>Novo Post</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Divider -->
                    <div class="border-t border-gray-200 my-4"></div>
                    
                    <!-- View Site -->
                    <a href="{{ route('home') }}" 
                       target="_blank"
                       class="nav-link">
                        <i class="fas fa-external-link-alt w-5 h-5"></i>
                        <span>Ver Site</span>
                    </a>
                    
                    <!-- Logout -->
                    @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link w-full text-left text-red-600 hover:bg-red-50">
                            <i class="fas fa-sign-out-alt w-5 h-5"></i>
                            <span>Sair</span>
                        </button>
                    </form>
                    @endauth
                </div>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <div class="lg:ml-64">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <!-- Mobile menu button -->
                    <button class="lg:hidden text-gray-500 hover:text-gray-700" id="mobile-menu-button">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    
                    <!-- Page Title -->
                    <div class="flex-1 lg:flex-none">
                        <h2 class="text-xl font-semibold text-gray-900">@yield('page-title', 'Dashboard')</h2>
                    </div>
                    
                    <!-- User Menu -->
                    <div class="flex items-center space-x-4">
                        <!-- User Info -->
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <div class="hidden sm:block">
                                <div class="text-sm font-medium text-gray-900">{{ Auth::user()->name ?? 'Admin' }}</div>
                                <div class="text-xs text-gray-500">Administrador</div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <main class="p-6">
                <!-- Flash Messages -->
                @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                </div>
                @endif
                
                @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ session('error') }}
                    </div>
                </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Mobile Sidebar Overlay -->
    <div class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden hidden" id="sidebar-overlay"></div>
    
    @stack('scripts')
    
    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        
        if (mobileMenuButton && sidebar && sidebarOverlay) {
            mobileMenuButton.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
                sidebarOverlay.classList.toggle('hidden');
            });
            
            sidebarOverlay.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            });
        }
        
        // Nav group toggle - inicializar grupos abertos
        document.querySelectorAll('.nav-group-items').forEach(items => {
            // Verificar se algum sublink está ativo
            const hasActive = items.querySelector('.nav-sublink.active');
            if (!hasActive) {
                items.classList.add('hidden');
            }
        });
        
        document.querySelectorAll('.nav-group-header').forEach(header => {
            header.addEventListener('click', () => {
                const items = header.nextElementSibling;
                const isOpen = !items.classList.contains('hidden');
                
                if (isOpen) {
                    items.classList.add('hidden');
                } else {
                    items.classList.remove('hidden');
                }
            });
        });
    </script>
</body>
</html>

