<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoftwareLogo extends Model
{
    protected $fillable = ['name', 'path', 'order'];

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('id');
    }
}
