@extends('layouts.app')

@section('title', 'Portfólio - Cassottis')

@section('content')
    <section class="page-hero">
        <div class="container">
            <div class="page-hero-content">
                <span class="page-hero-badge">
                    <i class="fas fa-briefcase"></i>
                    Portfólio
                </span>
                <h1 class="page-hero-title">Projetos que transformaram planilhas em soluções de alto impacto</h1>
                <p class="page-hero-text">
                    Uma seleção de cases que mostram como a tecnologia certa pode automatizar processos, reduzir custos
                    operacionais e criar experiências digitais memoráveis.
                </p>
            </div>
        </div>
    </section>

    @php
        $stats = [
            ['icon' => 'fas fa-rocket', 'value' => '17+', 'label' => 'Projetos entregues'],
            ['icon' => 'fas fa-calendar-check', 'value' => '5+ anos', 'label' => 'Atuando com Laravel & JS'],
            ['icon' => 'fas fa-users', 'value' => '12 setores', 'label' => 'Impactados diretamente'],
            ['icon' => 'fas fa-code-merge', 'value' => '30+', 'label' => 'Integrações construídas'],
        ];
    @endphp

    <section class="page-section">
        <div class="container">
            <div class="page-grid page-grid-4 stats-grid">
                @foreach ($stats as $stat)
                    <div class="page-card">
                        <span class="page-card-icon">
                            <i class="{{ $stat['icon'] }}"></i>
                        </span>
                        <div class="stat-value">{{ $stat['value'] }}</div>
                        <p class="page-card-text">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="page-section page-section-alt">
        <div class="container">
            <h2 class="section-title">Projetos em destaque</h2>
            <p class="section-subtitle">
                Cada projeto combina tecnologia, estratégia e foco em resultados para entregar valor rápido e sustentável.
            </p>

            @if($projects->count() > 0)
                <div class="page-grid page-grid-3">
                    @foreach ($projects as $project)
                        <div class="project-card">
                            @if($project->image || ($project->gallery && count($project->gallery) > 0))
                                <div style="margin-bottom: 1rem; position: relative;">
                                    @if($project->image)
                                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" style="width: 100%; height: 200px; object-fit: cover; border-radius: 0.75rem; border: 1px solid rgba(59, 130, 246, 0.12);">
                                    @elseif($project->gallery && count($project->gallery) > 0)
                                        <img src="{{ asset('storage/' . $project->gallery[0]) }}" alt="{{ $project->title }}" style="width: 100%; height: 200px; object-fit: cover; border-radius: 0.75rem; border: 1px solid rgba(59, 130, 246, 0.12);">
                                    @endif
                                    
                                    @if($project->gallery && count($project->gallery) > 1)
                                        <div style="position: absolute; bottom: 0.5rem; right: 0.5rem; background: rgba(0, 0, 0, 0.7); color: white; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.75rem;">
                                            <i class="fas fa-images"></i> +{{ count($project->gallery) }} imagens
                                        </div>
                                    @endif
                                </div>
                            @endif
                            
                            <div class="project-card-meta">
                                <span class="chip">
                                    <i class="fas fa-layer-group"></i>
                                    Projeto
                                </span>
                                <span class="status-badge status-{{ $project->status }}">
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
                            </div>
                            
                            <h3 class="project-card-title">
                                <a href="{{ route('portfolio.show', $project) }}" style="color: inherit; text-decoration: none;">
                                    {{ $project->title }}
                                </a>
                            </h3>
                            
                            @if($project->completion_date)
                                <p class="project-year">{{ $project->completion_date->format('Y') }}</p>
                            @endif
                            
                            <p class="project-card-text">{{ $project->short_description ?? Str::limit($project->description, 150) }}</p>
                            
                            @if($project->technologies && count($project->technologies) > 0)
                                <div class="tech-stack">
                                    @foreach ($project->technologies as $tech)
                                        <span class="chip">
                                            <i class="fas fa-circle"></i>
                                            {{ $tech }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                            
                            <div class="project-links">
                                @if($project->project_url)
                                    <a href="{{ $project->project_url }}" target="_blank" rel="noopener">
                                        Ver projeto
                                        <i class="fas fa-arrow-up-right-from-square"></i>
                                    </a>
                                @endif
                                @if($project->github_url)
                                    <a href="{{ $project->github_url }}" target="_blank" rel="noopener">
                                        GitHub
                                        <i class="fas fa-arrow-up-right-from-square"></i>
                                    </a>
                                @endif
                                @if($project->demo_url)
                                    <a href="{{ $project->demo_url }}" target="_blank" rel="noopener">
                                        Demo
                                        <i class="fas fa-arrow-up-right-from-square"></i>
                                    </a>
                                @endif
                                <a href="{{ route('portfolio.show', $project) }}">
                                    Ver detalhes
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Paginação -->
                @if($projects->hasPages())
                    <div style="margin-top: 3rem; display: flex; justify-content: center;">
                        {{ $projects->links() }}
                    </div>
                @endif
            @else
                <div style="text-align: center; padding: 3rem 0;">
                    <p style="color: var(--text-secondary); font-size: 1.125rem;">
                        Nenhum projeto encontrado no momento.
                    </p>
                </div>
            @endif
        </div>
    </section>

    <section class="page-section">
        <div class="container">
            <div class="split-grid">
                <div>
                    <h2 class="section-title">O que os projetos têm em comum</h2>
                    <p class="section-subtitle">Aprendizados aplicados em cada entrega para garantir evolução contínua.</p>
                    <ul class="feature-list feature-list-large">
                        <li>
                            <i class="fas fa-shield-alt"></i>
                            Segurança desde o planejamento com autenticação robusta, logs e backups automatizados.
                        </li>
                        <li>
                            <i class="fas fa-gauge-high"></i>
                            Performance focada em alto volume de dados, filas, cache e monitoramento constante.
                        </li>
                        <li>
                            <i class="fas fa-people-arrows"></i>
                            Experiência do usuário construída com entrevistas, protótipos e testes iterativos.
                        </li>
                        <li>
                            <i class="fas fa-chart-line"></i>
                            Métricas e dashboards para acompanhar a operação e orientar decisões de negócio.
                        </li>
                    </ul>
                </div>
                <div class="project-highlight-card">
                    <h3>Ferramentas utilizadas no dia a dia</h3>
                    <div class="tech-stack tech-stack-wrap">
                        @foreach (['Laravel', 'PHP', 'React', 'Vue.js', 'Tailwind', 'Livewire', 'Docker', 'GitHub Actions', 'AWS', 'Supabase', 'PostgreSQL', 'MySQL', 'Redis', 'Metabase', 'Sentry'] as $tool)
                            <span class="chip">
                                <i class="fas fa-circle"></i>
                                {{ $tool }}
                            </span>
                        @endforeach
                    </div>
                    <p class="project-highlight-note">
                        A escolha da stack é sempre baseada no contexto do cliente, requisitos técnicos e visão de longo prazo.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="page-section cta-section">
        <div class="container">
            <div class="cta-card">
                <div>
                    <h2 class="section-title">Quer ver algo parecido na sua empresa?</h2>
                    <p class="section-subtitle">
                        Me conte sobre os desafios atuais e receba um roadmap com ideias, prazos e investimento estimado.
                    </p>
                </div>
                <div class="cta-actions">
                    <a href="{{ route('contact') }}" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i>
                        Falar sobre um projeto
                    </a>
                    <a href="{{ route('services') }}" class="btn btn-outline">
                        <i class="fas fa-layer-group"></i>
                        Conhecer serviços
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection



