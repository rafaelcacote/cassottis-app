@extends('layouts.app')

@section('title', 'Blog - Cassottis')

@section('content')
    <section class="page-hero">
        <div class="container">
            <div class="page-hero-content">
                <span class="page-hero-badge">
                    <i class="fas fa-lightbulb"></i>
                    Blog
                </span>
                <h1 class="page-hero-title">Insights sobre tecnologia, produto e transformação digital</h1>
                <p class="page-hero-text">
                    Artigos com aprendizados de projetos reais, boas práticas com Laravel e JavaScript e reflexões sobre como
                    a tecnologia pode gerar impacto de ponta a ponta nas empresas.
                </p>
            </div>
        </div>
    </section>

    @php
        $featuredPosts = [
            [
                'title' => 'Do Excel ao Sistema Web: guia para migrar processos com segurança',
                'excerpt' => 'Passo a passo para mapear fluxos, definir requisitos e implantar um sistema web que substitui planilhas críticas sem perder dados históricos.',
                'date' => '30 out 2024',
                'reading_time' => '8 min',
                'tags' => ['Transformação Digital', 'Laravel', 'Arquitetura'],
                'link' => '#',
            ],
            [
                'title' => 'Como estruturar APIs que crescem com o seu produto',
                'excerpt' => 'Versionamento, autenticação, testes e monitoramento: pilares para escalar integrações sem dor de cabeça.',
                'date' => '12 set 2024',
                'reading_time' => '6 min',
                'tags' => ['APIs', 'Boas Práticas', 'DevOps'],
                'link' => '#',
            ],
            [
                'title' => 'Design de dashboards que realmente ajudam na tomada de decisão',
                'excerpt' => 'A importância de métricas acionáveis, storytelling com dados e feedback contínuo com o time de negócio.',
                'date' => '25 jul 2024',
                'reading_time' => '7 min',
                'tags' => ['UX', 'Produtos Digitais', 'Analytics'],
                'link' => '#',
            ],
        ];

        $recentPosts = [
            [
                'title' => 'Checklist para lançar um produto web com qualidade',
                'excerpt' => 'Infraestrutura, segurança, monitoramento e comunicação: tudo o que precisa ser validado antes do go-live.',
                'date' => '18 jun 2024',
                'reading_time' => '9 min',
                'tags' => ['Lançamentos', 'Qualidade'],
                'link' => '#',
            ],
            [
                'title' => 'Por que investir em documentação desde o início do projeto',
                'excerpt' => 'Documentação reduz dependências, acelera onboarding e cria confiança no produto.',
                'date' => '03 mai 2024',
                'reading_time' => '5 min',
                'tags' => ['Processos', 'Gestão'],
                'link' => '#',
            ],
            [
                'title' => 'Escolhendo a stack ideal: Laravel + Vue ou Laravel + React?',
                'excerpt' => 'Critérios técnicos e de negócio para definir a combinação certa no seu contexto.',
                'date' => '22 mar 2024',
                'reading_time' => '6 min',
                'tags' => ['Stack', 'Laravel', 'JavaScript'],
                'link' => '#',
            ],
        ];

        $categories = [
            ['name' => 'Laravel', 'count' => 14, 'icon' => 'fab fa-laravel'],
            ['name' => 'JavaScript', 'count' => 11, 'icon' => 'fab fa-js-square'],
            ['name' => 'Visão de Produto', 'count' => 9, 'icon' => 'fas fa-lightbulb'],
            ['name' => 'DevOps', 'count' => 6, 'icon' => 'fas fa-server'],
            ['name' => 'UX & UI', 'count' => 7, 'icon' => 'fas fa-pen-nib'],
            ['name' => 'Gestão', 'count' => 8, 'icon' => 'fas fa-people-carry'],
            ['name' => 'Transformação Digital', 'count' => 13, 'icon' => 'fas fa-bolt'],
            ['name' => 'Analytics', 'count' => 5, 'icon' => 'fas fa-chart-bar'],
        ];
    @endphp

    <section class="page-section page-section-alt">
        <div class="container">
            <div class="section-heading">
                <h2 class="section-title">Artigos em destaque</h2>
                <p class="section-subtitle">Conteúdo selecionado com aprendizados práticos de projetos recentes.</p>
            </div>
            <div class="page-grid page-grid-3">
                @foreach ($featuredPosts as $post)
                    <article class="blog-card">
                        <header>
                            <div class="blog-meta">
                                <span><i class="fas fa-calendar"></i> {{ $post['date'] }}</span>
                                <span><i class="fas fa-clock"></i> {{ $post['reading_time'] }}</span>
                            </div>
                            <h3 class="blog-card-title">
                                <a href="{{ $post['link'] }}">{{ $post['title'] }}</a>
                            </h3>
                            <p class="blog-card-text">{{ $post['excerpt'] }}</p>
                        </header>
                        <footer>
                            <div class="tech-stack">
                                @foreach ($post['tags'] as $tag)
                                    <span class="chip">
                                        <i class="fas fa-hashtag"></i>
                                        {{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                            <a href="{{ $post['link'] }}" class="blog-card-link">
                                Ler artigo completo
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </footer>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="page-section">
        <div class="container">
            <div class="section-heading">
                <h2 class="section-title">Mais conteúdos para explorar</h2>
                <p class="section-subtitle">Atualizações frequentes com dicas, tutoriais e reflexões para liderar projetos digitais.</p>
            </div>
            <div class="page-grid page-grid-3">
                @foreach ($recentPosts as $post)
                    <article class="blog-card blog-card-compact">
                        <header>
                            <div class="blog-meta">
                                <span><i class="fas fa-calendar"></i> {{ $post['date'] }}</span>
                                <span><i class="fas fa-clock"></i> {{ $post['reading_time'] }}</span>
                            </div>
                            <h3 class="blog-card-title">
                                <a href="{{ $post['link'] }}">{{ $post['title'] }}</a>
                            </h3>
                            <p class="blog-card-text">{{ $post['excerpt'] }}</p>
                        </header>
                        <footer>
                            <div class="tech-stack">
                                @foreach ($post['tags'] as $tag)
                                    <span class="chip">
                                        <i class="fas fa-hashtag"></i>
                                        {{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                            <a href="{{ $post['link'] }}" class="blog-card-link">
                                Ler mais
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </footer>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="page-section page-section-alt">
        <div class="container">
            <div class="newsletter-card">
                <div>
                    <h2 class="section-title">Receba novos artigos e conteúdos exclusivos</h2>
                    <p class="section-subtitle">
                        Um e-mail por mês com insights práticos, templates e novidades sobre desenvolvimento e produto.
                    </p>
                </div>
                <form class="newsletter-form">
                    <input type="email" placeholder="Seu melhor e-mail" class="form-input" required>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i>
                        Quero receber
                    </button>
                </form>
                <p class="newsletter-disclaimer">
                    Sem spam. Você pode cancelar quando quiser.
                </p>
            </div>
        </div>
    </section>

    <section class="page-section">
        <div class="container">
            <div class="section-heading">
                <h2 class="section-title">Categorias populares</h2>
                <p class="section-subtitle">Escolha um tema e mergulhe em conteúdos aprofundados.</p>
            </div>
            <div class="page-grid page-grid-4">
                @foreach ($categories as $category)
                    <div class="page-card category-card">
                        <span class="page-card-icon">
                            <i class="{{ $category['icon'] }}"></i>
                        </span>
                        <h3 class="page-card-title">{{ $category['name'] }}</h3>
                        <p class="page-card-text">{{ $category['count'] }} artigos</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="page-section cta-section">
        <div class="container">
            <div class="cta-card">
                <div>
                    <h2 class="section-title">Tem um tema que gostaria de ver por aqui?</h2>
                    <p class="section-subtitle">
                        Envie sua dúvida ou sugestão. Gosto de transformar desafios reais em artigos e guias úteis.
                    </p>
                </div>
                <div class="cta-actions">
                    <a href="{{ route('contact') }}" class="btn btn-primary">
                        <i class="fas fa-envelope-open"></i>
                        Enviar sugestão
                    </a>
                    <a href="https://www.linkedin.com/in/rafaelcacote" class="btn btn-outline" target="_blank" rel="noopener">
                        <i class="fab fa-linkedin"></i>
                        Acompanhar no LinkedIn
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection



