@extends('admin.layouts.app')

@section('title', 'Editar Mensagem')
@section('page-title', 'Editar Mensagem')

@section('content')
    <div class="container mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Editar Mensagem</h1>
            <a href="{{ route('admin.contact-messages.show', $contactMessage) }}" class="btn btn-secondary">Voltar</a>
        </div>
        
        <form action="{{ route('admin.contact-messages.update', $contactMessage) }}" method="POST" class="bg-white shadow rounded-lg p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Status -->
                <div>
                    <label class="block font-semibold mb-1">Status *</label>
                    <select name="status" class="form-select w-full" required>
                        <option value="new" {{ old('status', $contactMessage->status) == 'new' ? 'selected' : '' }}>Nova</option>
                        <option value="read" {{ old('status', $contactMessage->status) == 'read' ? 'selected' : '' }}>Lida</option>
                        <option value="replied" {{ old('status', $contactMessage->status) == 'replied' ? 'selected' : '' }}>Respondida</option>
                        <option value="archived" {{ old('status', $contactMessage->status) == 'archived' ? 'selected' : '' }}>Arquivada</option>
                    </select>
                </div>
                
                <!-- Nome -->
                <div>
                    <label class="block font-semibold mb-1">Nome *</label>
                    <input type="text" name="name" class="form-input w-full" value="{{ old('name', $contactMessage->name) }}" required>
                </div>
                
                <!-- Email -->
                <div>
                    <label class="block font-semibold mb-1">Email *</label>
                    <input type="email" name="email" class="form-input w-full" value="{{ old('email', $contactMessage->email) }}" required>
                </div>
                
                <!-- Telefone -->
                <div>
                    <label class="block font-semibold mb-1">Telefone</label>
                    <input type="text" name="phone" class="form-input w-full" value="{{ old('phone', $contactMessage->phone) }}">
                </div>
                
                <!-- Empresa -->
                <div>
                    <label class="block font-semibold mb-1">Empresa</label>
                    <input type="text" name="company" class="form-input w-full" value="{{ old('company', $contactMessage->company) }}">
                </div>
                
                <!-- Assunto -->
                <div>
                    <label class="block font-semibold mb-1">Assunto</label>
                    <input type="text" name="subject" class="form-input w-full" value="{{ old('subject', $contactMessage->subject) }}">
                </div>
                
                <!-- Mensagem -->
                <div class="md:col-span-2">
                    <label class="block font-semibold mb-1">Mensagem *</label>
                    <textarea name="message" class="form-textarea w-full" rows="6" required>{{ old('message', $contactMessage->message) }}</textarea>
                </div>
                
                <!-- Tipo de Projeto -->
                <div>
                    <label class="block font-semibold mb-1">Tipo de Projeto</label>
                    <input type="text" name="project_type" class="form-input w-full" value="{{ old('project_type', $contactMessage->project_type) }}">
                </div>
                
                <!-- Orçamento -->
                <div>
                    <label class="block font-semibold mb-1">Orçamento</label>
                    <input type="text" name="budget_range" class="form-input w-full" value="{{ old('budget_range', $contactMessage->budget_range) }}">
                </div>
                
                <!-- Prazo -->
                <div>
                    <label class="block font-semibold mb-1">Prazo</label>
                    <input type="text" name="timeline" class="form-input w-full" value="{{ old('timeline', $contactMessage->timeline) }}">
                </div>
            </div>
            
            <!-- Mensagens de Erro -->
            @if($errors->any())
                <div class="mt-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="mt-6 flex items-center">
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                <a href="{{ route('admin.contact-messages.show', $contactMessage) }}" class="btn btn-secondary ml-2">Cancelar</a>
            </div>
        </form>
    </div>
@endsection

