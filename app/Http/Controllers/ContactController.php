<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validar os dados
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Opção 1: Salvar no banco de dados
        // Descomente se tiver criado um modelo Lead
        // Lead::create($validated);

        // Opção 2: Enviar email
        // Mail::send('emails.contact', $validated, function($message) {
        //     $message->to('seu-email@cassottis.com')
        //             ->subject('Novo Lead - ' . $validated['company']);
        // });

        // Retornar resposta JSON
        return response()->json([
            'success' => true,
            'message' => 'Mensagem enviada com sucesso! Entraremos em contato em breve.'
        ]);
    }
}
