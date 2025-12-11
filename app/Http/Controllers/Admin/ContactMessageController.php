<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        
        // Filter by status
        if ($request->filled('status') && $request->status !== 'all' && $request->status !== '') {
            // Filtrar por status específico
            $query->where('status', $request->status);
        } elseif (!$request->filled('status') || ($request->filled('status') && $request->status === '')) {
            // Por padrão, mostrar todas exceto arquivadas (incluindo NULL)
            $query->where(function($q) {
                $q->whereIn('status', ['new', 'read', 'replied'])
                  ->orWhereNull('status');
            });
        }
        // Se status === 'all', não aplicar filtro (mostrar todas)
        
        // Search
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
        
        $messages = $query->latest()->paginate(15);
        
        // Contar mensagens não lidas (incluindo NULL como não lidas)
        $unreadCount = ContactMessage::where(function($q) {
            $q->where('status', 'new')->orWhereNull('status');
        })->count();
        
        return view('admin.contact-messages.index', compact('messages', 'unreadCount'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactMessage $contactMessage)
    {
        // Marcar como lida se ainda estiver como nova ou NULL
        if ($contactMessage->status === 'new' || $contactMessage->status === null) {
            $contactMessage->update(['status' => 'read']);
        }
        
        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactMessage $contactMessage)
    {
        return view('admin.contact-messages.edit', compact('contactMessage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactMessage $contactMessage)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,read,replied,archived',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
            'project_type' => 'nullable|string|max:255',
            'budget_range' => 'nullable|string|max:255',
            'timeline' => 'nullable|string|max:255',
        ]);
        
        $contactMessage->update($validated);
        
        return redirect()->route('admin.contact-messages.show', $contactMessage)
                        ->with('success', 'Mensagem atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        
        return redirect()->route('admin.contact-messages.index')
                        ->with('success', 'Mensagem excluída com sucesso!');
    }
    
    /**
     * Marcar mensagem como lida
     */
    public function markAsRead(ContactMessage $contactMessage)
    {
        $contactMessage->update(['status' => 'read']);
        
        return back()->with('success', 'Mensagem marcada como lida!');
    }
    
    /**
     * Marcar mensagem como respondida
     */
    public function markAsReplied(ContactMessage $contactMessage)
    {
        $contactMessage->update(['status' => 'replied']);
        
        return back()->with('success', 'Mensagem marcada como respondida!');
    }
    
    /**
     * Arquivar mensagem
     */
    public function archive(ContactMessage $contactMessage)
    {
        $contactMessage->update(['status' => 'archived']);
        
        return back()->with('success', 'Mensagem arquivada!');
    }
}
