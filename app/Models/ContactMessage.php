<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $table = 'contact_messages';
    
    protected $fillable = [
        'name',
        'email',
        'company',
        'phone',
        'subject',
        'message',
        'project_type',
        'budget_range',
        'timeline',
        'status',
        'ip_address',
        'user_agent',
    ];
    
    protected $attributes = [
        'status' => 'new',
        'subject' => 'Contato via formulário',
    ];
}
