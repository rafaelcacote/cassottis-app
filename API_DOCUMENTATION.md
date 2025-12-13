# Documentação da API - Cassottis App

Esta documentação descreve como usar a API REST criada para o app mobile.

## Base URL

A API está disponível em: `http://seu-dominio.com/api` ou `http://localhost:8000/api` (em desenvolvimento)

## Autenticação

A API usa **Laravel Sanctum** para autenticação via tokens. Todas as rotas protegidas requerem um token de autenticação no header.

### Como funciona:

1. **Login**: O usuário faz login e recebe um token
2. **Requisições**: O app envia o token no header `Authorization: Bearer {token}`
3. **Logout**: O token é revogado

---

## Endpoints

### 🔓 Rotas Públicas (sem autenticação)

#### 1. Login
**POST** `/api/login`

Autentica um usuário e retorna um token.

**Body (JSON):**
```json
{
  "email": "usuario@example.com",
  "password": "senha123"
}
```

**Resposta de Sucesso (200):**
```json
{
  "success": true,
  "message": "Login realizado com sucesso",
  "data": {
    "user": {
      "id": 1,
      "name": "Nome do Usuário",
      "email": "usuario@example.com"
    },
    "token": "1|token_aqui..."
  }
}
```

**Resposta de Erro (422):**
```json
{
  "message": "As credenciais fornecidas estão incorretas.",
  "errors": {
    "email": ["As credenciais fornecidas estão incorretas."]
  }
}
```

---

#### 2. Registro
**POST** `/api/register`

Registra um novo usuário.

**Body (JSON):**
```json
{
  "name": "Nome Completo",
  "email": "novo@example.com",
  "password": "senha123",
  "password_confirmation": "senha123"
}
```

**Resposta de Sucesso (201):**
```json
{
  "success": true,
  "message": "Usuário registrado com sucesso",
  "data": {
    "user": {
      "id": 2,
      "name": "Nome Completo",
      "email": "novo@example.com"
    },
    "token": "2|token_aqui..."
  }
}
```

---

### 🔒 Rotas Protegidas (requerem autenticação)

Todas as rotas abaixo requerem o header:
```
Authorization: Bearer {seu_token_aqui}
```

---

#### 3. Logout
**POST** `/api/logout`

Revoga o token atual do usuário.

**Headers:**
```
Authorization: Bearer {token}
```

**Resposta de Sucesso (200):**
```json
{
  "success": true,
  "message": "Logout realizado com sucesso"
}
```

---

#### 4. Dados do Usuário
**GET** `/api/user`

Retorna os dados do usuário autenticado.

**Headers:**
```
Authorization: Bearer {token}
```

**Resposta de Sucesso (200):**
```json
{
  "success": true,
  "data": {
    "user": {
      "id": 1,
      "name": "Nome do Usuário",
      "email": "usuario@example.com"
    }
  }
}
```

---

#### 5. Listar Projetos
**GET** `/api/projects`

Lista todos os projetos ativos.

**Query Parameters (opcionais):**
- `featured=true` - Filtrar apenas projetos em destaque
- `per_page=12` - Itens por página (padrão: 12)

**Exemplo:**
```
GET /api/projects?featured=true&per_page=20
```

**Resposta de Sucesso (200):**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Nome do Projeto",
      "short_description": "Descrição curta",
      "description": "Descrição completa",
      "image": "http://dominio.com/storage/imagem.jpg",
      "gallery": ["http://dominio.com/storage/img1.jpg"],
      "technologies": ["Laravel", "React"],
      "project_url": "https://projeto.com",
      "github_url": "https://github.com/user/projeto",
      "demo_url": "https://demo.com",
      "status": "completed",
      "completion_date": "2024-01-15",
      "featured": true,
      "created_at": "2024-01-01 10:00:00",
      "updated_at": "2024-01-15 12:00:00"
    }
  ],
  "pagination": {
    "current_page": 1,
    "last_page": 3,
    "per_page": 12,
    "total": 30
  }
}
```

---

#### 6. Detalhes do Projeto
**GET** `/api/projects/{id}`

Retorna os detalhes de um projeto específico.

**Resposta de Sucesso (200):**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Nome do Projeto",
    "short_description": "Descrição curta",
    "description": "Descrição completa",
    "image": "http://dominio.com/storage/imagem.jpg",
    "gallery": ["http://dominio.com/storage/img1.jpg"],
    "technologies": ["Laravel", "React"],
    "project_url": "https://projeto.com",
    "github_url": "https://github.com/user/projeto",
    "demo_url": "https://demo.com",
    "status": "completed",
    "completion_date": "2024-01-15",
    "featured": true,
    "created_at": "2024-01-01 10:00:00",
    "updated_at": "2024-01-15 12:00:00"
  }
}
```

---

#### 7. Listar Posts do Blog
**GET** `/api/blog`

Lista todos os posts publicados.

**Query Parameters (opcionais):**
- `featured=true` - Filtrar apenas posts em destaque
- `tag=laravel` - Filtrar por tag
- `per_page=10` - Itens por página (padrão: 10)

**Exemplo:**
```
GET /api/blog?featured=true&tag=laravel
```

**Resposta de Sucesso (200):**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Título do Post",
      "slug": "titulo-do-post",
      "excerpt": "Resumo do post",
      "content": "Conteúdo completo do post...",
      "featured_image": "http://dominio.com/storage/imagem.jpg",
      "tags": ["Laravel", "PHP"],
      "status": "published",
      "published_at": "2024-01-15 10:00:00",
      "views": 150,
      "featured": true,
      "reading_time": 5,
      "author": {
        "id": 1,
        "name": "Nome do Autor",
        "email": "autor@example.com"
      },
      "created_at": "2024-01-01 10:00:00",
      "updated_at": "2024-01-15 12:00:00"
    }
  ],
  "pagination": {
    "current_page": 1,
    "last_page": 2,
    "per_page": 10,
    "total": 15
  }
}
```

---

#### 8. Detalhes do Post
**GET** `/api/blog/{slug}`

Retorna os detalhes de um post específico (usa o slug, não o ID).

**Resposta de Sucesso (200):**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Título do Post",
    "slug": "titulo-do-post",
    "excerpt": "Resumo do post",
    "content": "Conteúdo completo do post...",
    "featured_image": "http://dominio.com/storage/imagem.jpg",
    "tags": ["Laravel", "PHP"],
    "status": "published",
    "published_at": "2024-01-15 10:00:00",
    "views": 151,
    "featured": true,
    "reading_time": 5,
    "author": {
      "id": 1,
      "name": "Nome do Autor",
      "email": "autor@example.com"
    },
    "created_at": "2024-01-01 10:00:00",
    "updated_at": "2024-01-15 12:00:00"
  }
}
```

---

#### 9. Listar Mensagens de Contato
**GET** `/api/contact-messages`

Lista todas as mensagens de contato (apenas para usuários autenticados).

**Query Parameters (opcionais):**
- `status=new` - Filtrar por status (new, read, replied, archived)
- `search=termo` - Buscar por nome, email, assunto ou mensagem
- `per_page=15` - Itens por página (padrão: 15)

**Resposta de Sucesso (200):**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Nome do Cliente",
      "email": "cliente@example.com",
      "company": "Empresa",
      "phone": "+55 11 99999-9999",
      "subject": "Orçamento",
      "message": "Mensagem do cliente...",
      "project_type": "Website",
      "budget_range": "R$ 5.000 - R$ 10.000",
      "timeline": "2-3 meses",
      "status": "new",
      "created_at": "2024-01-15 10:00:00",
      "updated_at": "2024-01-15 10:00:00"
    }
  ],
  "pagination": {
    "current_page": 1,
    "last_page": 1,
    "per_page": 15,
    "total": 1
  }
}
```

---

#### 10. Detalhes da Mensagem
**GET** `/api/contact-messages/{id}`

Retorna os detalhes de uma mensagem específica.

**Resposta de Sucesso (200):**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Nome do Cliente",
    "email": "cliente@example.com",
    "company": "Empresa",
    "phone": "+55 11 99999-9999",
    "subject": "Orçamento",
    "message": "Mensagem do cliente...",
    "project_type": "Website",
    "budget_range": "R$ 5.000 - R$ 10.000",
    "timeline": "2-3 meses",
    "status": "read",
    "ip_address": "192.168.1.1",
    "user_agent": "Mozilla/5.0...",
    "created_at": "2024-01-15 10:00:00",
    "updated_at": "2024-01-15 11:00:00"
  }
}
```

---

## Códigos de Status HTTP

- `200` - Sucesso
- `201` - Criado com sucesso
- `401` - Não autenticado (token inválido ou ausente)
- `404` - Recurso não encontrado
- `422` - Erro de validação
- `500` - Erro interno do servidor

---

## Exemplo de Uso no App Mobile

### Flutter/Dart
```dart
// Login
final response = await http.post(
  Uri.parse('https://seu-dominio.com/api/login'),
  headers: {'Content-Type': 'application/json'},
  body: jsonEncode({
    'email': 'usuario@example.com',
    'password': 'senha123',
  }),
);

final data = jsonDecode(response.body);
final token = data['data']['token'];

// Requisições autenticadas
final projectsResponse = await http.get(
  Uri.parse('https://seu-dominio.com/api/projects'),
  headers: {
    'Authorization': 'Bearer $token',
    'Content-Type': 'application/json',
  },
);
```

### React Native
```javascript
// Login
const response = await fetch('https://seu-dominio.com/api/login', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
  },
  body: JSON.stringify({
    email: 'usuario@example.com',
    password: 'senha123',
  }),
});

const data = await response.json();
const token = data.data.token;

// Requisições autenticadas
const projectsResponse = await fetch('https://seu-dominio.com/api/projects', {
  headers: {
    'Authorization': `Bearer ${token}`,
    'Content-Type': 'application/json',
  },
});
```

---

## Próximos Passos

1. **Rodar as migrations**: Execute `php artisan migrate` para criar a tabela de tokens
2. **Configurar CORS**: Se necessário, ajuste as configurações de CORS em `config/cors.php`
3. **Testar a API**: Use Postman, Insomnia ou similar para testar os endpoints
4. **Implementar no App**: Integre a API no seu app mobile usando os exemplos acima

---

## Segurança

- ✅ Tokens são armazenados de forma segura no banco de dados
- ✅ Senhas são hasheadas usando bcrypt
- ✅ Tokens podem ser revogados a qualquer momento
- ✅ Rotas protegidas requerem autenticação válida
- ⚠️ Use HTTPS em produção
- ⚠️ Armazene tokens de forma segura no app (ex: SecureStorage)

