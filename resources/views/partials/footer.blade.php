<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-col">
                <img src="{{ asset('images/logo_cassottis.svg') }}" alt="Cassottis" class="footer-logo" style="height: 24px; margin-bottom: 12px;">
                <p class="footer-text">Transformando planilhas em sistemas inteligentes e produtivos.</p>
            </div>
            <div class="footer-col">
                <h4 class="footer-subtitle" style="display: inline-flex; align-items: center; gap: 8px;">
                    <img src="{{ asset('images/logoC.svg') }}" alt="" style="height: 18px;">
                    Serviços
                </h4>
                <ul class="footer-links">
                    <li><a href="{{ route('services') }}">Transformação de Planilhas</a></li>
                    <li><a href="{{ route('portfolio') }}">Cases e Portfólio</a></li>
                    <li><a href="{{ route('contact') }}">Contato</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4 class="footer-subtitle" style="display: inline-flex; align-items: center; gap: 8px;">
                    <img src="{{ asset('images/logoC.svg') }}" alt="" style="height: 18px;">
                    Empresa
                </h4>
                <ul class="footer-links">
                    <li><a href="{{ route('about') }}">Sobre</a></li>
                    <li><a href="{{ route('blog') }}">Blog</a></li>
                    <li><a href="{{ route('contact') }}">Contato</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4 class="footer-subtitle" style="display: inline-flex; align-items: center; gap: 8px;">
                    <img src="{{ asset('images/logoC.svg') }}" alt="" style="height: 18px;">
                    Legal
                </h4>
                <ul class="footer-links">
                    <li><a href="#">Privacidade</a></li>
                    <li><a href="#">Termos</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ now()->year }} Cassottis. Todos os direitos reservados.</p>
        </div>
    </div>
</footer>

