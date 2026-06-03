<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'phone',
    'phone_display',
    'name',
    'source',
    'form_type',
    'consent',
    'ip_address',
    'user_agent',
])]
final class LeadRequest extends Model
{
    protected function casts(): array
    {
        return [
            'consent' => 'boolean',
        ];
    }
}
