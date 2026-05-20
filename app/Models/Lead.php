<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'form_type', 'name', 'email', 'phone', 'company', 'service_id',
        'subject', 'message', 'source_url', 'ip_address', 'user_agent',
        'status', 'notes', 'read_at',
    ];

    protected $casts = ['read_at' => 'datetime'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function setPhoneAttribute($value): void
    {
        $this->attributes['phone'] = $value ? preg_replace('/[^\d+]/', '', $value) : null;
    }

    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('form_type', $type);
    }

    public function isRead(): bool
    {
        return $this->read_at !== null;
    }

    public function markAsRead(): void
    {
        if (!$this->read_at) {
            $this->update(['read_at' => now()]);
        }
    }
}
