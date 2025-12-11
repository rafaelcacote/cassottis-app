@extends('admin.layouts.app')

@section('title', 'Mensagem de Contato')
@section('page-title', 'Mensagem de Contato')

@section('content')
    <div class="container mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Mensagem de Contato</h1>
            <div class="flex gap-2">
                <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary">Voltar</a>
                <a href="{{ route('admin.contact-messages.edit', $contactMessage) }}" class="btn btn-warning">Editar</a>
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Informações Principais -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Mensagem -->
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">Mensagem</h2>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                            {{ $contactMessage->status === 'new' ? 'bg-blue-100 text-blue-800' : 
                               ($contactMessage->status === 'read' ? 'bg-gray-100 text-gray-800' : 
                               ($contactMessage->status === 'replied' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800')) }}">
                            @if($contactMessage->status === 'new')
                                Nova
                            @elseif($contactMessage->status === 'read')
                                Lida
                            @elseif($contactMessage->status === 'replied')
                                Respondida
                            @else
                                Arquivada
                            @endif
                        </span>
                    </div>
                    
                    @if($contactMessage->subject)
                        <div class="mb-4">
                            <h3 class="text-sm font-medium text-gray-700 mb-1">Assunto</h3>
                            <p class="text-gray-900">{{ $contactMessage->subject }}</p>
                        </div>
                    @endif
                    
                    <div>
                        <h3 class="text-sm font-medium text-gray-700 mb-1">Mensagem</h3>
                        <p class="text-gray-900 whitespace-pre-wrap">{{ $contactMessage->message }}</p>
                    </div>
                </div>
                
                <!-- Informações do Projeto (se disponível) -->
                @if($contactMessage->project_type || $contactMessage->budget_range || $contactMessage->timeline)
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Informações do Projeto</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @if($contactMessage->project_type)
                            <div>
                                <h3 class="text-sm font-medium text-gray-700 mb-1">Tipo de Projeto</h3>
                                <p class="text-gray-900">{{ $contactMessage->project_type }}</p>
                            </div>
                        @endif
                        @if($contactMessage->budget_range)
                            <div>
                                <h3 class="text-sm font-medium text-gray-700 mb-1">Orçamento</h3>
                                <p class="text-gray-900">{{ $contactMessage->budget_range }}</p>
                            </div>
                        @endif
                        @if($contactMessage->timeline)
                            <div>
                                <h3 class="text-sm font-medium text-gray-700 mb-1">Prazo</h3>
                                <p class="text-gray-900">{{ $contactMessage->timeline }}</p>
                            </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Sidebar com Informações de Contato -->
            <div class="space-y-6">
                <!-- Informações de Contato -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Informações de Contato</h2>
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-700 mb-1">Nome</h3>
                            <p class="text-gray-900">{{ $contactMessage->name }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-700 mb-1">Email</h3>
                            <p class="text-gray-900">
                                <a href="mailto:{{ $contactMessage->email }}" class="text-blue-600 hover:underline">
                                    {{ $contactMessage->email }}
                                </a>
                            </p>
                        </div>
                        @if($contactMessage->phone)
                            <div>
                                <h3 class="text-sm font-medium text-gray-700 mb-1">Telefone</h3>
                                <p class="text-gray-900">
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactMessage->phone) }}" 
                                       target="_blank" 
                                       class="text-green-600 hover:underline">
                                        {{ $contactMessage->phone }}
                                        <i class="fab fa-whatsapp ml-1"></i>
                                    </a>
                                </p>
                            </div>
                        @endif
                        @if($contactMessage->company)
                            <div>
                                <h3 class="text-sm font-medium text-gray-700 mb-1">Empresa</h3>
                                <p class="text-gray-900">{{ $contactMessage->company }}</p>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Informações Técnicas -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Informações Técnicas</h2>
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-700 mb-1">Data de Envio</h3>
                            <p class="text-gray-900">{{ $contactMessage->created_at->format('d/m/Y H:i:s') }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $contactMessage->created_at->diffForHumans() }}</p>
                        </div>
                        @if($contactMessage->ip_address)
                            <div>
                                <h3 class="text-sm font-medium text-gray-700 mb-1">IP Address</h3>
                                <p class="text-gray-900 font-mono text-sm">{{ $contactMessage->ip_address }}</p>
                            </div>
                        @endif
                        @if($contactMessage->updated_at && $contactMessage->updated_at != $contactMessage->created_at)
                            <div>
                                <h3 class="text-sm font-medium text-gray-700 mb-1">Última Atualização</h3>
                                <p class="text-gray-900">{{ $contactMessage->updated_at->format('d/m/Y H:i:s') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Ações Rápidas -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Ações Rápidas</h2>
                    <div class="space-y-2">
                        @if($contactMessage->status === 'new')
                            <form action="{{ route('admin.contact-messages.mark-as-read', $contactMessage) }}" method="POST" class="inline w-full">
                                @csrf
                                <button type="submit" class="btn btn-primary w-full text-left">
                                    <i class="fas fa-check mr-2"></i>
                                    Marcar como Lida
                                </button>
                            </form>
                        @endif
                        
                        @if($contactMessage->status !== 'replied')
                            <form action="{{ route('admin.contact-messages.mark-as-replied', $contactMessage) }}" method="POST" class="inline w-full">
                                @csrf
                                <button type="submit" class="btn btn-success w-full text-left">
                                    <i class="fas fa-reply mr-2"></i>
                                    Marcar como Respondida
                                </button>
                            </form>
                        @endif
                        
                        @if($contactMessage->status !== 'archived')
                            <form action="{{ route('admin.contact-messages.archive', $contactMessage) }}" method="POST" class="inline w-full">
                                @csrf
                                <button type="submit" class="btn btn-secondary w-full text-left">
                                    <i class="fas fa-archive mr-2"></i>
                                    Arquivar
                                </button>
                            </form>
                        @endif
                        
                        <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ $contactMessage->subject ?: 'Contato' }}" 
                           class="btn btn-info w-full text-left">
                            <i class="fas fa-envelope mr-2"></i>
                            Responder por Email
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

