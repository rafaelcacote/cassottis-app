@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Projects -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                <i class="fas fa-laptop-code text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <div class="text-2xl font-bold text-gray-900">{{ $stats['total_projects'] }}</div>
                <div class="text-sm text-gray-500">Total de Projetos</div>
            </div>
        </div>
    </div>
    
    <!-- Active Projects -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center">
                <i class="fas fa-play-circle text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <div class="text-2xl font-bold text-gray-900">{{ $stats['active_projects'] }}</div>
                <div class="text-sm text-gray-500">Projetos Ativos</div>
            </div>
        </div>
    </div>
    
    <!-- Published Posts -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center">
                <i class="fas fa-newspaper text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <div class="text-2xl font-bold text-gray-900">{{ $stats['published_posts'] }}</div>
                <div class="text-sm text-gray-500">Posts Publicados</div>
            </div>
        </div>
    </div>
    
    <!-- Draft Posts -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center">
                <i class="fas fa-edit text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <div class="text-2xl font-bold text-gray-900">{{ $stats['draft_posts'] }}</div>
                <div class="text-sm text-gray-500">Posts em Rascunho</div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Projects -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Projetos Recentes</h3>
            <a href="{{ route('admin.projects.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                Ver todos
            </a>
        </div>
        
        @if($recentProjects->count() > 0)
        <div class="space-y-3">
            @foreach($recentProjects as $project)
            <div class="flex items-center justify-between pb-3 border-b border-gray-100 last:border-0">
                <div class="flex-1">
                    <div class="font-medium text-sm text-gray-900">{{ Str::limit($project->title, 30) }}</div>
                    <div class="text-xs text-gray-500">{{ $project->created_at->diffForHumans() }}</div>
                </div>
                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                    {{ $project->status == 'completed' ? 'bg-green-100 text-green-800' : 
                       ($project->status == 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                </span>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-gray-500 text-sm">Nenhum projeto encontrado.</p>
        @endif
    </div>
    
    <!-- Recent Posts -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Posts Recentes</h3>
            <a href="{{ route('admin.blog.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                Ver todos
            </a>
        </div>
        
        @if($recentPosts->count() > 0)
        <div class="space-y-3">
            @foreach($recentPosts as $post)
            <div class="flex items-center justify-between pb-3 border-b border-gray-100 last:border-0">
                <div class="flex-1">
                    <div class="font-medium text-sm text-gray-900">{{ Str::limit($post->title, 30) }}</div>
                    <div class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</div>
                </div>
                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                    {{ $post->status == 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ ucfirst($post->status) }}
                </span>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-gray-500 text-sm">Nenhum post encontrado.</p>
        @endif
    </div>
</div>

<!-- Quick Actions -->
<div class="mt-8">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Ações Rápidas</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary text-center">
                <i class="fas fa-plus mr-2"></i>
                Novo Projeto
            </a>
            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary text-center">
                <i class="fas fa-plus mr-2"></i>
                Novo Post
            </a>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary text-center">
                <i class="fas fa-list mr-2"></i>
                Ver Projetos
            </a>
            <a href="{{ route('home') }}" target="_blank" class="btn btn-secondary text-center">
                <i class="fas fa-external-link-alt mr-2"></i>
                Ver Site
            </a>
        </div>
    </div>
</div>
@endsection

