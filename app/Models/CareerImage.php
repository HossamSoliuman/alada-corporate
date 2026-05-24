<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerImage extends Model
{
    protected $fillable = ['path', 'alt', 'order'];

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('id');
    }
}
