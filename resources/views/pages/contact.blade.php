@extends('layouts.app')

@section('title', 'Contato - Cassottis')

@section('content')
    <!-- Hero Section -->
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

    <!-- Contact Form Section -->
    <section class="page-section">
        <div class="container">
            <div class="contact-grid">
                <!-- Contact Form -->
                <div class="contact-form-column">
                    <h2 class="section-title">Solicite seu Orçamento</h2>
                    <p class="page-paragraph">
                        Preencha o formulário abaixo com os detalhes do seu projeto e entrarei em contato em até 24 horas.
                    </p>
                    
                    @include('partials.contact')
                </div>
                
                <!-- Contact Info -->
                <div class="contact-info-column">
                    <h2 class="section-title">Outras Formas de Contato</h2>
                    <p class="page-paragraph">
                        Prefere falar diretamente? Entre em contato através dos canais abaixo:
                    </p>
                    
                    <!-- Contact Methods -->
                    <div class="contact-methods">
                        <div class="contact-method-item">
                            <div class="contact-method-icon contact-method-icon-email">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-method-content">
                                <h3 class="contact-method-title">E-mail</h3>
                                <p class="contact-method-description">Resposta em até 24 horas</p>
                                <a href="mailto:contato@cassottis.com" class="contact-method-link">
                                    contato@cassottis.com
                                </a>
                            </div>
                        </div>
                        
                        <div class="contact-method-item">
                            <div class="contact-method-icon contact-method-icon-whatsapp">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <div class="contact-method-content">
                                <h3 class="contact-method-title">WhatsApp</h3>
                                <p class="contact-method-description">Resposta rápida no horário comercial</p>
                                <a href="https://wa.me/5592981075083" target="_blank" rel="noopener" class="contact-method-link">
                                    (92) 98107-5083
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Next Steps Card -->
                    <div class="page-card page-card-highlight">
                        <h3 class="page-card-title">Qual é o próximo passo?</h3>
                        <ul class="page-card-list">
                            <li><i class="fas fa-check"></i> Compartilhe contexto e objetivos do projeto</li>
                            <li><i class="fas fa-check"></i> Avaliamos integrações, prazos e orçamento</li>
                            <li><i class="fas fa-check"></i> Você recebe um plano claro para iniciar</li>
                        </ul>
                    </div>
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
                        Estou disponível para uma troca de mensagens para entender melhor o cenário atual e as
                        expectativas do projeto.
                    </p>
                </div>
                <div class="cta-actions">
                    <a href="https://wa.me/5592981075083" class="btn btn-primary" target="_blank" rel="noopener">
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



