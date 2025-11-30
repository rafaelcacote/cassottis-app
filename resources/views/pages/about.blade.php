@extends('layouts.app')

@section('title', 'Sobre Mim - Cassottis')

@section('content')
    <section class="page-hero">
        <div class="container">
            <div class="page-hero-content">
                <span class="page-hero-badge">
                    <i class="fas fa-user-circle"></i>
                    Sobre mim
                </span>
                <h1 class="page-hero-title">Tecnologia para transformar desafios em resultados reais</h1>
                <p class="page-hero-text">
                    Sou Rafael Caçote, desenvolvedor full stack com mais de 5 anos de experiência em criar sistemas que
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
                        <img src="{{ asset('images/eu.png') }}" alt="Rafael Caçote">
                        <span class="profile-photo-glow"></span>
                    </div>
                </div>
                <div class="profile-details">
                    <h2 class="section-title">Rafael Caçote</h2>
                    <p class="page-paragraph">
                        Especialista em transformar processos manuais em sistemas web modernos. Lidero projetos de ponta a ponta:
                        da arquitetura ao deploy, sempre com foco em performance, experiência do usuário e resultados mensuráveis
                        para o negócio.
                    </p>
                    <p class="page-paragraph">
                        Minha jornada começou em 2019 e desde então venho desenvolvendo soluções para empresas privadas e órgãos
                        públicos, conectando tecnologia à estratégia para acelerar a tomada de decisão e reduzir custos operacionais.
                    </p>
                    <div class="info-list">
                        <div class="info-item">
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:rafael.cacote@gmail.com">rafael.cacote@gmail.com</a>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-phone"></i>
                            <a href="https://wa.me/5592992684391" target="_blank" rel="noopener">(92) 99268-4391</a>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            Manaus, AM - Brasil
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

    <section class="page-section page-section-alt">
        <div class="container">
            <h2 class="section-title">Experiência profissional</h2>
            <p class="section-subtitle">
                Projetos entregues com foco em soluções sob medida, integração de sistemas e melhoria contínua.
            </p>

            @php
                $experiences = [
                    [
                        'period' => '2022 - Atual',
                        'role' => 'Desenvolvedor Full Stack Pleno',
                        'company' => 'Prefeitura Municipal de Manaus',
                        'description' => 'Liderança técnica, definição de arquitetura e desenvolvimento de sistemas de grande escala para serviços públicos.',
                        'highlights' => [
                            'Mais de 8 projetos críticos entregues em produção',
                            'Implantação de pipelines CI/CD que reduziram o tempo de deploy em 60%',
                            'Criação de integrações entre sistemas legados e novas plataformas',
                        ],
                    ],
                    [
                        'period' => '2018 - 2022',
                        'role' => 'Desenvolvedor de Sistemas',
                        'company' => 'Hospital Beneficente Português',
                        'description' => 'Automação de fluxos hospitalares, integração com APIs e migração de planilhas para sistemas web responsivos.',
                        'highlights' => [
                            'Mais de 9 produtos digitais desenvolvidos para áreas administrativas e clínicas',
                            'Integrações com gateways de pagamento e serviços de terceiros',
                            'Otimização de sistemas existentes garantindo alta disponibilidade',
                        ],
                    ],
                ];
            @endphp

            <div class="timeline">
                @foreach ($experiences as $experience)
                    <div class="timeline-item">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <span class="timeline-period">{{ $experience['period'] }}</span>
                            <h3 class="timeline-title">{{ $experience['role'] }}</h3>
                            <span class="timeline-company">{{ $experience['company'] }}</span>
                            <p class="timeline-description">{{ $experience['description'] }}</p>
                            <ul class="timeline-list">
                                @foreach ($experience['highlights'] as $highlight)
                                    <li>
                                        <i class="fas fa-check"></i>
                                        {{ $highlight }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="page-section">
        <div class="container">
            <div class="split-grid">
                <div>
                    <h2 class="section-title">Habilidades técnicas</h2>
                    <p class="section-subtitle">Stack moderno para aplicações escaláveis e de alta performance.</p>
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
            <p class="section-subtitle">Mais do que tecnologia, entrego parceria, transparência e compromisso.</p>

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
                        Seja para otimizar processos internos, integrar sistemas ou criar um novo produto digital, posso ajudar.
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



