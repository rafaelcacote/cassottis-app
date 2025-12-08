@extends('layouts.app')

@section('title', 'Sobre Nós - Cassottis')

@section('content')
    <section class="page-hero">
        <div class="container">
            <div class="page-hero-content">
                <span class="page-hero-badge">
                    <i class="fas fa-building"></i>
                    Sobre nós
                </span>
                <h1 class="page-hero-title">Tecnologia para transformar desafios em resultados reais</h1>
                <p class="page-hero-text">
                    Somos uma equipe de desenvolvimento full stack especializada em criar sistemas que
                    substituem planilhas complexas por soluções digitais inteligentes, escaláveis e seguras.
                </p>
            </div>
        </div>
    </section>

    <section class="page-section">
        <div class="container">
            <div class="split-grid">
                <div class="profile-card">
                    <div class="profile-photo">
                        <img src="{{ asset('images/sistema.png') }}" alt="Dashboard de Sistema">
                        <span class="profile-photo-glow"></span>
                    </div>
                </div>
                <div class="profile-details">
                    <h2 class="section-title">Como desenvolvemos sistemas</h2>
                    <p class="page-paragraph">
                        Nossa equipe é especializada em transformar processos manuais em sistemas web modernos. Desenvolvemos projetos de ponta a ponta:
                        da arquitetura ao deploy, sempre com foco em performance, experiência do usuário e resultados mensuráveis
                        para o negócio.
                    </p>
                    <p class="page-paragraph">
                        Trabalhamos com metodologias ágeis e práticas modernas de desenvolvimento, criando soluções para empresas privadas e órgãos
                        públicos. Conectamos tecnologia à estratégia para acelerar a tomada de decisão e reduzir custos operacionais.
                    </p>
                    <div class="info-list">
                        <div class="info-item">
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:contato@cassottis.com">contato@cassottis.com</a>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-phone"></i>
                            <a href="https://wa.me/5592981075083" target="_blank" rel="noopener">(92) 98107-5083</a>
                        </div>
                        
                    </div>
                    <div class="profile-actions">
                        <a href="{{ route('services') }}" class="btn btn-primary">
                            <i class="fas fa-rocket"></i>
                            Ver serviços
                        </a>
                        <a href="{{ route('contact') }}" class="btn btn-outline">
                            <i class="fas fa-envelope-open-text"></i>
                            Falar sobre um projeto
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="page-section">
        <div class="container">
            <div class="split-grid">
                <div>
                    <h2 class="section-title">Habilidades técnicas</h2>
                    <p class="section-subtitle">Tecnologias que utilizamos para criar aplicações escaláveis e de alta performance.</p>
                    @php
                        $skills = [
                            ['name' => 'Laravel & PHP', 'level' => 95],
                            ['name' => 'React & JavaScript', 'level' => 90],
                            ['name' => 'Vue.js & SPAs', 'level' => 85],
                            ['name' => 'APIs RESTful & Integrations', 'level' => 90],
                            ['name' => 'MySQL & PostgreSQL', 'level' => 88],
                            ['name' => 'DevOps (Docker, CI/CD)', 'level' => 80],
                        ];
                    @endphp
                    <div class="skill-list">
                        @foreach ($skills as $skill)
                            <div class="skill-item">
                                <div class="skill-label">
                                    <span>{{ $skill['name'] }}</span>
                                    <span>{{ $skill['level'] }}%</span>
                                </div>
                                <div class="skill-bar">
                                    <div class="skill-bar-fill" style="width: {{ $skill['level'] }}%;"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div>
                    <h2 class="section-title">Competências humanas</h2>
                    <p class="section-subtitle">Relacionamentos sólidos e colaboração orientada a resultados.</p>
                    @php
                        $softSkills = [
                            'Liderança técnica e mentoria',
                            'Comunicação clara com stakeholders',
                            'Resolução de problemas complexos',
                            'Planejamento estratégico e visão de produto',
                            'Trabalho em equipe multidisciplinar',
                            'Gestão de tempo e priorização',
                            'Aprendizado contínuo',
                            'Mentalidade orientada a dados',
                        ];
                    @endphp
                    <div class="chip-list">
                        @foreach ($softSkills as $softSkill)
                            <span class="chip">
                                <i class="fas fa-check-circle"></i>
                                {{ $softSkill }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="page-section page-section-alt">
        <div class="container">
            <h2 class="section-title">Valores que guiam cada projeto</h2>
            <p class="section-subtitle">Mais do que tecnologia, entregamos parceria, transparência e compromisso.</p>

            @php
                $values = [
                    [
                        'icon' => 'fas fa-heart',
                        'title' => 'Paixão por criar',
                        'description' => 'Energia diária para construir soluções que façam diferença nas empresas e na vida das pessoas.',
                    ],
                    [
                        'icon' => 'fas fa-handshake',
                        'title' => 'Transparência total',
                        'description' => 'Processos claros do planejamento à entrega, com comunicação constante e honesta.',
                    ],
                    [
                        'icon' => 'fas fa-rocket',
                        'title' => 'Inovação prática',
                        'description' => 'Tecnologia moderna aplicada de forma estratégica, com foco em resultados e ROI.',
                    ],
                    [
                        'icon' => 'fas fa-users',
                        'title' => 'Colaboração',
                        'description' => 'Cocriação com equipes internas, usuários e stakeholders para garantir aderência às necessidades reais.',
                    ],
                ];
            @endphp

            <div class="page-grid page-grid-4">
                @foreach ($values as $value)
                    <div class="page-card">
                        <span class="page-card-icon">
                            <i class="{{ $value['icon'] }}"></i>
                        </span>
                        <h3 class="page-card-title">{{ $value['title'] }}</h3>
                        <p class="page-card-text">{{ $value['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="page-section cta-section">
        <div class="container">
            <div class="cta-card">
                <div>
                    <h2 class="section-title">Vamos construir seu próximo projeto?</h2>
                    <p class="section-subtitle">
                        Seja para otimizar processos internos, integrar sistemas ou criar um novo produto digital, podemos ajudar.
                    </p>
                </div>
                <div class="cta-actions">
                    <a href="{{ route('contact') }}" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i>
                        Iniciar conversa
                    </a>
                    <a href="{{ route('portfolio') }}" class="btn btn-outline">
                        <i class="fas fa-eye"></i>
                        Ver portfólio
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection



