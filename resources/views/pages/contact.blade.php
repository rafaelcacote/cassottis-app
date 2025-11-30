@extends('layouts.app')

@section('title', 'Contato - Cassottis')

@section('content')
    <section class="page-hero">
        <div class="container">
            <div class="page-hero-content">
                <span class="page-hero-badge">
                    <i class="fas fa-envelope-open-text"></i>
                    Contato
                </span>
                <h1 class="page-hero-title">Vamos transformar suas planilhas em um sistema sob medida</h1>
                <p class="page-hero-text">
                    Conte mais sobre o desafio da sua equipe e voltamos com uma proposta personalizada de como podemos
                    automatizar processos, integrar sistemas e acelerar resultados.
                </p>
            </div>
        </div>
    </section>

    <section class="page-section">
        <div class="container">
            <div class="split-grid">
                <div>
                    <h2 class="section-title">Como podemos ajudar?</h2>
                    <p class="page-paragraph">
                        Atuo com consultoria completa para transformar fluxos manuais e planilhas complexas em plataformas
                        web intuitivas, seguras e escaláveis. Cada projeto é desenvolvido em parceria com o time para garantir
                        aderência real às necessidades do negócio.
                    </p>
                    <div class="info-list">
                        <div class="info-item">
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:rafael.cacote@gmail.com">rafael.cacote@gmail.com</a>
                        </div>
                        <div class="info-item">
                            <i class="fab fa-whatsapp"></i>
                            <a href="https://wa.me/5592992684391" target="_blank" rel="noopener">WhatsApp direto</a>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            Manaus, AM - Brasil
                        </div>
                    </div>
                    <div class="page-card page-card-highlight">
                        <h3 class="page-card-title">Qual é o próximo passo?</h3>
                        <ul class="page-card-list">
                            <li><i class="fas fa-check"></i>Compartilhe contexto e objetivos do projeto</li>
                            <li><i class="fas fa-check"></i>Avaliamos integrações, prazos e orçamento</li>
                            <li><i class="fas fa-check"></i>Você recebe um plano claro para iniciar</li>
                        </ul>
                    </div>
                </div>
                <div>
                    @include('partials.contact')
                </div>
            </div>
        </div>
    </section>

    <section class="page-section page-section-alt cta-section">
        <div class="container">
            <div class="cta-card">
                <div>
                    <h2 class="section-title">Prefere conversar agora?</h2>
                    <p class="section-subtitle">
                        Estou disponível para uma call rápida ou troca de mensagens para entender melhor o cenário atual e as
                        expectativas do projeto.
                    </p>
                </div>
                <div class="cta-actions">
                    <a href="https://wa.me/5592992684391" class="btn btn-primary" target="_blank" rel="noopener">
                        <i class="fab fa-whatsapp"></i>
                        Chamar no WhatsApp
                    </a>
                    <a href="mailto:rafael.cacote@gmail.com" class="btn btn-outline">
                        <i class="fas fa-envelope"></i>
                        Enviar email
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection



