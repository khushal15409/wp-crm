<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsAppMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'lead_id',
        'whatsapp_id',
        'from',
        'to',
        'direction',
        'body',
        'payload',
    ];

    protected $casts = [
        'payload' => 'array',
    ];
}

