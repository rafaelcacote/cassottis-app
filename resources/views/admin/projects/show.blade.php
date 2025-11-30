@extends('admin.layouts.app')

@section('title', $project->title)

@section('content')
    <div class="container mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">{{ $project->title }}</h1>
            <div class="flex gap-2">
                <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning">Editar</a>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
        
        <div class="bg-white shadow rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-semibold mb-2">Status</h3>
                    <p class="mb-4">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full
                            {{ $project->status === 'completed' ? 'bg-green-100 text-green-800' : 
                               ($project->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                            {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                        </span>
                    </p>
                    
                    <h3 class="font-semibold mb-2">Tecnologias</h3>
                    <p class="mb-4">{{ $project->technologiesString }}</p>
                    
                    <h3 class="font-semibold mb-2">URLs</h3>
                    <div class="space-y-2 mb-4">
                        @if($project->project_url)
                            <p><a href="{{ $project->project_url }}" target="_blank" class="text-blue-600 hover:underline">Ver Projeto</a></p>
                        @endif
                        @if($project->github_url)
                            <p><a href="{{ $project->github_url }}" target="_blank" class="text-blue-600 hover:underline">GitHub</a></p>
                        @endif
                        @if($project->demo_url)
                            <p><a href="{{ $project->demo_url }}" target="_blank" class="text-blue-600 hover:underline">Demo</a></p>
                        @endif
                    </div>
                </div>
                
                <div>
                    @if($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full rounded-lg mb-4">
                    @endif
                </div>
            </div>
            
            <div class="mt-6">
                <h3 class="font-semibold mb-2">Descrição Curta</h3>
                <p class="mb-4">{{ $project->short_description }}</p>
                
                <h3 class="font-semibold mb-2">Descrição Completa</h3>
                <p class="whitespace-pre-wrap">{{ $project->description }}</p>
            </div>
        </div>
    </div>
@endsection

