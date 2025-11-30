@extends('admin.layouts.app')

@section('title', 'Posts do Blog')

@section('content')
    <div class="container mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Posts do Blog</h1>
            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">Novo Post</a>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Título</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Publicado em</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($posts as $post)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">
                                <div class="text-sm font-medium text-gray-900">{{ $post->title }}</div>
                                @if($post->excerpt)
                                    <div class="text-xs text-gray-500 mt-1">{{ Str::limit($post->excerpt, 60) }}</div>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center">
                                <span class="badge {{ $post->status === 'published' ? 'bg-green-500 text-white' : 'bg-gray-400 text-white' }}">
                                    {{ ucfirst($post->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-center text-sm text-gray-500">
                                {{ $post->published_at ? $post->published_at->format('d/m/Y H:i') : '-' }}
                            </td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex gap-2 justify-center">
                                    <a href="{{ route('admin.blog.edit', $post) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <a href="{{ route('admin.blog.show', $post) }}" class="btn btn-sm btn-info">Ver</a>
                                    <form action="{{ route('admin.blog.destroy', $post) }}" method="POST" onsubmit="return confirm('Tem certeza?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">Nenhum post encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">{{ $posts->links() }}</div>
        </div>
    </div>
@endsection

