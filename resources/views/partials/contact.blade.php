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
                    <label for="phone" class="form-label">Telefone</label>
                    <input type="tel" id="phone" name="phone" class="form-input" placeholder="(00) 00000-0000" required>
                </div>
                <div class="form-group">
                    <label for="company" class="form-label">Empresa</label>
                    <input type="text" id="company" name="company" class="form-input" placeholder="Sua empresa (opcional)">
                </div>
                <div class="form-group">
                    <label for="message" class="form-label">Mensagem</label>
                    <textarea id="message" name="message" class="form-textarea" placeholder="Conte-nos sobre seu desafio com planilhas..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-full btn-submit" id="submitBtn">
                    <i class="fas fa-paper-plane"></i>
                    <span>Enviar Mensagem</span>
                </button>
                <div class="form-feedback" id="formFeedback"></div>
            </form>
        </div>
    </div>
</section>

<!-- Modal de Sucesso -->
<div class="success-modal" id="successModal">
    <div class="success-modal-overlay"></div>
    <div class="success-modal-content">
        <div class="success-modal-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h3 class="success-modal-title">Mensagem Enviada com Sucesso!</h3>
        <p class="success-modal-text">Recebemos sua mensagem e entraremos em contato em breve.</p>
        <button class="btn btn-primary" onclick="closeSuccessModal()">
            Entendi
        </button>
    </div>
</div>

@push('scripts')
<script>
    // Função para mostrar o modal de sucesso
    function showSuccessModal() {
        const modal = document.getElementById('successModal');
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    
    // Função para fechar o modal
    function closeSuccessModal() {
        const modal = document.getElementById('successModal');
        modal.classList.remove('show');
        document.body.style.overflow = '';
    }
    
    // Fechar modal ao clicar no overlay
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('successModal');
        const overlay = modal.querySelector('.success-modal-overlay');
        
        overlay.addEventListener('click', closeSuccessModal);
        
        // Fechar modal com tecla ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.classList.contains('show')) {
                closeSuccessModal();
            }
        });
    });
    
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = this;
        const submitBtn = document.getElementById('submitBtn');
        const feedback = document.getElementById('formFeedback');
        const formData = new FormData(form);

        // Desabilitar botão e mostrar estado de carregamento
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Enviando...</span>';
        feedback.textContent = '';
        feedback.className = 'form-feedback';

        // Enviar formulário via AJAX
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            return response.json().then(data => ({
                status: response.status,
                data: data
            }));
        })
        .then(({ status, data }) => {
            if (status === 200 && data.success) {
                form.reset();
                
                // Mostrar modal de sucesso
                showSuccessModal();
                
                // Resetar botão
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i><span>Enviar Mensagem</span>';
            } else {
                // Tratar erros de validação
                let errorMessage = data.message || 'Erro ao enviar mensagem. Por favor, tente novamente.';
                
                if (data.errors) {
                    const firstError = Object.values(data.errors)[0];
                    errorMessage = Array.isArray(firstError) ? firstError[0] : firstError;
                }
                
                // Mostrar erro de debug se disponível
                if (data.debug) {
                    console.error('Erro de debug:', data.debug);
                    errorMessage += data.debug ? ' (' + data.debug + ')' : '';
                }
                
                feedback.textContent = errorMessage;
                feedback.className = 'form-feedback error';
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i><span>Enviar Mensagem</span>';
            }
        })
        .catch(error => {
            feedback.textContent = 'Erro ao enviar mensagem. Por favor, verifique sua conexão e tente novamente.';
            feedback.className = 'form-feedback error';
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i><span>Enviar Mensagem</span>';
        });
    });
</script>
@endpush

