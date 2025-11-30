<section id="contato" class="contact">
    <div class="container">
        <div class="contact-header">
            <h2 class="section-title">Gere leads para novos projetos</h2>
            <p class="section-subtitle">Preencha o formulário e entraremos em contato em breve</p>
        </div>
        <div class="contact-form-wrapper">
            <form class="contact-form" id="contactForm" action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" id="name" name="name" class="form-input" placeholder="Seu nome completo" required>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-input" placeholder="seu@email.com" required>
                </div>
                <div class="form-group">
                    <label for="company" class="form-label">Empresa</label>
                    <input type="text" id="company" name="company" class="form-input" placeholder="Sua empresa" required>
                </div>
                <div class="form-group">
                    <label for="message" class="form-label">Mensagem</label>
                    <textarea id="message" name="message" class="form-textarea" placeholder="Conte-nos sobre seu desafio com planilhas..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-full">
                    Enviar Mensagem
                </button>
            </form>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        alert('Mensagem enviada com sucesso! Entraremos em contato em breve.');
        this.reset();
    });
</script>
@endpush

