@extends('admin.layouts.app')

@section('title', 'Mensagens de Contato')
@section('page-title', 'Mensagens de Contato')

@section('content')
    <div class="container mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold">Mensagens de Contato</h1>
                @if($unreadCount > 0)
                    <p class="text-sm text-gray-600 mt-1">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            {{ $unreadCount }} {{ $unreadCount === 1 ? 'mensagem não lida' : 'mensagens não lidas' }}
                        </span>
                    </p>
                @endif
            </div>
        </div>

        <!-- Filtros -->
        <div class="bg-white shadow rounded-lg p-4 mb-6">
            <form method="GET" action="{{ route('admin.contact-messages.index') }}" class="flex flex-wrap gap-4 items-end">
                <div class="flex-1 min-w-[200px]">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Buscar</label>
                    <input type="text" 
                           id="search" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Nome, email, empresa ou mensagem..."
                           class="form-input">
                </div>
                <div class="min-w-[150px]">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select id="status" name="status" class="form-select">
                        <option value="">Todas (exceto arquivadas)</option>
                        <option value="all" {{ request('status') === 'all' ? 'selected' : '' }}>Todas (incluindo arquivadas)</option>
                        <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>Novas</option>
                        <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Lidas</option>
                        <option value="replied" {{ request('status') === 'replied' ? 'selected' : '' }}>Respondidas</option>
                        <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Arquivadas</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                    @if(request('search') || request('status'))
                        <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary ml-2">Limpar</a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Tabela de Mensagens -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Empresa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assunto</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($messages as $message)
                        <tr class="hover:bg-gray-50 {{ ($message->status === 'new' || $message->status === null) ? 'bg-blue-50' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $message->name }}
                                    @if($message->status === 'new' || $message->status === null)
                                        <span class="ml-2 inline-flex items-center justify-center w-2 h-2 bg-red-500 rounded-full"></span>
                                    @endif
                                </div>
                                @if($message->phone)
                                    <div class="text-xs text-gray-500 mt-1">{{ $message->phone }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $message->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $message->company ?: '-' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ Str::limit($message->subject ?: 'Sem assunto', 40) }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ Str::limit($message->message, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    {{ ($message->status === 'new' || $message->status === null) ? 'bg-blue-100 text-blue-800' : 
                                       ($message->status === 'read' ? 'bg-gray-100 text-gray-800' : 
                                       ($message->status === 'replied' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800')) }}">
                                    @if($message->status === 'new' || $message->status === null)
                                        Nova
                                    @elseif($message->status === 'read')
                                        Lida
                                    @elseif($message->status === 'replied')
                                        Respondida
                                    @else
                                        Arquivada
                                    @endif
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                {{ $message->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex gap-1 justify-center items-center">
                                    <a href="{{ route('admin.contact-messages.show', $message) }}" 
                                       class="inline-flex items-center justify-center w-8 h-8 text-blue-700 bg-blue-100 hover:bg-blue-200 rounded-lg transition-colors duration-200"
                                       title="Visualizar mensagem">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.contact-messages.edit', $message) }}" 
                                       class="inline-flex items-center justify-center w-8 h-8 text-amber-700 bg-amber-100 hover:bg-amber-200 rounded-lg transition-colors duration-200"
                                       title="Editar mensagem">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.contact-messages.destroy', $message) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Tem certeza que deseja excluir esta mensagem?')"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center justify-center w-8 h-8 text-red-700 bg-red-100 hover:bg-red-200 rounded-lg transition-colors duration-200"
                                                title="Excluir mensagem">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-8 text-gray-500">
                                Nenhuma mensagem encontrada.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $messages->links() }}
            </div>
        </div>
    </div>
@endsection

