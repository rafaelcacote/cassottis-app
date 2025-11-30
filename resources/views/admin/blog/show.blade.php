@extends('admin.layouts.app')

@section('title', $post->title)

@section('content')
    <div class="container mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">{{ $post->title }}</h1>
            <div class="flex gap-2">
                <a href="{{ route('admin.blog.edit', $post) }}" class="btn btn-warning">Editar</a>
                <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
        
        <div class="bg-white shadow rounded-lg p-6">
            <div class="mb-4">
                <span class="badge {{ $post->status === 'published' ? 'bg-green-500 text-white' : 'bg-gray-400 text-white' }}">
                    {{ ucfirst($post->status) }}
                </span>
                @if($post->published_at)
                    <span class="ml-2 text-sm text-gray-500">Publicado em: {{ $post->published_at->format('d/m/Y H:i') }}</span>
                @endif
            </div>
            
            @if($post->featured_image)
                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full rounded-lg mb-4">
            @endif
            
            @if($post->excerpt)
                <div class="mb-4">
                    <h3 class="font-semibold mb-2">Resumo</h3>
                    <p class="text-gray-700">{{ $post->excerpt }}</p>
                </div>
            @endif
            
            <div class="mb-4">
                <h3 class="font-semibold mb-2">Conteúdo</h3>
                <div class="prose max-w-none whitespace-pre-wrap">{{ $post->content }}</div>
            </div>
            
            @if($post->tags && count($post->tags) > 0)
                <div class="mt-4">
                    <h3 class="font-semibold mb-2">Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($post->tags as $tag)
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-sm">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

