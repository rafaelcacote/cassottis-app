<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Lista todas as mensagens de contato (apenas para usuários autenticados)
     */
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        // Filtro por status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Busca
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        // Paginação
        $perPage = $request->get('per_page', 15);
        $messages = $query->latest()->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $messages->map(function ($message) {
                return [
                    'id' => $message->id,
                    'name' => $message->name,
                    'email' => $message->email,
                    'company' => $message->company,
                    'phone' => $message->phone,
                    'subject' => $message->subject,
                    'message' => $message->message,
                    'project_type' => $message->project_type,
                    'budget_range' => $message->budget_range,
                    'timeline' => $message->timeline,
                    'status' => $message->status ?? 'new',
                    'created_at' => $message->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $message->updated_at->format('Y-m-d H:i:s'),
                ];
            }),
            'pagination' => [
                'current_page' => $messages->currentPage(),
                'last_page' => $messages->lastPage(),
                'per_page' => $messages->perPage(),
                'total' => $messages->total(),
            ]
        ], 200);
    }

    /**
     * Mostra uma mensagem específica
     */
    public function show(ContactMessage $message)
    {
        // Marcar como lida se ainda estiver como nova
        if ($message->status === 'new' || $message->status === null) {
            $message->update(['status' => 'read']);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $message->id,
                'name' => $message->name,
                'email' => $message->email,
                'company' => $message->company,
                'phone' => $message->phone,
                'subject' => $message->subject,
                'message' => $message->message,
                'project_type' => $message->project_type,
                'budget_range' => $message->budget_range,
                'timeline' => $message->timeline,
                'status' => $message->status ?? 'new',
                'ip_address' => $message->ip_address,
                'user_agent' => $message->user_agent,
                'created_at' => $message->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $message->updated_at->format('Y-m-d H:i:s'),
            ]
        ], 200);
    }
}

