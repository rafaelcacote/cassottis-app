@extends('admin.layouts.app')

@section('title', 'Editar Projeto')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Editar Projeto</h1>
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded-lg p-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-semibold mb-1">Título *</label>
                    <input type="text" name="title" class="form-input w-full" value="{{ old('title', $project->title) }}" required>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Tecnologias (separadas por vírgula) *</label>
                    <input type="text" name="technologies" class="form-input w-full" value="{{ old('technologies', $project->technologiesString) }}" required>
                </div>
                <div class="md:col-span-2">
                    <label class="block font-semibold mb-1">Descrição Curta *</label>
                    <textarea name="short_description" class="form-textarea w-full" rows="2" required>{{ old('short_description', $project->short_description) }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="block font-semibold mb-1">Descrição Completa *</label>
                    <textarea name="description" class="form-textarea w-full" rows="6" required>{{ old('description', $project->description) }}</textarea>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Imagem de Capa</label>
                    @if($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" alt="Imagem atual" class="h-32 w-32 object-cover rounded border mb-2">
                    @endif
                    <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" class="form-input w-full">
                    <p class="text-sm text-gray-500 mt-1">Formatos aceitos: JPEG, PNG, JPG, GIF, WEBP (máx. 5MB)</p>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Galeria de Imagens</label>
                    @if($project->gallery && count($project->gallery) > 0)
                        <div class="flex flex-wrap gap-2 mb-2">
                            @foreach($project->gallery as $img)
                                <img src="{{ asset('storage/' . $img) }}" alt="Galeria" class="h-24 w-24 object-cover rounded border">
                            @endforeach
                        </div>
                    @endif
                    <input type="file" name="gallery[]" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" multiple class="form-input w-full">
                    <p class="text-sm text-gray-500 mt-1">Formatos aceitos: JPEG, PNG, JPG, GIF, WEBP (máx. 5MB cada)</p>
                </div>
                <div>
                    <label class="block font-semibold mb-1">URL do Projeto</label>
                    <input type="url" name="project_url" class="form-input w-full" value="{{ old('project_url', $project->project_url) }}">
                </div>
                <div>
                    <label class="block font-semibold mb-1">URL do GitHub</label>
                    <input type="url" name="github_url" class="form-input w-full" value="{{ old('github_url', $project->github_url) }}">
                </div>
                <div>
                    <label class="block font-semibold mb-1">URL de Demonstração</label>
                    <input type="url" name="demo_url" class="form-input w-full" value="{{ old('demo_url', $project->demo_url) }}">
                </div>
                <div>
                    <label class="block font-semibold mb-1">Status *</label>
                    <select name="status" class="form-select w-full" required>
                        <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>Concluído</option>
                        <option value="in_progress" {{ old('status', $project->status) == 'in_progress' ? 'selected' : '' }}>Em andamento</option>
                        <option value="planned" {{ old('status', $project->status) == 'planned' ? 'selected' : '' }}>Planejado</option>
                        <option value="cancelled" {{ old('status', $project->status) == 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Data de Conclusão</label>
                    <input type="date" name="completion_date" class="form-input w-full" value="{{ old('completion_date', $project->completion_date?->format('Y-m-d')) }}">
                </div>
                <div class="flex items-center space-x-4">
                    <label class="block font-semibold mb-1">Destaque?</label>
                    <input type="checkbox" name="featured" value="1" {{ old('featured', $project->featured) ? 'checked' : '' }}> Sim
                </div>
                <div>
                    <label class="block font-semibold mb-1">Ordem</label>
                    <input type="number" name="order" class="form-input w-full" value="{{ old('order', $project->order) }}">
                </div>
                <div class="flex items-center space-x-4">
                    <label class="block font-semibold mb-1">Ativo?</label>
                    <input type="checkbox" name="active" value="1" {{ old('active', $project->active) ? 'checked' : '' }}> Sim
                </div>
            </div>
            <div class="mt-6 flex items-center">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary ml-2">Cancelar</a>
            </div>
        </form>
    </div>
@endsection

