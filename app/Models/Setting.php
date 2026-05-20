<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'group', 'type'];

    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::remember("setting_{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->getCastedValue() : $default;
        });
    }

    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget("setting_{$key}");
    }

    public function getCastedValue(): mixed
    {
        return match ($this->type) {
            'boolean' => (bool) $this->value,
            'json'    => json_decode($this->value, true),
            default   => $this->value,
        };
    }

    public static function allGrouped(): array
    {
        return static::all()->groupBy('group')->toArray();
    }
}
