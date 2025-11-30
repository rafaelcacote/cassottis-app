@extends('layouts.app')

@section('title', $project->title . ' - Portfólio')

@section('content')
    <section class="page-hero">
        <div class="container">
            <div class="page-hero-content">
                <span class="page-hero-badge">
                    <i class="fas fa-briefcase"></i>
                    Portfólio
                </span>
                <h1 class="page-hero-title">{{ $project->title }}</h1>
                @if($project->short_description)
                    <p class="page-hero-text">{{ $project->short_description }}</p>
                @endif
            </div>
        </div>
    </section>

    <section class="page-section">
        <div class="container">
            <div class="split-grid">
                <div>
                    <h2 class="section-title">Sobre o Projeto</h2>
                    <div class="page-paragraph">
                        {!! nl2br(e($project->description)) !!}
                    </div>

                    @if($project->technologies && count($project->technologies) > 0)
                        <div style="margin-top: 2rem;">
                            <h3 style="font-size: 1.25rem; color: var(--text-primary); margin-bottom: 1rem;">Tecnologias Utilizadas</h3>
                            <div class="tech-stack tech-stack-wrap">
                                @foreach ($project->technologies as $tech)
                                    <span class="chip">
                                        <i class="fas fa-circle"></i>
                                        {{ $tech }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($project->project_url || $project->github_url || $project->demo_url)
                        <div style="margin-top: 2rem;">
                            <h3 style="font-size: 1.25rem; color: var(--text-primary); margin-bottom: 1rem;">Links do Projeto</h3>
                            <div class="project-links" style="flex-direction: column; align-items: flex-start; gap: 0.75rem;">
                                @if($project->project_url)
                                    <a href="{{ $project->project_url }}" target="_blank" rel="noopener">
                                        <i class="fas fa-external-link-alt"></i>
                                        Ver Projeto
                                        <i class="fas fa-arrow-up-right-from-square"></i>
                                    </a>
                                @endif
                                @if($project->github_url)
                                    <a href="{{ $project->github_url }}" target="_blank" rel="noopener">
                                        <i class="fab fa-github"></i>
                                        Código no GitHub
                                        <i class="fas fa-arrow-up-right-from-square"></i>
                                    </a>
                                @endif
                                @if($project->demo_url)
                                    <a href="{{ $project->demo_url }}" target="_blank" rel="noopener">
                                        <i class="fas fa-play-circle"></i>
                                        Ver Demonstração
                                        <i class="fas fa-arrow-up-right-from-square"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <div>
                    <div class="page-card">
                        <h3 style="font-size: 1.25rem; color: var(--text-primary); margin-bottom: 1rem;">Informações do Projeto</h3>
                        <div class="info-list">
                            <div class="info-item">
                                <i class="fas fa-calendar"></i>
                                <span>
                                    @if($project->completion_date)
                                        Concluído em {{ $project->completion_date->format('d/m/Y') }}
                                    @else
                                        Data não informada
                                    @endif
                                </span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-tasks"></i>
                                <span>
                                    Status: 
                                    <span class="status-badge status-{{ $project->status }}" style="margin-left: 0.5rem;">
                                        @switch($project->status)
                                            @case('completed')
                                                Concluído
                                            @break
                                            @case('in_progress')
                                                Em andamento
                                            @break
                                            @case('planned')
                                                Planejado
                                            @break
                                            @default
                                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                        @endswitch
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($project->image || ($project->gallery && count($project->gallery) > 0))
        <section class="page-section page-section-alt">
            <div class="container">
                <h2 class="section-title">Galeria de Imagens</h2>
                <p class="section-subtitle">
                    Imagens e capturas de tela do projeto.
                </p>

                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
                    @if($project->image)
                        <div style="position: relative; overflow: hidden; border-radius: 0.75rem; border: 1px solid rgba(59, 130, 246, 0.12); background: rgba(26, 26, 26, 0.6);">
                            <img src="{{ asset('storage/' . $project->image) }}" 
                                 alt="{{ $project->title }}" 
                                 style="width: 100%; height: auto; display: block; cursor: pointer;"
                                 onclick="openLightbox('{{ asset('storage/' . $project->image) }}')">
                            <div style="position: absolute; top: 0.5rem; left: 0.5rem; background: rgba(59, 130, 246, 0.8); color: white; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.75rem;">
                                <i class="fas fa-star"></i> Imagem Principal
                            </div>
                        </div>
                    @endif

                    @if($project->gallery && count($project->gallery) > 0)
                        @foreach($project->gallery as $index => $image)
                            <div style="position: relative; overflow: hidden; border-radius: 0.75rem; border: 1px solid rgba(59, 130, 246, 0.12); background: rgba(26, 26, 26, 0.6);">
                                <img src="{{ asset('storage/' . $image) }}" 
                                     alt="{{ $project->title }} - Imagem {{ $index + 1 }}" 
                                     style="width: 100%; height: auto; display: block; cursor: pointer; transition: transform 0.3s ease;"
                                     onmouseover="this.style.transform='scale(1.05)'"
                                     onmouseout="this.style.transform='scale(1)'"
                                     onclick="openLightbox('{{ asset('storage/' . $image) }}')">
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
    @endif

    <!-- Lightbox Modal -->
    <div id="lightbox" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.95); z-index: 9999; cursor: pointer; align-items: center; justify-content: center;"
         onclick="closeLightbox()">
        <img id="lightbox-img" src="" alt="" style="max-width: 90%; max-height: 90%; object-fit: contain; border-radius: 0.5rem;">
        <button onclick="closeLightbox(); event.stopPropagation();" 
                style="position: absolute; top: 1rem; right: 1rem; background: rgba(255, 255, 255, 0.1); border: none; color: white; font-size: 2rem; width: 3rem; height: 3rem; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <section class="page-section">
        <div class="container">
            <div style="text-align: center;">
                <a href="{{ route('portfolio') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i>
                    Voltar para o Portfólio
                </a>
            </div>
        </div>
    </section>

    <script>
        function openLightbox(imageSrc) {
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightbox-img');
            lightboxImg.src = imageSrc;
            lightbox.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Fechar com ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLightbox();
            }
        });
    </script>
@endsection


