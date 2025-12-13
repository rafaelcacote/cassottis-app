<div class="contact-form-wrapper">
    <form class="contact-form" id="contactForm" action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" id="name" name="name" class="form-input" placeholder="Seu nome completo" autocomplete="name" autocapitalize="words" required>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-input" placeholder="seu@email.com" autocomplete="email" inputmode="email" autocapitalize="none" required>
                </div>
                <div class="form-group">
                    <label for="phone" class="form-label">Telefone</label>
                    <input type="tel" id="phone" name="phone" class="form-input" placeholder="(00) 00000-0000" autocomplete="tel" inputmode="tel" required>
                    <small class="form-hint">
                        <i class="fab fa-whatsapp"></i> Entraremos em contato preferencialmente via WhatsApp
                    </small>
                </div>
                <div class="form-group">
                    <label for="company" class="form-label">Empresa</label>
                    <input type="text" id="company" name="company" class="form-input" placeholder="Sua empresa (opcional)" autocomplete="organization" autocapitalize="words">
                </div>
                <div class="form-group">
                    <label for="message" class="form-label">Mensagem</label>
                    <textarea id="message" name="message" class="form-textarea" placeholder="Conte-nos sobre seu desafio com planilhas..." required></textarea>
                </div>
                <div class="form-group recaptcha-wrapper">
                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}" data-size="normal"></div>
                    @error('g-recaptcha-response')
                        <div class="form-feedback error">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-full btn-submit" id="submitBtn">
                    <i class="fas fa-paper-plane"></i>
                    <span>Enviar Mensagem</span>
                </button>
                <div class="form-feedback" id="formFeedback" role="status" aria-live="polite"></div>
            </form>
</div>

@push('scripts')
<script>
    // Função para aplicar máscara de telefone brasileiro
    function applyPhoneMask(input) {
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não é dígito
            
            if (value.length <= 10) {
                // Telefone fixo: (00) 0000-0000
                value = value.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, '($1) $2-$3');
            } else {
                // Celular: (00) 00000-0000
                value = value.replace(/^(\d{2})(\d{5})(\d{0,4}).*/, '($1) $2-$3');
            }
            
            e.target.value = value;
        });
        
        // Permitir backspace e delete
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' || e.key === 'Delete') {
                return true;
            }
        });
    }
    
    // Aplicar máscara quando o DOM estiver pronto
    document.addEventListener('DOMContentLoaded', function() {
        const phoneInput = document.getElementById('phone');
        if (phoneInput) {
            applyPhoneMask(phoneInput);
        }
    });
    
    function showInlineSuccess(feedbackEl) {
        if (!feedbackEl) return;
        feedbackEl.className = 'form-feedback success';
        feedbackEl.innerHTML = '<i class="fas fa-check-circle" aria-hidden="true"></i><span>Mensagem enviada! Vou te chamar em breve.</span>';
        // Garantir visibilidade no mobile (caso o teclado esteja aberto)
        feedbackEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = this;
        const submitBtn = document.getElementById('submitBtn');
        const feedback = document.getElementById('formFeedback');
        
        // Limpar feedback anterior
        if (feedback) {
            feedback.textContent = '';
            feedback.className = 'form-feedback';
        }

        // Verificar se o reCAPTCHA foi preenchido (se disponível)
        if (typeof grecaptcha === 'undefined' || !grecaptcha.getResponse) {
            if (feedback) {
                feedback.textContent = 'Carregando verificação anti-spam... aguarde 1 segundo e tente novamente.';
                feedback.className = 'form-feedback error';
            }
            return;
        }

        const recaptchaResponse = grecaptcha.getResponse();
        if (!recaptchaResponse) {
            feedback.textContent = 'Por favor, complete a verificação reCAPTCHA.';
            feedback.className = 'form-feedback error';
            return;
        }

        const formData = new FormData(form);
        formData.append('g-recaptcha-response', recaptchaResponse);

        // Desabilitar botão e mostrar estado de carregamento
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Enviando...</span>';

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
                
                // Resetar reCAPTCHA
                if (typeof grecaptcha !== 'undefined') {
                    grecaptcha.reset();
                }
                
                // Mostrar sucesso inline (mais estável que modal/drawer/toast)
                showInlineSuccess(feedback);
                
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

