# Guia Passo a Passo: Configuração do reCAPTCHA

Este guia explica como configurar o Google reCAPTCHA v2 no formulário de contato.

## 📋 Pré-requisitos

- Conta Google
- Acesso ao arquivo `.env` do projeto

## 🚀 Passo a Passo

### Passo 1: Obter as Chaves do reCAPTCHA

1. Acesse o site do Google reCAPTCHA: https://www.google.com/recaptcha/admin/create

2. Faça login com sua conta Google

3. Preencha o formulário de registro:
   - **Label**: Dê um nome para seu site (ex: "Cassottis App")
   - **Tipo de reCAPTCHA**: Selecione **"reCAPTCHA v2"** → **"Eu não sou um robô"**
   - **Domínios**: Adicione os domínios onde o reCAPTCHA será usado:
     - `localhost` (para desenvolvimento)
     - Seu domínio de produção (ex: `seusite.com.br`)
   - Aceite os Termos de Serviço

4. Clique em **"Enviar"**

5. Você receberá duas chaves:
   - **Site Key** (Chave do Site) - Pública, usada no frontend
   - **Secret Key** (Chave Secreta) - Privada, usada no backend

### Passo 2: Configurar as Chaves no Projeto

1. Abra o arquivo `.env` na raiz do projeto

2. Adicione as seguintes linhas no final do arquivo:

```env
RECAPTCHA_SITE_KEY=sua_site_key_aqui
RECAPTCHA_SECRET_KEY=sua_secret_key_aqui
```

3. Substitua `sua_site_key_aqui` e `sua_secret_key_aqui` pelas chaves que você obteve no Passo 1

**Exemplo:**
```env
RECAPTCHA_SITE_KEY=6LdXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
RECAPTCHA_SECRET_KEY=6LdXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
```

### Passo 3: Limpar o Cache de Configuração

Execute o seguinte comando no terminal para garantir que as novas configurações sejam carregadas:

```bash
php artisan config:clear
```

Ou se estiver em produção:

```bash
php artisan config:cache
```

### Passo 4: Testar o reCAPTCHA

1. Acesse a página do formulário de contato no seu site

2. Você verá o widget do reCAPTCHA antes do botão "Enviar Mensagem"

3. Preencha o formulário e marque a caixa "Não sou um robô"

4. Envie o formulário

5. Se tudo estiver funcionando corretamente, o formulário será enviado normalmente

## ✅ O que foi implementado

### Frontend (contact.blade.php)
- Widget do reCAPTCHA adicionado antes do botão de envio
- Validação JavaScript para verificar se o reCAPTCHA foi preenchido antes de enviar
- Reset automático do reCAPTCHA após envio bem-sucedido

### Backend (ContactController.php)
- Validação do token do reCAPTCHA antes de processar o formulário
- Verificação com a API do Google para garantir que o reCAPTCHA é válido
- Mensagens de erro apropriadas caso a validação falhe

### Configuração (config/services.php)
- Configuração centralizada das chaves do reCAPTCHA
- Acesso via `config('services.recaptcha.site_key')` e `config('services.recaptcha.secret_key')`

### Layout (app.blade.php)
- Script do Google reCAPTCHA carregado automaticamente quando as chaves estão configuradas

## 🔧 Solução de Problemas

### O reCAPTCHA não aparece
- Verifique se as chaves estão corretas no arquivo `.env`
- Certifique-se de que executou `php artisan config:clear`
- Verifique se o domínio está registrado no Google reCAPTCHA
- Verifique o console do navegador para erros JavaScript

### Erro "Falha na verificação reCAPTCHA"
- Verifique se a Secret Key está correta no `.env`
- Certifique-se de que o domínio está na lista de domínios permitidos no Google reCAPTCHA
- Verifique se há problemas de conexão com a API do Google

### reCAPTCHA aparece mas não valida
- Verifique se ambas as chaves (Site Key e Secret Key) estão corretas
- Limpe o cache do navegador
- Verifique se não há bloqueadores de anúncios interferindo

## 📝 Notas Importantes

- **Desenvolvimento**: Use `localhost` como domínio no Google reCAPTCHA
- **Produção**: Adicione seu domínio real na lista de domínios permitidos
- **Segurança**: Nunca compartilhe sua Secret Key publicamente
- **Testes**: O Google fornece chaves de teste que sempre passam na validação (útil para desenvolvimento)

## 🔗 Links Úteis

- [Documentação oficial do Google reCAPTCHA](https://developers.google.com/recaptcha/docs/display)
- [Painel de Administração do reCAPTCHA](https://www.google.com/recaptcha/admin)
- [Teste de reCAPTCHA](https://www.google.com/recaptcha/api2/demo)

## 🎯 Próximos Passos (Opcional)

Se quiser melhorar ainda mais a segurança, você pode:

1. **Implementar reCAPTCHA v3**: Versão invisível que não requer interação do usuário
2. **Adicionar rate limiting**: Limitar o número de envios por IP
3. **Logs de segurança**: Registrar tentativas de envio com reCAPTCHA inválido

---

**Pronto!** Seu formulário agora está protegido com reCAPTCHA. 🎉






