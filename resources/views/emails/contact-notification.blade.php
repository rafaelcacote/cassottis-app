<x-mail::message>
# Novo Contato via Formulário

Você recebeu uma nova mensagem através do formulário de contato do site.

## Informações do Contato

**Nome:** {{ $name }}  
**Email:** {{ $email }}  
**Telefone:** {{ $phone }}  
@if($company)
**Empresa:** {{ $company }}  
@endif

## Mensagem

{{ $message }}

---

Você pode responder diretamente para: {{ $email }}

<x-mail::button :url="'mailto:' . $email">
Responder por Email
</x-mail::button>

Obrigado,<br>
{{ config('app.name') }}
</x-mail::message>
