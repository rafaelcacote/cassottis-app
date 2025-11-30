@extends('layouts.app')

@section('title', 'Serviços - Cassottis')

@section('content')
    <section class="page-hero">
        <div class="container">
            <div class="page-hero-content">
                <span class="page-hero-badge">
                    <i class="fas fa-rocket"></i>
                    Serviços
                </span>
                <h1 class="page-hero-title">Soluções completas em desenvolvimento web e transformação digital</h1>
                <p class="page-hero-text">
                    Do diagnóstico à entrega, transformamos suas planilhas em sistemas sob medida que eliminam retrabalho e integram tecnologias para acelerar o crescimento do seu negócio.
                </p>
            </div>
        </div>
    </section>

    <section class="page-section">
        <div class="container">
            <h2 class="section-title">Serviços principais</h2>
            <p class="section-subtitle">
                Projetos desenhados de ponta a ponta para entregar valor, performance e escalabilidade desde o primeiro dia.
            </p>

            @php
                $mainServices = [
                    [
                        'icon' => 'fas fa-laptop-code',
                        'title' => 'Sistemas web sob medida',
                        'description' => 'Aplicações completas para substituir planilhas e processos manuais por sistemas inteligentes.',
                        'features' => [
                            'Arquitetura planejada para crescer com o negócio',
                            'Automação de rotinas e notificações inteligentes',
                            'Dashboards com indicadores em tempo real',
                            'Integração com APIs, ERPs e CRMs',
                            'Suporte a múltiplos perfis de usuários e permissões',
                        ],
                        'technologies' => ['Laravel', 'Livewire', 'React', 'Vue.js', 'MySQL', 'PostgreSQL'],
                    ],
                    [
                        'icon' => 'fas fa-diagram-project',
                        'title' => 'Portais, intranets e workflows',
                        'description' => 'Digitalização de fluxos internos, gestão documental e colaboração segura para equipes.',
                        'features' => [
                            'Gestão de processos e aprovações',
                            'Controle de acesso avançado',
                            'Auditoria e trilha de mudanças',
                            'Relatórios customizados',
                            'Aplicações responsivas e acessíveis',
                        ],
                        'technologies' => ['Laravel', 'Filament', 'Tailwind', 'Redis', 'Docker', 'CI/CD'],
                    ],
                    [
                        'icon' => 'fas fa-plug',
                        'title' => 'APIs, integrações e automações',
                        'description' => 'Conecte sistemas diferentes, unifique dados e reduza erros com integrações seguras.',
                        'features' => [
                            'APIs RESTful documentadas',
                            'Microsserviços e filas de processamento',
                            'Integração com gateways de pagamento',
                            'Sincronização com serviços de terceiros',
                            'Monitoramento e observabilidade',
                        ],
                        'technologies' => ['Laravel', 'Node.js', 'AWS', 'Supabase', 'RabbitMQ', 'Postman'],
                    ],
                ];
            @endphp

            <div class="page-grid page-grid-3">
                @foreach ($mainServices as $service)
                    <div class="page-card page-card-highlight">
                        <span class="page-card-icon">
                            <i class="{{ $service['icon'] }}"></i>
                        </span>
                        <h3 class="page-card-title">{{ $service['title'] }}</h3>
                        <p class="page-card-text">{{ $service['description'] }}</p>
                        <ul class="feature-list">
                            @foreach ($service['features'] as $feature)
                                <li>
                                    <i class="fas fa-check"></i>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                        <div class="tech-stack">
                            @foreach ($service['technologies'] as $tech)
                                <span class="chip">
                                    <i class="fas fa-circle"></i>
                                    {{ $tech }}
                                </span>
                            @endforeach
                        </div>
                        <a href="{{ route('contact') }}" class="btn btn-primary btn-full">
                            Solicitar proposta
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="page-section page-section-alt">
        <div class="container">
            <h2 class="section-title">Serviços complementares</h2>
            <p class="section-subtitle">
                Pacotes sob demanda para manter seu projeto sempre atualizado, seguro e alinhado ao crescimento do negócio.
            </p>

            @php
                $additionalServices = [
                    [
                        'icon' => 'fas fa-palette',
                        'title' => 'Design de interfaces',
                        'description' => 'UI/UX alinhado à marca com foco em usabilidade e conversão.',
                    ],
                    [
                        'icon' => 'fas fa-chart-line',
                        'title' => 'Otimização e métricas',
                        'description' => 'Performance, SEO técnico e instrumentação de analytics.',
                    ],
                    [
                        'icon' => 'fas fa-shield-halved',
                        'title' => 'Segurança e compliance',
                        'description' => 'Auditoria, testes e implementação de boas práticas OWASP.',
                    ],
                    [
                        'icon' => 'fas fa-cloud',
                        'title' => 'Infraestrutura e deploy',
                        'description' => 'Configuração de pipelines, monitoramento e nuvem.',
                    ],
                    [
                        'icon' => 'fas fa-graduation-cap',
                        'title' => 'Treinamento e onboarding',
                        'description' => 'Documentação, workshops e capacitação de equipes.',
                    ],
                    [
                        'icon' => 'fas fa-hands-helping',
                        'title' => 'Suporte e evolução',
                        'description' => 'Planos de manutenção e roadmap de melhorias contínuas.',
                    ],
                ];
            @endphp

            <div class="page-grid page-grid-3">
                @foreach ($additionalServices as $service)
                    <div class="page-card">
                        <span class="page-card-icon">
                            <i class="{{ $service['icon'] }}"></i>
                        </span>
                        <h3 class="page-card-title">{{ $service['title'] }}</h3>
                        <p class="page-card-text">{{ $service['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="page-section">
        <div class="container">
            <div class="split-grid process-grid">
                <div>
                    <h2 class="section-title">Como entregamos resultados</h2>
                    <p class="section-subtitle">
                        Um fluxo colaborativo, transparente e ágil para garantir previsibilidade durante todo o projeto.
                    </p>
                    <p class="page-paragraph">
                        A cada etapa há checkpoints, demos e validações. Assim, evitamos surpresas, antecipamos riscos e
                        evoluímos o produto com feedbacks reais do seu time.
                    </p>
                </div>
                <div>
                    @php
                        $processSteps = [
                            [
                                'step' => '1',
                                'title' => 'Diagnóstico profundo',
                                'description' => 'Entendimento do contexto atual, objetivos, stakeholders e indicadores de sucesso.',
                            ],
                            [
                                'step' => '2',
                                'title' => 'Planejamento e design',
                                'description' => 'Arquitetura, protótipos e backlog priorizado com entregas quinzenais.',
                            ],
                            [
                                'step' => '3',
                                'title' => 'Desenvolvimento iterativo',
                                'description' => 'Sprints curtos, ambiente de homologação e comunicação contínua.',
                            ],
                            [
                                'step' => '4',
                                'title' => 'Go-live e acompanhamento',
                                'description' => 'Testes, deploy assistido, monitoramento e plano de evolução.',
                            ],
                        ];
                    @endphp

                    <div class="process-list">
                        @foreach ($processSteps as $step)
                            <div class="process-item">
                                <span class="process-number">{{ $step['step'] }}</span>
                                <div>
                                    <h3>{{ $step['title'] }}</h3>
                                    <p>{{ $step['description'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="page-section page-section-alt">
        <div class="container">
            <h2 class="section-title">Perguntas frequentes</h2>
            <p class="section-subtitle">Respostas rápidas sobre prazos, suporte e formatos de trabalho.</p>

            @php
                $faqs = [
                    [
                        'question' => 'Quanto tempo leva para desenvolver um sistema sob medida?',
                        'answer' => 'Vai depender da complexidade. Projetos compactos podem ser entregues em 4 a 6 semanas; soluções completas costumam levar de 8 a 16 semanas, sempre com cronograma detalhado.',
                    ],
                    [
                        'question' => 'Você oferece suporte após a entrega?',
                        'answer' => 'Sim. Incluo um período de garantia para correções e ofereço planos contínuos de suporte, melhorias e monitoramento.',
                    ],
                    [
                        'question' => 'É possível integrar com sistemas já existentes?',
                        'answer' => 'Com certeza. Analiso as APIs disponíveis, proponho estratégias seguras de integração e garanto testes para que tudo funcione de ponta a ponta.',
                    ],
                    [
                        'question' => 'Como funciona o pagamento?',
                        'answer' => 'O investimento é dividido por marcos do projeto. Normalmente 40% no início, 30% no meio e 30% na entrega. Ajusto conforme a realidade do cliente.',
                    ],
                    [
                        'question' => 'Você trabalha com times internos?',
                        'answer' => 'Sim. Posso atuar junto com squads já existentes, liderar tecnicamente ou assumir todo o desenvolvimento.',
                    ],
                ];
            @endphp

            <div class="faq-list">
                @foreach ($faqs as $index => $faq)
                    <details class="faq-item" {{ $loop->first ? 'open' : '' }}>
                        <summary>
                            <span>{{ $faq['question'] }}</span>
                            <i class="fas fa-chevron-down"></i>
                        </summary>
                        <p>{{ $faq['answer'] }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    <section class="page-section cta-section">
        <div class="container">
            <div class="cta-card">
                <div>
                    <h2 class="section-title">Pronto para tirar o projeto do papel?</h2>
                    <p class="section-subtitle">
                        Compartilhe seus objetivos e receba um plano personalizado com prazos, etapas e investimento.
                    </p>
                </div>
                <div class="cta-actions">
                    <a href="{{ route('contact') }}" class="btn btn-primary">
                        <i class="fas fa-comments"></i>
                        Agendar conversa
                    </a>
                    <a href="https://wa.me/5592992684391" class="btn btn-outline" target="_blank" rel="noopener">
                        <i class="fab fa-whatsapp"></i>
                        Falar via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection



