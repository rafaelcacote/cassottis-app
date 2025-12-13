# Guia de Configuração PWA - Cassottis App

Este guia explica como configurar o app mobile como PWA e conectá-lo com a API Laravel.

## ✅ O que foi implementado

### 1. PWA (Progressive Web App)
- ✅ `manifest.json` criado
- ✅ Service Worker configurado
- ✅ Meta tags PWA no HTML
- ✅ Registro automático do Service Worker

### 2. Integração com API Laravel
- ✅ Serviço de API (`lib/api.ts`)
- ✅ Contexto de autenticação (`contexts/AuthContext.tsx`)
- ✅ Páginas conectadas com API real:
  - Login
  - Dashboard
  - Inbox
  - MessageDetail (parcial)

### 3. Configurações
- ✅ CORS configurado no Laravel
- ✅ Interceptors do Axios para tokens
- ✅ Tratamento de erros

## 📋 Próximos Passos

### 1. Criar Ícones PWA

Você precisa criar dois ícones e colocá-los em `app-mobile/client/public/`:

- `icon-192.png` (192x192 pixels)
- `icon-512.png` (512x512 pixels)

**Dica**: Use uma ferramenta online como [PWA Asset Generator](https://www.pwabuilder.com/imageGenerator) para gerar os ícones.

### 2. Configurar Variável de Ambiente

Crie um arquivo `.env` em `app-mobile/`:

```env
VITE_API_URL=http://localhost:8000/api
```

Para produção, altere para:
```env
VITE_API_URL=https://seu-dominio.com/api
```

### 3. Testar Localmente

```bash
cd app-mobile
pnpm install
pnpm dev
```

Acesse `http://localhost:3000` e teste:
- Login com credenciais do Laravel
- Visualizar mensagens
- Navegação entre páginas

### 4. Deploy no Hostinger

#### Opção A: Subdomínio (Recomendado)

1. Crie um subdomínio: `app.cassottis.com`
2. Faça build: `pnpm build`
3. Faça upload de `dist/public/` para o subdomínio
4. Configure `VITE_API_URL` para `https://cassottis.com/api`

#### Opção B: Mesmo domínio (pasta)

1. Faça build: `pnpm build`
2. Faça upload de `dist/public/` para uma pasta (ex: `/app-mobile/`)
3. Configure `VITE_API_URL` para `https://cassottis.com/api`

### 5. Testar Instalação PWA

1. Acesse o app no navegador mobile
2. No Chrome/Edge: Menu → "Adicionar à tela inicial"
3. No Safari: Compartilhar → "Adicionar à Tela de Início"
4. O app será instalado como um app nativo

## 🔧 Configuração do Laravel (CORS)

O CORS já está configurado no `bootstrap/app.php`. Se precisar ajustar:

```php
// bootstrap/app.php
->withMiddleware(function (Middleware $middleware): void {
    $middleware->api(prepend: [
        \Illuminate\Http\Middleware\HandleCors::class,
    ]);
})
```

## 🐛 Troubleshooting

### Erro de CORS
- Verifique se o Laravel está permitindo requisições do domínio do app
- Verifique se `VITE_API_URL` está correto

### Token não funciona
- Verifique se o token está sendo salvo em `localStorage`
- Verifique se o token está sendo enviado no header `Authorization`

### PWA não instala
- Verifique se está usando HTTPS (obrigatório em produção)
- Verifique se o `manifest.json` está acessível
- Verifique se o Service Worker está registrado (console do navegador)

## 📱 Funcionalidades Implementadas

- ✅ Login/Logout
- ✅ Dashboard com estatísticas
- ✅ Lista de mensagens (Inbox)
- ✅ Filtros e busca
- ✅ Detalhes da mensagem
- ✅ Autenticação persistente
- ✅ Tratamento de erros

## 🚀 Melhorias Futuras

- [ ] Atualizar página MessageDetail para usar API
- [ ] Adicionar ações (marcar como lido, arquivar)
- [ ] Adicionar notificações push
- [ ] Melhorar cache offline
- [ ] Adicionar sincronização em background


