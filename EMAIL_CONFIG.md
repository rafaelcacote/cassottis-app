# Configuração de Email - Notificações de Contato

## Configuração do SMTP

Para receber notificações por email quando alguém enviar um formulário de contato, você precisa configurar as variáveis de ambiente no arquivo `.env` do seu projeto.

### Variáveis necessárias no arquivo `.env`:

**Para Hostinger (configuração recomendada):**

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=465
MAIL_USERNAME=contato@cassottis.com
MAIL_PASSWORD=12031986Lll@@
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=contato@cassottis.com
MAIL_FROM_NAME="Cassottis"
```

### Configuração para Gmail

Se você estiver usando Gmail (ou Google Workspace), use as seguintes configurações:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=contato@cassottis.com
MAIL_PASSWORD=12031986Lll@@
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=contato@cassottis.com
MAIL_FROM_NAME="Cassottis"
```

**Importante para Gmail:**
- Se você usar autenticação de dois fatores, precisará gerar uma "Senha de App" no Google Account
- Acesse: https://myaccount.google.com/apppasswords
- Use a senha de app gerada no lugar da senha normal

### Configuração para outros provedores

#### Outlook/Hotmail:
```env
MAIL_HOST=smtp-mail.outlook.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
```

#### Yahoo:
```env
MAIL_HOST=smtp.mail.yahoo.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
```

#### Hostinger:
```env
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=465
MAIL_ENCRYPTION=ssl
```

**Importante:** A porta 465 requer SSL, não TLS. Use `MAIL_ENCRYPTION=ssl` para porta 465.

### Após configurar

1. Salve o arquivo `.env`
2. Limpe o cache de configuração do Laravel:
   ```bash
   php artisan config:clear
   ```
3. Teste enviando um formulário de contato

### Verificação

Quando alguém enviar um formulário de contato, você receberá um email em `contato@cassottis.com` com:
- Nome do contato
- Email do contato
- Telefone
- Empresa (se informada)
- Mensagem completa

### Troubleshooting

Se os emails não estiverem sendo enviados:

1. Verifique os logs em `storage/logs/laravel.log`
2. Teste a conexão SMTP usando ferramentas como `telnet` ou `openssl`
3. Verifique se o firewall não está bloqueando a porta SMTP
4. Para Gmail, certifique-se de que "Permitir aplicativos menos seguros" está habilitado OU use uma Senha de App

