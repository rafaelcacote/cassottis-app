<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validar reCAPTCHA
            $recaptchaResponse = $request->input('g-recaptcha-response');
            if (!$recaptchaResponse) {
                return response()->json([
                    'success' => false,
                    'message' => 'Por favor, complete a verificação reCAPTCHA.',
                ], 422);
            }

            // Verificar reCAPTCHA com Google
            $secretKey = config('services.recaptcha.secret_key');
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $recaptchaResponse);
            $responseData = json_decode($verifyResponse);

            if (!$responseData->success) {
                return response()->json([
                    'success' => false,
                    'message' => 'Falha na verificação reCAPTCHA. Por favor, tente novamente.',
                ], 422);
            }

            // Validar os dados
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'company' => 'nullable|string|max:255',
                'phone' => 'required|string|max:255',
                'message' => 'required|string|max:10000',
            ]);

            // Preparar dados para salvar
            $data = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'company' => $validated['company'] ?? null,
                'phone' => $validated['phone'] ?? null,
                'subject' => 'Contato via formulário - ' . ($validated['company'] ?? 'Sem empresa'),
                'message' => $validated['message'],
                'status' => 'new',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ];

            // Salvar no banco de dados
            ContactMessage::create($data);

            // Retornar resposta JSON
            return response()->json([
                'success' => true,
                'message' => 'Mensagem enviada com sucesso! Entraremos em contato em breve.'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Por favor, verifique os dados do formulário.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Erro ao salvar mensagem de contato: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            
            $message = 'Erro ao enviar mensagem. Por favor, tente novamente mais tarde.';
            
            // Em desenvolvimento, mostrar a mensagem de erro real
            if (config('app.debug')) {
                $message .= ' Erro: ' . $e->getMessage();
            }
            
            return response()->json([
                'success' => false,
                'message' => $message,
                'debug' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}
